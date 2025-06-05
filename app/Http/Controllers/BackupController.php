<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{

    public function index()
    {
        $data = [
            'selected' =>  'Backup',
            'page' => 'Backup',
            'title' => 'Backup',
        ];

        return view('backup', $data);
    }
    public function backup(Request $request)
    {
        // Menjalankan perintah backup
        Artisan::call('backup:run');

        // Cek notifikasi dan redirect
        return back()->with('success', 'Backup berhasil dijalankan!');
    }
}
