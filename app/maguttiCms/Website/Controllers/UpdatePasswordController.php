<?php

namespace App\maguttiCms\Website\Controllers;

use Auth;
use Input;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use App\maguttiCms\Website\Repos\Article\ArticleRepositoryInterface;
use App\maguttiCms\SeoTools\MaguttiCmsSeoTrait;


class UpdatePasswordController extends Controller

{
    protected ArticleRepositoryInterface $articleRepo;
    use MaguttiCmsSeoTrait;

    /**
     * @param ArticleRepositoryInterface $article
     *
     */

    public function __construct(ArticleRepositoryInterface $article)
    {
        $this->articleRepo = $article;
    }

    /**
     * @param Request $request
     *
     */
    public function update_password(Request $request)
    {

        $user = auth_user();

        $validator =Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $request) {
            if (!isset($request['current_password']) || !Hash::check($request['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        });

        if($validator->fails()){
            return redirect(url_locale('/users/profile').'#update-password')->withErrors($validator);
        };


        $article = $this->articleRepo->getBySlug('profile');

        $user->forceFill([
            'password' => request('password'),
        ])->save();
        session()->flash('success', trans('users.profile.update_password_success'));
        $this->setSeo($article);
        return view('website.users.profile', compact('article'));

    }

    /**
     * @return array
     */
    function passwordRules(): array
    {
        return ['required', 'string', 'confirmed', Password::defaults()];
    }
}
