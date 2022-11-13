<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        try {
            $key = Services::getSecretKey();

            $authHeader = $request->getServer('HTTP_AUTHORIZATION');

            if ($authHeader == null) {
                return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'O Token JWT não foi enviado para esta requisição');
            }

                $array = explode(' ', $authHeader);
                $jwt = $array[1];

            $jwt = JWT::decode($jwt, new Key($key, 'HS256'));

        } catch (\Exception $exception) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, 'Servidor Indisponivel, a validação não funcionou ' . $exception->getMessage());
        }
        return $jwt;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
