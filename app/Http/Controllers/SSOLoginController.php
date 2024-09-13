<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
class SSOLoginController extends Controller
{

    public function redirect(Request $request)
    {
        if ($request->filled('error')) {
            return redirect(RouteServiceProvider::HOME);
        }

        $provider = $request->route('provider');
        $driver = ($provider == 'linkedin') ? 'linkedin-openid' : $provider;
        return Socialite::driver($driver)->redirect();
    }

    public function callback(Request $request)
    {
        if ($request->filled('error')) {
            return redirect(RouteServiceProvider::HOME);
        }

        $provider = ($request->route('provider') == 'linkedin') ? 'linkedin-openid' : $request->route('provider');
        $userProvider = Socialite::driver($provider)->stateless()->user();
        $user = User::where('email', $userProvider->email)->first();

        // Initialisation de la variable pour vérifier si c'est une nouvelle connexion
        $isNewUser = false;

        if (!$user) {
            $username = str_replace(' ', '_', strtolower($userProvider->name));
            $user = User::create([
                'name' => $userProvider->name ? : $userProvider->nickname ,
                'username' => $username ? : $userProvider->nickname,
                'email' => $userProvider->email,
                'password' => bcrypt(rand(100000, 999999)),
            ]);

            

            // Marquer comme nouvel utilisateur
            $isNewUser = true;
        }

        Auth::login($user);
        
        // Rediriger les nouveaux utilisateurs vers la route spécifique
        if ($isNewUser) {
            return redirect()->route('contacts.complete');
        }

        return redirect(RouteServiceProvider::HOME);
    }

}
