<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;

use Socialite;
use Auth;
use App\Subsidiary;

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

        $gmail = 'sarmentopedrofabio@gmail.com';
        $seureca = ends_with($user->email, '@seureca.com');
        $veolia = ends_with($user->email, '@veolia.com');
        $epas = ends_with($user->email, '@epas.be');

        if ($user->email == $gmail || $seureca || $veolia || $epas) {
            $ddb_user = User::where('email', $user->email)->first();
            if ($ddb_user) {
                Auth::login($ddb_user);

                $ddb_user->avatar = $user->avatar;
                //Temporary functionality
                // if ($ddb_user->username == '') {
                //     $username = strstr($user->email, '@', true);
                //     $ddb_user->username = $username;
                // }
                //Temporary functionality
                $ddb_user->save();

                // if ($ddb_user->profile == 'Basic user') {
                //     return redirect()->action('ReferenceController@index');
                // }
                // else {
                //     return redirect()->intended('home');
                // }
                return redirect()->intended('home');
            }
            else {
                $domain = substr($user->email, strpos($user->email, "@") + 1);
                $subsidiary_name = strstr($domain, '.', true);
                $subsidiary_in_db = Subsidiary::where('name', $subsidiary_name)->first();

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

                if ($subsidiary_in_db) {
                    $new_user->subsidiary_id = $subsidiary_in_db->id;
                }
                else {
                    $new_subsidiary = new Subsidiary;
                    $new_subsidiary->name = strtoupper($subsidiary_name);
                    $new_subsidiary->save();

                    $new_user->subsidiary_id = $new_subsidiary->id;
                }

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
