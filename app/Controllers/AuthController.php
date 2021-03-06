<?php

namespace App\Controllers;

use App\Controllers\Controller;

use App\Models\User;
use App\Models\UserPermission;
use Respect\Validation\Validator as v;
use DateTime;

Class AuthController extends Controller
{
    public function login($request, $response)
    {
        if($request->isGet())
        return $this->container->view->render($response, 'login.twig');

        if(!$this->container->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password'))){
                return $response->withRedirect($this->container->router->pathFor('auth.login'));
            }
            
        return $response->withRedirect($this->container->router->pathFor('home'));

    }

    public function register($request, $response)
    {
        if($request->isGet())
            return $this->container->view->render($response, 'register.twig');

        $validation = $this->container->validator->validate($request,[
            'name'  => v::notEmpty()->alpha()->length(10), // Validação para não vim vazio, tem que ser alfanumérico e ter no minimo 10 Caracteres
            'email'  => v::notEmpty()->noWhitespace()->email(), // Validação de email
            'password' => v::notEmpty()->noWhitespace()
        ]);

        if($validation->failed()){
            return $response->withRedirect($this->container->router->pathFor('auth.register'));
        }

        // ajustando data
        $now = new \DateTime();
        $now->modify('+1 hour');
        $key = bin2hex(random_bytes(20));

       $user = User::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
            'confirmation_key' => $key,
            'confirmation_expires' => $now,
        ]);

        $user->permissions()->create(UserPermission::$defaults);

        $payload = [
            'name' => $user->name,
            'email' => $user->email,
            'confirmation' => $key
        ];

        $this->container->mail->send($payload, 'welcome.twig', 'Bem vindo ao BLOG '. $user->name, $payload);

        return $response->withRedirect($this->container->router->pathFor('auth.login'));
    }

    public function logout($request, $response) 
    {
      if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        return $response->withRedirect($this->container->router->pathFor('home'));
      }
    }

    public function confirmation($request, $response)
    {
        $user = User::where('confirmation_key', $request->getParam('confirmation'))->first();

        if(!$user){
            $this->container->flash->addMessage('error', 'A conta que você está tentando confirmar não existe.');
        }
       
        // Ver se o usuario esta dentro do prazo de confirmação 
        if (strtotime(date('d/m/Y H:i:s')) > strtotime($user->confirmation_expires)) {
            $this->container->flash->addMessage('error', "Parece que você demorou um pouco para 
                confirmar o e-mail em? Não tem problema,
                clique <a href='". $this->container->router->pathFor('auth.resend')."?email=".$user->email."'>aqui</a> para reenviar.");
        } else {
            $this->container->flash->addMessage('success', 'Conta confirmada com sucesso!');
            $user->is_confirmation = true;
            $user->save();
        }

        return $response->withRedirect($this->container->router->pathFor('auth.login'));
    }

    public function resend($request, $response)
    {
        if(empty($request->getParam('email'))) {
            $this->container->flash->addMessage('error', 'Houve um erro ao tentar processar a sua solicitação.');
            return $response->withRedirect($this->container->router->pathFor('auth.login'));
        }

        $now = new \Datetime(date('d/m/Y H:i:s'));
        $now->modify('+1 hour');
        $key = bin2hex(random_bytes(20));

        $user = User::where('email', $request->getParam('email'))->first();
        $user->confirmation_key = $key;
        $user->confirmation_expires = $now;
        $user->save();

        $payload = [
            'name' => $user->name,
            'email' => $user->email,
            'confirmation' => $key,
        ];

        $this->container->mail->send($payload, 'resend.twig', 'Reenvio de confirmação!', $payload);

        $this->container->flash->addMessage('success', 'Um novo e-mail de confirmação foi enviado com sucesso!');
        return $response->withRedirect($this->container->router->pathFor('auth.login'));
    }
}