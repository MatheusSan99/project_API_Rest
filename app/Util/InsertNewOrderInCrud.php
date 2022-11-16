<?php

namespace App\Util;

use App\Models\Clients;
use App\Models\Products;
use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class insertNewOrderInCrud extends ResourceController
{
    private string $token = 'a';
    private Controller $crudTypeController;
    private InsertNewDataTryCatch $insertNewDataTryCatch;
    private Clients $clients;
    private Products $products;

    /**
     * @param Controller $crudTypeController
     */
    public function __construct(Controller $crudTypeController)
    {
        $this->crudTypeController = $crudTypeController;
        $this->products = new Products();
        $this->clients = new Clients();
        $this->insertNewDataTryCatch = new InsertNewDataTryCatch($this->crudTypeController);
        helper('secure_password_helper');
    }

    public function insertNewOrderFunction()
    {
        $productCheck = $this->products->find($this->crudTypeController->getRequest()->getPost('product_id'));
        $clientCheck =  $this->clients->find($this->crudTypeController->getRequest()->getPost('client_id'));


        try {
            if (!$productCheck || !$clientCheck) {
                return $this->crudTypeController->getResponse()->setJSON(['status' => $this->crudTypeController->getResponse()->getStatusCode(),'message' => 'Um Dado que não existe foi informado, revise os campos por favor']);

            }
        } catch (Exception $exception) {
            $response = ['response' => 'error', 'msg' => 'erro ao Cadastrar os dados, excessão encontrada',
                'errors' => $exception->getMessage()];
        }

        $crud = $this->crudTypeController;
        if ($crud->request->getHeaderLine('token') == $this->token) {

            if ($this->crudTypeController->getRequest()->getPost('product_id') !== null) {
                $newOrder['product_id'] = $this->crudTypeController->getRequest()->getPost('product_id');
            }
            if ($this->crudTypeController->getRequest()->getPost('client_id') !== null) {
                $newOrder['client_id'] = $this->crudTypeController->getRequest()->getPost('client_id');
            }
            $newOrder['status'] = 1;

            echo $this->insertNewDataTryCatch->tryCatchValidation($newOrder)->getJSON();
        }
        return false;
    }
}