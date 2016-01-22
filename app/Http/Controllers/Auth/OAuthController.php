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

        $gmail = ends_with($user->email, '@gmail.com');
        $seureca = ends_with($user->email, '@seureca.com');
        $veolia = ends_with($user->email, '@veolia.com');

        if ($gmail || $seureca || $veolia) {
            $ddb_user = User::where('email', $user->email)->first();
            if ($ddb_user) {
                Auth::login($ddb_user);
                
                $ddb_user->avatar = $user->avatar;
                //Temporary functionality
                if ($ddb_user->username == '') {
                    $username = strstr($user->email, '@', true);
                    $ddb_user->username = $username;
                }
                //Temporary functionality
                $ddb_user->save();

                return redirect()->intended('home');
            }
            else {
                $new_user = new User;
                if ($user->name != '') {
                    $new_user->username = $user->name;
                }
                else {
                    $username = strstr($user->email, '@', true);
                    $new_user->username = $username;
                }
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