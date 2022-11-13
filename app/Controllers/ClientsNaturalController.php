<?php

namespace App\Controllers;

use App\Models\ClientsNatural;
use App\Models\Orders;
use App\Models\Products;
use App\Util\DeleteCrudById;
use App\Util\EditGetView;
use App\Util\InsertNewDataInCrud;
use App\Util\UpdateCrud;
use CodeIgniter\Controller;
use CodeIgniter\Model;
use CodeIgniter\RESTful\ResourceController;

class ClientsNaturalController extends ResourceController
{
    private Model $client;
    private Controller $controller;
    private DeleteCrudById $deleteCrudById;
    private UpdateCrud $updateCrud;
    private EditGetView $editGetView;
    private InsertNewDataInCrud $insertNewDataInCrud;


    public function __construct()
    {
        $this->controller = new Controller();
        $this->client = new ClientsNatural();
        helper('secure_password_helper');
        $this->deleteCrudById = new DeleteCrudById($this);
        $this->updateCrud = new UpdateCrud($this);
        $this->editGetView = new EditGetView($this);
        $this->insertNewDataInCrud = new InsertNewDataInCrud($this);
    }

    public function newOrder()
    {
        $client = $this->client;
        $product = new Products();
        $order = new Orders();
        $newData['client_id'] = $this->controller->getRequest()->getPost    ('client_id');
        $newData['product_id'] = $this->controller->getRequest()->getPost('product_id');
        $product = $product->find($newData['product_id']);
        $client = $client->find($newData['client_id']);


        $order = $order->insert(['status' => 'Pedido Completo', 'product_id' => $newData['product_id'],'total' => $product['price'],'client_id' => $newData['client_id']]);
    }

    public function clientsList()
    {
        $clients = $this->client->findAll();

        return $this->response->setJSON($clients);
    }

    public function create()
    {
        return $this->insertNewDataInCrud->create();
    }

    public function editClient($id = null)
    {
        return $this->editGetView->editClient($id);
    }

    public function updateClient($id = null)
    {
        return $this->updateCrud->updateCrud($id);
    }

    public function delete($id = null)
    {
        return $this->deleteCrudById->delete($id);
    }

    /**
     * @return Model
     */
    public function getClient(): Model
    {
        return $this->client;
    }

    /**
     * @return string
     */

}
