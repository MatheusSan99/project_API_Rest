<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientsNatural;
use App\Models\Orders;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class OrdersController extends ResourceController
{
    public function __construct()
    {
        $this->model = new Orders();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        
    }

    public function edit($id = null)
    {
        
    }

    public function update($id = null)
    {
        
    }

    public function delete($id = null)
    {
        
    }
    public function clientOrdersList($id = null)
    {
        try {
            $client = new ClientsNatural();

            if ($id == null) {
                return $this->failValidationErrors("Id Inválido");
            }
            $client = $client->find($id);

            if ($client == null) {
                return $this->failNotFound("Cliente não encontrado");
            }
            $order = $this->model->clientOrders($id);

            return $this->respond($order);

        } catch (Exception $exception) {
            return $this->failServerError('Ocorreu um problema no servidor!');
        }
    }
}
