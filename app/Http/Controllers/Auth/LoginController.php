<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        return view('login');
    }

    /*
    public function login(Request $request){
        $password = Hash::make($request->input('password'));
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
            $request->session()->put('username', $user->name);
        }

        return back()->with('wrongCredentials', 'Username or password wrong')->withErrors([
            'wrongCredentials' => 'Le informazioni inserite non sono valide',
        ]);
    } */

    public function login(Request $request){
        try {
            $credentials = $request->only('username', 'password');
    
            if (Auth::attempt($credentials)) {
                $user = Auth::user(); // Recupera l'utente autenticato
                $request->session()->put('username', $user->name);
                return redirect()->intended('/');
            }
    
            return back()->with('wrongCredentials', 'Username o password errati')->withErrors([
                'wrongCredentials' => 'Le informazioni inserite non sono valide',
            ]);
        } catch (\PDOException $e) {
            // Errore di connessione al database
            return back()->with('dbConnectionError', 'Impossibile connettersi al database. Riprova più tardi.');
        } catch (\Exception $e) {
            // Qualsiasi altro tipo di errore
            return back()->with('generalError', 'Si è verificato un errore.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
