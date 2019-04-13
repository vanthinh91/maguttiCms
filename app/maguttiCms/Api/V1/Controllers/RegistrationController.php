<?php namespace App\MaguttiCms\Api\V1\Controllers;
use Mail;
use Validator;
use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\User;
use App\MaguttiCms\Website\Repos\User\UserRepositoryInterface;
use Facades\ {
    App\UserTrackers
};
use App\Mail\UserRegistered;
/*
   |--------------------------------------------------------------------------
   | Register Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the registration of new users as well as their
   | validation and creation. By default this controller uses a trait to
   | provide this functionality without requiring any additional code.
   |
   */
class RegistrationController extends ApiController
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $user )
    {
        $this->userRepo = $user;
    }


    /**
     * Handle a registration request for the application.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->register_validator($request);
        if ($validator->fails()) {

            if ($validator->errors()->has('email')) {
                $this->responseWithError($validator->errors()->first('email'));
            } else {
               $this->responseWithError( __('api.errors.invalid_data')  );
            }

        } else {
            $user = User::registerFromApi($request->all());
            if($user){
                Mail::to( $user->email )->send(new UserRegistered($user));
                //Mail::to( 'mywowo.gfstudio.com@gmail.com' )->send(new UserRegistered($user));
                $this->setStatus('OK');
                if($request->has("data")){
                    $stream  = json_decode($request->data);
                    UserTrackers::trackFromApi($stream ,$user->id);
                }
                $data = $this->userRepo->apiData($user);
                $this->setData($data);
            }
            else{
                $this->setMsg( __('api.errors.error_pretty') );
            }
        }
        return $this->apiResponse();
    }


    /**
     * Returns a Validator instance for register
     *
     * @param Request $request
     *
     * @return Validator
     */

    public function register_validator(Request $request)
    {
        return Validator::make(
            $request->only('email', 'password', 'first_name', 'last_name', 'gender', 'lang','country_code'),
            config('laraCms.api.form_validation.users')
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {

        return User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'password'      => $data['password'],
            'email'         => $data['email'],
            'gender'        => $data['gender'],
            'country_code'  => $data['country_code'],
            'lang'          => $data['lang'],
        ]);

    }
}
