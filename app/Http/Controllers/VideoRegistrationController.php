<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Inertia\Inertia;
use Illuminate\Http\Request;

class VideoRegistrationController extends Controller
{
    public function register(Request $request) 
    {
        $code = $this->generateRandomCode(5);
        // register to DB
        Registration::create(
            [
                'email' => $request->all()['email'],
                'youtube_video_id' => $request->all()['vidoeId'],
                'pseudo_random_id' => $code
            ]
        );

        //if email present send email
        if ($request->all()['email']) {
            $this->sendEmail();
        }

        return Inertia::render('Success', [ 'code' => $code]);
    }


    private function generateRandomCode($length) { 

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
        $charactersLength = strlen($characters); 
        $randomString = ''; 
        for ($i = 0; $i < $length; $i++) { 
            $randomString .= $characters[rand(0, $charactersLength - 1)]; 
        }
        
        // check if it's random in DB if not do/while

        return $randomString; 
    }

    private function sendEmail()
    {
        return;    
    }
}
