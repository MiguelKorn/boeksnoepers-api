<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware( 'guest' )->except( 'logout' );
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json([
                'data'=>$user->toArray(),
                'success'=>true
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data'=>'User logged out', 'success'=>true], 200);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json(['message'=>'Authenticate failure', 'success'=> false], 200);
    }
}
