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
            $newClient['balance'] = $this->crudTypeController->getRequest()->getPost('balance');
            $newClient['trade_name'] = $this->crudTypeController->getRequest()->getPost('trade_name');
            $newClient['cpf'] = $this->crudTypeController->getRequest()->getPost('cpf');
            $newClient['description'] = $this->crudTypeController->getRequest()->getPost('description');
            $newClient['price'] = $this->crudTypeController->getRequest()->getPost('price');
            $newClient['stock'] = $this->crudTypeController->getRequest()->getPost('stock');
            $newClient['cnpj'] = $this->crudTypeController->getRequest()->getPost('cnpj');
            $newClient['adress'] = $this->crudTypeController->getRequest()->getPost('adress');

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

                return $this->crudTypeController->getResponse()->setJSON($response);

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