<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    # Override redirectTo Path
    protected $redirectTo = '/';
    # Override default password subject
    protected $subject  =   'Reset your password';

    /**
     * Create a new password controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    # Override showResetForm to change logic
    # Validate token first before showing the form
    public function showResetForm(Request $request, $token=null){

        if (is_null($token)) {
            return $this->getEmail();
        }

        $request->merge(['token'=>$token]);
        $credentials = $this->getResetCredentials($request);
        $broker = $this->getBroker();

        # Get user data using credentials
        $user   =   Password::broker($broker)->getUser($credentials);
        $token  =   $credentials['token'];
        $email  =   $request->email;
        $response = Password::broker($broker)->tokenExists($user,$credentials['token']);

        # if switch is true, go to default
        # else into case
        switch ($response) {
            #token exists
            case Password::PASSWORD_RESET:{
                if (property_exists($this, 'resetView')) {
                    return view($this->resetView)->with(compact('token', 'email'));
                }

                if (view()->exists('auth.passwords.reset')) {
                    return view('auth.passwords.reset')->with(compact('token', 'email'));
                }

                return view('auth.reset')->with(compact('token', 'email'));
            }
                #return error message that token already expires

            # token does not exist
            default:{
                return abort(404);
            }
        }
    }
}
