<?php

namespace App\Controllers;

use App\Models\Clients;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Exception;
use Firebase\JWT\JWT;

class Auth extends ResourceController
{
    public function __construct()
    {
        helper('secure_password_helper');
    }

    public function login()
    {
        try {
            $username = $this->request->getPost('name');
            $password = $this->request->getPost('password');
            $user = new Clients();

            $userValidation = $user->where('name', $username)->first();

            if ($userValidation == null) {
                return $this->failNotFound("Usuário não encontrado no sistema");
            }
            if (verifyPassword($password, $userValidation["password"]) || $password == $userValidation['password']) {
                $jwt = $this->generateJWT($userValidation);

                return $this->respond(['Token' => $jwt], 201);
            }
                return $this->failValidationErrors('Senha inválida');

        }catch (Exception $exception) {
            return $this->failServerError("Erro no Servidor" . $exception->getMessage());
        }
    }

    protected function generateJWT($user): string
    {
        //Eu o token tem expiraçao de 2 minutos a partir do momento que foi gerado
        $key = Services::getSecretKey();
        $time = time();
        $payload = [
            'aud' => base_url(),
            'iat' => $time,
            'exp' =>  $time + 22120,
            'data' => [
                'name' => $user['name'],
                'expiration' => $time
            ]
        ];

        return JWT::encode($payload, $key, 'HS256');

    }
}
