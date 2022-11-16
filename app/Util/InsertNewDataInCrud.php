<?php

namespace App\Util;

use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class InsertNewDataInCrud extends ResourceController
{
    private string $token = 'a';
    private Controller $crudTypeController;
    private InsertNewDataTryCatch $insertNewDataTryCatch;

    public function __construct(Controller $crudTypeController)
    {
        $this->crudTypeController = $crudTypeController;
        $this->insertNewDataTryCatch = new InsertNewDataTryCatch($this->crudTypeController);
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

            if ($this->crudTypeController->getRequest()->getPost('product_id') !== null) {
                $newClient['product_id'] = $this->crudTypeController->getRequest()->getPost('product_id');
            }

            if ($this->crudTypeController->getRequest()->getPost('client_id') !== null) {
                $newClient['client_id'] = $this->crudTypeController->getRequest()->getPost('client_id');
            }

            if ($this->crudTypeController->getRequest()->getPost('status') !== null) {
                $newClient['status'] = $this->crudTypeController->getRequest()->getPost('status');
            }
            if ($this->crudTypeController->getRequest()->getPost('total') !== null) {
                $newClient['total'] = $this->crudTypeController->getRequest()->getPost('total');
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
            echo $this->insertNewDataTryCatch->tryCatchValidation($newClient)->getJSON();
        }
            return false;
    }

}