<?php

namespace App\Util;

use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class InsertNewClient extends ResourceController
{
    private string $token = 'a';
    private Controller $crudTypeController;
    private InsertNewDataTryCatch $insertNewDataTryCatch;

    /**
     * @param Controller $crudTypeController
     */
    public function __construct(Controller $crudTypeController)
    {
        $this->crudTypeController = $crudTypeController;
        $this->insertNewDataTryCatch = new InsertNewDataTryCatch($this->crudTypeController);
        helper('secure_password_helper');
    }

    public function insertNewClientFunction()
    {

        $crud = $this->crudTypeController;
        if ($crud->request->getHeaderLine('token') == $this->token) {
            //validacao para saber se foi setado as informacoes pelo post, e se foi define como valor da variavel.

            if ($crud->getRequest()->getPost('client_type_id') !== null) {
                $newClient['client_type_id'] = $this->crudTypeController->getRequest()->getPost('client_type_id');
            }

            if ($crud->getRequest()->getPost('name') !== null) {
                $newClient['name'] = $this->crudTypeController->getRequest()->getPost('name');
            }

            if ($crud->getRequest()->getPost('cpf') !== null) {
                $newClient['cpf'] = $this->crudTypeController->getRequest()->getPost('cpf');
            }
            $nameCheck = $crud->getRequest()->getPost('name');
            $cpfCheck = $crud->getRequest()->getPost('cpf');

                if ($newClient['client_type_id'] == 1) {
                    if ($nameCheck == null || $cpfCheck == null) {

                        return $crud->getResponse()->setJSON(['status' => $crud->getResponse()->getStatusCode(),'message' => 'Os clientes Tipo 1 precisam ter Nome e CPF']);
                    }
                }

            if ($newClient['client_type_id'] == 2) {
                if ($nameCheck == null || $cpfCheck == null) {

                    return $crud->getResponse()->setJSON(['status' => $crud->getResponse()->getStatusCode(),'message' => 'Os clientes Tipo 2 precisam ter Nome Fantasia e CNPJ']);
                }
            }


            if ($crud->getRequest()->getPost('trade_name') !== null) {
                $newClient['trade_name'] = $crud->getRequest()->getPost('trade_name');
            }

            if ($crud->getRequest()->getPost('cnpj') !== null) {
                $newClient['cnpj'] = $crud->getRequest()->getPost('cnpj');
            }
            if ($crud->getRequest()->getPost('adress') !== null) {
                $newClient['adress'] = $crud->getRequest()->getPost('adress');
            }

            if ($crud->getRequest()->getPost('password') !== null) {
                $newClient['password'] = $crud->getRequest()->getPost('password');
            }
            if (isset($newClient['password'])) {
                $newClient['password'] = hashPassword($newClient['password']);
            }
            echo $this->insertNewDataTryCatch->tryCatchValidation($newClient)->getJSON();
        }
            return false;
    }
}
