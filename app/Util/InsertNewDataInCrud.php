<?php

namespace App\Util;

use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class InsertNewDataInCrud extends ResourceController
{
    private string $token = 'a';
    private Controller $crudTypeController;

    public function __construct(Controller $crudTypeController)
    {
        $this->crudTypeController = $crudTypeController;
    }

    public function create()
    {
        $response = [];

        $crud = $this->crudTypeController;
        if ($crud->request->getHeaderLine('token') == $this->token) {
            $newClient['name'] = $this->crudTypeController->getRequest()->getPost('name');
            $newClient['trade_name'] = $this->crudTypeController->getRequest()->getPost('trade_name');
            $newClient['cpf'] = $this->crudTypeController->getRequest()->getPost('cpf');
            $newClient['cnpj'] = $this->crudTypeController->getRequest()->getPost('cnpj');
            $newClient['adress'] = $this->crudTypeController->getRequest()->getPost('adress');

            try {
                if ($this->crudTypeController->getClient()->insert($newClient)) {
                    $response = [
                        'response' => 'Sucesso', 'msg' => 'Client Cadastrado Corretamente'
                    ];
                } else {
                    //caso não passe na validacão exibe uma mensagem com o erro
                    $response = [
                        'response' => 'Erro Ao Cadastrar Cliente',
                        'msg' => 'Ocorreu um Erro ao Salvar o Client, tente novamente',
                        'errors' => [$this->crudTypeController->getClient()->errors()]];
                }

                return $this->crudTypeController->getResponse()->setJSON($response);

            } catch (Exception $e) {
                $response = ['response' => 'error', 'msg' => 'erro ao Cadastrar cliente, excessão encontrada',
                    'errors' => $e->getMessage()];
            }
        }
        //caso o token seja invalido
        $response = ['response' => 'Erro de Token', 'msg' => 'Token Incorreto'];

        return $this->crudTypeController->getResponse()->setJSON($response);
    }
}