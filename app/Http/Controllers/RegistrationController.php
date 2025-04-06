<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Http\Response;
use Inertia\Inertia;

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
        return Registration::orderBy('waiting', 'desc')
            ->orderBy('createdAt', 'desc')
            ->get();
    }

    public function waitinglist(): Collection
    {
        return Registration::orderBy('waiting', 'desc')
            ->orderBy('createdAt', 'desc')
            ->where('waiting', '=', true)
            ->get();
    }

    public function close($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return '';
    }

    public function clear(): string
    {
        $registrations = Registration::all();
        foreach ($registrations as $registration) {
            $registration->delete();
        }

        return '';
    }
}
