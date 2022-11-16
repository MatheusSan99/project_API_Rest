<?php

namespace App\Controllers;

use App\Models\Clients;
use App\Models\Orders;
use CodeIgniter\Model;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Util\insertNewOrderInCrud;
class OrdersController extends ResourceController
{
    private insertNewOrderInCrud $insertNewOrderInCrud;
    private Orders $orders;

    public function __construct()
    {
        $this->orders = new Orders();
        $this->insertNewOrderInCrud = new insertNewOrderInCrud($this);
    }

    public function ordersList()
    {
        $orders = $this->orders->findAll();

        return $this->response->setJSON($orders);
    }

    public function create()
    {
        return $this->insertNewOrderInCrud->insertNewOrderFunction();
    }

    public function clientOrdersList($id = null)
    {
        try {
            $client = new Clients();

            if ($id == null) {
                return $this->failValidationErrors("Id Inválido");
            }
            $client = $client->find($id);

            if ($client == null) {
                return $this->failNotFound("Cliente não encontrado");
            }
            $orders = $this->orders->findAll();
            $orderList = [];
            foreach ($orders as $order) {
                if ($order['client_id'] == $id) {
                    $orderList[] = $order;
                }
            }
            $response = $this->response->setJSON($orderList);
            return $response;

        } catch (Exception $exception) {
            return $this->failServerError('Ocorreu um problema no servidor!');
        }
    }
    /**
     * @return object
     */
    public function getClient(): object
    {
        return $this->model;
    }
}
