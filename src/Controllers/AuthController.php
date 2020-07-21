<?php

namespace Tir\User\Controllers;

use Exception;
use Tir\Page\Entities\Page;
use Tir\Setting\Facades\Stg;
use Tir\User\Entities\User;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends BaseAuthController
{
    /**
     * Where to redirect users after login..
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('account.dashboard.index');
    }

    /**
     * The login URL.
     *
     * @return string
     */
    protected function loginUrl()
    {
        return route('login');
    }

    /**
     * Show login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view(config('crud.front-template').'::public.auth.login');
    }

    /**
     * Redirect the user to the given provider authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        if (! in_array($provider, app('enabled_social_login_providers'))) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the given provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        if (! in_array($provider, app('enabled_social_login_providers'))) {
            abort(404);
        }

        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->route('login');
        }

        if (User::registered($user->getEmail())) {
            auth()->login(
                User::findByEmail($user->getEmail())
            );

            return redirect($this->redirectTo());
        }

        [$firstName, $lastName] = $this->extractName($user->getName());

        $registeredUser = $this->auth->registerAndActivate([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $user->getEmail(),
            'password' => str_random(),
        ]);

        $this->assignCustomerRole($registeredUser);

        auth()->login($registeredUser);

        return redirect($this->redirectTo());
    }

    private function extractName($name)
    {
        return explode(' ', $name, 2);
    }

    /**
     * Show registrations form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        $privacyPageURL = Page::urlForPage(Stg::get('storefront_privacy_page'));

        return view(config('crud.front-template').'::public.auth.register', compact('privacyPageURL'));
    }

    /**
     * Show reset password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReset()
    {
        return view(config('crud.front-template').'::public.auth.reset.begin');
    }

    /**
     * Reset complete form route.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $code
     * @return string
     */
    protected function resetCompleteRoute($user, $code)
    {
        return route(config('crud.front-template').'::reset.complete', [$user->email, $code]);
    }

    /**
     * Password reset complete view.
     *
     * @return string
     */
    protected function resetCompleteView()
    {
        return view(config('crud.front-template').'::public.auth.reset.complete');
    }
}