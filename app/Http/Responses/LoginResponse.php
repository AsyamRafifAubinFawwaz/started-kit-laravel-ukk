<?php

namespace App\Http\Responses;

use App\Constants\UserConst;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user->access_type === UserConst::ADMIN) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(config('fortify.home'));
    }
}
