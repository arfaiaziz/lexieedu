<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class AuthController extends Controller
    {
        public function showLogin()
        {
            return view('layouts.login');
        }

        public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->intended('/dashboard');
            }

            return back()->withErrors([
                'email' => 'Email atau password salah',
            ])->withInput();

        }
    }

?>
