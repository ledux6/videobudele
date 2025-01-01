<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Http\Response;


class RegistrationController extends Controller
{
    public function changeRegistrationStatus(Request $request): Response
    {
        $registration = Registration::firstWhere('pseudo_random_id', $request->all()['code']);
        if (!$registration) {
            return Response('Code not found', 400);
        }

        $registration->waiting = true;
        $registration->save();

        return Response('', 200);
    }

    public function list(): Collection
    {
        return Registration::all();
    }
}
