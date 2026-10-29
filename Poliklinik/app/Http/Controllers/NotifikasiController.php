<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Auth::user()->notifications()->latest()->get();

        return view('notifikasi.index', compact('notifikasis'));
    }

    public function baca(string $id)
    {
        $notifikasi = Auth::user()->notifications()->findOrFail($id);

        $notifikasi->markAsRead();

        return redirect()->route(Auth::user()->role . '.notifikasi.index')
            ->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    public function bacaSemua()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->route(Auth::user()->role . '.notifikasi.index')
            ->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}
