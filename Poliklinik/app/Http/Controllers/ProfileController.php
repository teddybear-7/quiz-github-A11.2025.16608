<?php

namespace App\Http\Controllers;

use App\Http\Requests\GantiPasswordRequest;
use App\Http\Requests\GantiUsernameRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function updateUsername(GantiUsernameRequest $request)
    {
        Auth::user()->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route(Auth::user()->role . '.profile.edit')
            ->with('success', 'Username berhasil diganti.');
    }

    public function update(GantiPasswordRequest $request)
    {
        Auth::user()->update([
            'password' => $request->password,
        ]);

        return redirect()->route(Auth::user()->role . '.profile.edit')
            ->with('success', 'Password berhasil diganti.');
    }
}
