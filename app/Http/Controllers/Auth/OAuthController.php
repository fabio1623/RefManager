<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;

use Socialite;
use Auth;

class OAuthController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);

        $veolia = ends_with($user->email, '@veolia.com');
        $seureca = ends_with($user->email, '@seureca.com');
        $google = ends_with($user->email, '@gmail.com');

        if ($veolia || $seureca || $google) {
            $ddb_user = User::where('email', $user->email)->first();
            if ($ddb_user) {
                Auth::login($ddb_user);
                
                $ddb_user->avatar = $user->avatar;
                $ddb_user->save();

                return redirect()->intended('home');
            }
            else {
                $new_user = new User;
                $new_user->username = $user->name;
                $new_user->email = $user->email;
                $new_user->avatar = $user->avatar;

                $new_user->save();

                Auth::login($new_user);
                return redirect()->intended('home');
            }
        }
        else {
            return redirect()->action('UserController@getLoginError');
        }
    }
}