<?php

namespace App\Http\Controllers;

use App\Models\Profile;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth as FacadesAuth;

class Auth extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ['profile' => Profile::first()];
        return view('auth/login', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ], [
            'email.required' => 'email or username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
        ]);

        $login = $request->input('email'); // Bisa username atau email
        $password = $request->input('password');

        // Deteksi apakah email atau username
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Login menggunakan field yang sesuai dan role
        $credentials = [
            $field => $login,
            'password' => $password,
        ];



        if (FacadesAuth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = FacadesAuth::user();

            // Redirect sesuai dengan role user
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'finance':
                    return redirect()->route('finance.dashboard');
                case 'gudang':
                    return redirect()->route('gudang.dashboard');
                default:
                    FacadesAuth::logout();
                    return redirect('login')->with('message', 'Role tidak dikenal.');
            }
        } else {
            return redirect('login')->with('message', 'email, username dan password salah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        FacadesAuth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
