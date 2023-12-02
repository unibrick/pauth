<?php

namespace Unibrick\PAuth\Actions;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialUserLogin
{
    public function handle(SocialUser $socialUser)
    {//

        //$refererHost = Arr::get(parse_url(url()->previous()),'host');
//        $socialUser->getId();
//        $socialUser->getName();
//        $socialUser->getAvatar();
//        $socialUser->getEmail();
//        $socialUser->getNickname();

        // $user->token
//dump(redirect()->back()->getTargetUrl());
        if (!$socialUser->getEmail()) {
            // todo вернуть ошибку, ибо в данных отсутствует электронная почта
            return redirect('login')->withErrors(['email' => 1231231]);
        }

        if ($user = User::where('email', $socialUser->getEmail())->first()) {
            $user->update([
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::password(8)),
                'name' => $socialUser->getName()
            ]);
            //todo update provider user data
        } else {
            $user = User::create(
                ['email' => $socialUser->getEmail()],
                [
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::password(8)),
                    'name' => $socialUser->getName()
                ]
            );
        }

        Auth::login($user);

    }
}
