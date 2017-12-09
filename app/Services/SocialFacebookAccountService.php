<?php
namespace App\Services;

use App\SocialFacebookAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use File;

class SocialFacebookAccountService{
    public function createOrGetUser(ProviderUser $providerUser){
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if($account){
            return $account->user;
        }

        else{
            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if(!$user){
                $providerUser->user['gender'] == 'male' ? $genero = 'Masculino' : $genero = 'Feminino';
                $nome = $providerUser->user['first_name'];
                $sobrenome = $providerUser->user['last_name'];

                $formatar_url = strtolower(str_replace(' ', '.', $nome . $sobrenome));
                $confere_url = User::where('url', $formatar_url)->count();
                $confere_url > 0 ? $url = $formatar_url . rand(1, 9999999) : $url = $formatar_url;

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'nome' => $nome,
                    'sobrenome' => $sobrenome,
                    'password' => bcrypt(rand(1, 99999)),
                    'foto' => $providerUser->getAvatar(),
                    'genero' => $genero,
                    'tipo_conta' => 'facebook',
                    'url' => $url,
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
