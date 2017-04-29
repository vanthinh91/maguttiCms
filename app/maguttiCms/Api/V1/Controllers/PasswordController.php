<?php namespace App\MaguttiCms\Api\V1\Controllers;
use Validator;
use Illuminate\Http\Request;

use App\User;
use App\MaguttiCms\Website\Repos\User\UserRepositoryInterface;

/**
 * Class AuthenticateController
 * @package App\MaguttiCms\Api\V1\Controllers
 */
class PasswordController extends ApiController
{
    protected $userRepo;
       /**
     * PasswordController constructor.
     * @param UserRepositoryInterface $article
     */

    public function __construct(UserRepositoryInterface $user )
    {
        $this->userRepo = $user;

    }
    public function forgot(Request $request)
    {

        $validator = $this->validator('password',$request);
        if ($validator->fails()) {
            $this->setMsg( __('api.errors.invalid_data')  );
            $this->setHttpStatus(422);
        }
        else {
            // prende dalla richiesta le credenziali di accesso
            $user = User::getUserByEmail($request->email);
            if($user){
                $user->generateNewPassword();
                $this->setStatus('OK');
                $this->setMsg(__('api.messages.password_sent') );
            }
            else{
                $this->setMsg( __('api.errors.email_user') );
                $this->setHttpStatus(422);
            }
        }
        return $this->apiResponse();
    }


    public function changePassword(Request $request)
    {
        $validator = $this->validator('change_password',$request);
        if ($validator->fails()) {
            $this->setMsg( __('api.errors.invalid_data')  );
            $this->setHttpStatus(422);
            $this->setError(true);
        }
        else {
            $user = $this->userRepo->getUserByToken();
            $user->updatePassword($request->password);
            $this->setStatus('OK');
            $this->setMsg( __('api.messages.password_update')  );
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

    public function validator($action,Request $request)
    {
        return Validator::make($request->all(),
           config('laraCms.api.form_validation.'.$action)
        );
    }
}