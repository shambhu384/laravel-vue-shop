<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }*/


	/* API Login, on success return JWT Auth token
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(Request $request)
	{
		$credentials = $request->only('email', 'password');

		$rules = [
			'email' => 'required|email',
			'password' => 'required',
		];
		$validator = Validator::make($credentials, $rules);
		if($validator->fails()) {
			return response()->json(['success'=> false, 'error'=> $validator->messages()]);
		}

		$credentials['is_verified'] = 0;

		try {
			// attempt to verify the credentials and create a token for the user
			if (! $token = JWTAuth::attempt($credentials)) {
				return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
			}
		} catch (JWTException $e) {
			// something went wrong whilst attempting to encode the token
			return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
		}
		// all good so return the token
		return response()->json(['success' => true, 'data'=> [ 'token' => $token ]]);
	}

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
	}

	/**
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        $verification_code = str_random(30); //Generate verification code
        DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
		/*Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
			function($mail) use ($email, $name, $subject){
				$mail->from(getenv('FROM_EMAIL_ADDRESS'), "From Learningpage.in");
				$mail->to($email, $name);
				$mail->subject($subject);
			});
		*/
		return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email to complete your registration.']);
	}

	/* API Verify User
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function verifyUser($verification_code)
	{

		$check = DB::table('user_verifications')->where('token',$verification_code)->first();
		if(!is_null($check)){
			$user = User::find($check->user_id);
			if($user->is_verified == 1){
				return response()->json([
					'success'=> true,
					'message'=> 'Account already verified..'
				]);
			}
			$user->update(['is_verified' => 1]);
			DB::table('user_verifications')->where('token',$verification_code)->delete();
			return response()->json([
				'success'=> true,
				'message'=> 'You have successfully verified your email address.'
			]);
		}
		return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);
	}
}
