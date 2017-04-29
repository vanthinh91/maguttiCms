<?php namespace App\MaguttiCms\Api\V1\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\Request;

use App\User;
use App\MaguttiCms\Website\Repos\User\UserRepositoryInterface;

/**
 * Class AuthenticateController
 * @package App\MaguttiCms\Api\V1\Controllers
 */
class AuthenticateController extends ApiController
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $user )
    {
        $this->userRepo = $user;
    }
   /*
   |--------------------------------------------------------------------------
   | Authenticate the user
   |--------------------------------------------------------------------------
   |
   |
   */
    public function authenticate(Request $request)
    {
        // se non mi passa la lingua..
        if(!$request->has('lang')){
            $this->responseWithError(  __('api.errors.invalid_data') );
            return $this->apiResponse();
        }

        // prende dalla richiesta le credenziali di accesso
        $credentials = $request->only('email', 'password');
        try {
            // verifica le credenziali...
            if (!$token = JWTAuth::attempt($credentials)) {
                // qualcosa è andato storto nella verifica delle credenziali
                $this->responseWithError(__('api.errors.invalid_credentials') );
                return $this->apiResponse();
            }
        } catch (JWTException $e) {
            // qualcosa è andato storto in fase di codifica del token
            $this->responseWithError(__('api.errors.could_not_create_token'));
            return $this->apiResponse();
        }
        // data
        $user = User::getUserByEmail($request->email);
        if($user){
            $data = $this->userRepo->apiData($user);
            $this->setData($data);
            $this->setStatus('OK');
        }
        else{
            $this->responseWithError(  __('api.errors.invalid_data') );
        }
        return $this->apiResponse();
    }
}