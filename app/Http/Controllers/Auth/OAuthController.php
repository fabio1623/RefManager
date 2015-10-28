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
        /*try {
            $user = Socialite::driver('google')->user();
            $user->getName();
            $user->getEmail();
            $user->getAvatar();
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
             dd($e->response);
        }*/

        $user = Socialite::driver('google')->user();
        dd($user);
        // All Providers
        $user->getName();
        $user->getEmail();
        $user->getAvatar();


        


        /*if (Auth::attempt(['email' => $user->email])) {
            // Authentication passed...
            return redirect()->intended('subservice/index');
        }*/


        /*$ddb_user = User::where('email', $user->email)->first();

        if ($ddb_user) {
            return redirect()->intended('subservice/index');
        }*/
    }
}