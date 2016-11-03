<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Krucas\LaravelUserEmailVerification\AuthenticatesAndRegistersUsers as VerificationAuthenticatesAndRegistersUsers;
use Krucas\LaravelUserEmailVerification\Facades\Verification;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins;
    use AuthenticatesAndRegistersUsers;
    use VerificationAuthenticatesAndRegistersUsers{
        // Use original AuthenticatesAndRegisterUsers
        AuthenticatesAndRegistersUsers::redirectPath insteadof VerificationAuthenticatesAndRegistersUsers;
        AuthenticatesAndRegistersUsers::getGuard insteadof VerificationAuthenticatesAndRegistersUsers;
        // Use custom package AuthenticatesAndRegisterUsers
        VerificationAuthenticatesAndRegistersUsers::register insteadof AuthenticatesAndRegistersUsers;
    }


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' =>  'required|max:255',
            'lastname'  =>  'required|max:255',
            'email'     =>  'required|email|max:255|unique:users',
            #'password' => 'required|confirmed|min:6',
            'password'  =>  'required|min:8',

            # Validation for reCaptcha
            #"g-recaptcha-response"  =>  'required|captcha'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request)
    {
        $user   =   User::create([
            'firstname'     =>  $request->firstname,
            'lastname'      =>  $request->lastname,
            'email'         =>  $request->email,
            #Generate 6 character string for password
            'password'      =>  $request->password,
            # Default to Language = English, Company = Sonic
            'language_id'   =>  1,
            'company_id'    =>  1,
        ]);
        $role   =   Role::findOrFail(5);
        $user->attachRole($role);
        return $user;
    }

    /*
     * Override methods
     */
    public function register(Request $request){
        $password   =   uniqid();
        $request->merge(['password'=>bcrypt($password)]);
        $validator  =   $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        # Create user
        $this->create($request);

        # Send generated password
        $email  =   $request->email;
        $firstname  =   $request->firstname;
        $lastname  =   $request->lastname;
        $update_password_view = "auth.emails.update_password";
        Mail::queue($update_password_view, compact('password','email','firstname','lastname'),function($msg) use ($password, $email,$firstname,$lastname){
            $msg->to($email)->subject('Welcome to Sonic!');
        });

        # Process email verification
        $broker = $this->getBroker();
        $credentials = $request->only('email');
        Verification::broker($broker)
            ->sendVerificationLink($credentials, function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        if (config('verification.verify')) {
            return redirect($this->verificationRedirectPath());
        }

        return redirect($this->redirectPath());
    }
    public function showRegistrationForm()
    {
        $data = ['page_title' => 'Create new account'];

        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        return view('auth.register', $data);
    }

    public function showLoginForm()
    {
        $data = ['page_title' => 'Login'];
        $view = property_exists($this, 'loginView')
            ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }

        return view('auth.login',$data);
    }
}
