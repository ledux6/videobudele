<?php

namespace App\Http\Controllers;

use App\Mail\SongRegistered;
use App\Models\Registration;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;


class VideoRegistrationController extends Controller
{
    public function register(Request $request) 
    {
        $code = $this->generateRandomCode(5);
        Registration::create(
            [
                'email' => $request->all()['email'],
                'youtube_video_id' => $request->all()['videoId'],
                'pseudo_random_id' => $code
            ]
        );

        if ($request->all()['email']) {
            $this->sendEmail($request->all()['email'], $code);
        }

        return redirect()->route('success', ['code' => $code]);
    }


    private function generateRandomCode($length) { 

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
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

    private function sendEmail(string $emailAddress, string $code)
    {
        Mail::to($emailAddress)->send(new SongRegistered($code));

        return;    
    }
}
