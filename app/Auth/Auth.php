<?php

namespace App\Auth;

use App\Models\User;

class Auth
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
    // Preciso pegar o usuario logado
    public function user()
    {
        if (isset($_SESSION['user']))
        //FIND para procurar direto pelo id se tiver sessão setada
            return User::find($_SESSION['user']);
    }
    // Saber se o usuario ta logado
    public function check()
    {
        return isset($_SESSION['user']);
    }
    // tentativas de login
    public function attempt(string $email, string $password)
    {
        // Aqui é feito a consulta do email
        $user = User::where('email', $email)->first();

        //Aqui ele verifica se o usuario existe e verifica se a senha esta correta
        if (!$user || !password_verify($password, $user->password)) {
            // se não, aqui manda uma mensagem de error.
            $this->container->flash->addMessage('error', 'Suas credenciais parecem está erradas! Por fravor, verificar.');
            return false;
        }

        $_SESSION['user'] = $user->id;

        return true;
    }
}
