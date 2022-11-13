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
        helper('secure_password_helper');
    }

    public function create()
    {
        $response = [];

        $crud = $this->crudTypeController;

        if ($crud->request->getHeaderLine('token') == $this->token) {

//validacao para saber se foi setado as informacoes pelo post, e se foi define como valor da variavel.

            if ($this->crudTypeController->getRequest()->getPost('name') !== null) {
                $newClient['name'] = $this->crudTypeController->getRequest()->getPost('name');
            }

            if ($this->crudTypeController->getRequest()->getPost('password') !== null) {
                $newClient['password'] = $this->crudTypeController->getRequest()->getPost('password');
            }

            if (isset($newClient['password'])) {
                $newClient['password'] = hashPassword($newClient['password']);
            }

            if ($this->crudTypeController->getRequest()->getPost('cpf') !== null) {
                $newClient['cpf'] = $this->crudTypeController->getRequest()->getPost('cpf');
            }
            if ($this->crudTypeController->getRequest()->getPost('description') !== null) {
                $newClient['description'] = $this->crudTypeController->getRequest()->getPost('description');
            }
            if ($this->crudTypeController->getRequest()->getPost('price') !== null) {
                $newClient['price'] = $this->crudTypeController->getRequest()->getPost('price');
            }
            if ($this->crudTypeController->getRequest()->getPost('stock') !== null) {
                $newClient['stock'] = $this->crudTypeController->getRequest()->getPost('stock');
            }
            if ($this->crudTypeController->getRequest()->getPost('adress') !== null) {
                $newClient['adress'] = $this->crudTypeController->getRequest()->getPost('adress');
            }

            try {
                if ($this->crudTypeController->getClient()->insert($newClient)) {
                    $response = [
                        'response' => 'Sucesso', 'msg' => 'Você Cadastrou o dado Corretamente'
                    ];
                } else {
                    //caso não passe na validacão exibe uma mensagem com o erro
                    $response = [
                        'response' => 'Erro Ao Cadastrar os Dados',
                        'msg' => 'Ocorreu um Erro ao Salvar os Dados, tente novamente',
                        'errors' => [$this->crudTypeController->getClient()->errors()]];
                }

                return $this->crudTypeController->getResponse()->setJSON(['status' => $this->crudTypeController->getResponse()->getStatusCode(),'message' => 'Você cadastrou um dado novo', $response]);


            } catch (Exception $e) {
                $response = ['response' => 'error', 'msg' => 'erro ao Cadastrar os dados, excessão encontrada',
                    'errors' => $e->getMessage()];
            }
        }
        //caso o token seja invalido
        $response = ['response' => 'Erro de Token', 'msg' => 'Token Incorreto'];

        return $this->crudTypeController->getResponse()->setJSON($response);
    }
}