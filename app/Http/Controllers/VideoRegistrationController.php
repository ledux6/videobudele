<?php

namespace App\Http\Controllers;

use App\Mail\SongRegistered;
use App\Models\Registration;
use App\Models\RegistrationLog;
use GuzzleHttp\Client;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;


class VideoRegistrationController extends Controller
{
    public function register(Request $request) 
    {
        $code = $this->generateCode();
        Registration::create(
            [
                'email' => $request->all()['email'],
                'youtube_video_id' => $request->all()['videoId'],
                'code' => $code
            ]
        );

        $this->logRegistration($request->all()['videoId']);

        if ($request->all()['email']) {
            $this->sendEmail($request->all()['email'], $code);
        }

        return redirect()->route('success', ['code' => $code]);
    }


    /** @deprecated */
    private function generateRandomCode($length) { 

        $characters = '0123456789'; 
        $charactersLength = strlen($characters); 

        $isUsed = true;
        do {
            $randomString = ''; 
            for ($i = 0; $i < $length; $i++) { 
                $randomString .= $characters[rand(0, $charactersLength - 1)]; 
            }
        
            $items = DB::table('registrations')
                ->where('pseudo_random_id', '=', $randomString)
                ->get();

            if (!$items->count()) {
                $isUsed = false;
            }
            

        } while($isUsed !== false);

        return $randomString; 
    }

    private function generateCode(): string 
    {
        $code = '';
        $registration = Registration::latest()->first();
        if ($registration) {
            $code = (int)$registration->code;
        }

        if ($code === '') {
            return '001';
        }
        
        if ($code < 10) {
            $code++;
            return '00' . (string)$code;
        }

        if ($code < 100) {
            $code++;
            return '0' . (string)$code;
        }

        return (string)$code++;
    }

    private function sendEmail(string $emailAddress, string $code)
    {
        $mail = Mail::to($emailAddress)->send(new SongRegistered($code));


        return $mail;    
    }

    private function logRegistration(string $videoId)
    {
        $registrationLog = RegistrationLog::where('video_id', '=', $videoId)
            ->get()
            ->first();

        if (!$registrationLog) {
            $client = new Client();
            $response = $client->request('GET', 
                'https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . $videoId . 
                '&key=AIzaSyC77br-9-k1HBkznO36wQTVBOFAaTRi3vI' 
            );
            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                $body = json_decode($response->getBody()->getContents(), true);
                $title = $body['items'][0]['snippet']['title'];

                RegistrationLog::create([
                    'count' => 1, 
                    'video_id' => $videoId,
                    'title' => $title
                ]);

                return;
            }
        }

        $registrationLog->count = $registrationLog->count++;
        $registrationLog->save();
    }
    

    public function top5Videos()
    {
        return RegistrationLog::orderBy('count', 'desc')
            ->limit(5)
            ->get();
    }
}
