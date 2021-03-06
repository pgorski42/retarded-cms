<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Validator;
use Auth;
use Lang;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     *
     */
    private $rules = null;

    public function __construct(Guard $auth)
    {
        $this->rules = [
            'login' => 'required:users.login',
            'password' => 'required:users.password'
        ];

        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showForms()
    {
        return view('rcms.login.index');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails())
            return $this->createResponse($validator->messages(), Response::HTTP_BAD_REQUEST);

        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->createResponse(['redirect' => route('dashboard')], Response::HTTP_OK);
        }
        return $this->createResponse(['authorization' => [Lang::get('auth.failed')]], Response::HTTP_FORBIDDEN);
    }

    public static function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Cache::flush();

        return redirect()->intended('/login');
    }

    public function username()
    {
        return 'login';
    }
}
