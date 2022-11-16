<?php

namespace App\Controllers;

use App\Models\Clients;
use App\Models\Orders;
use App\Models\Products;
use App\Util\DeleteCrudById;
use App\Util\EditGetView;
use App\Util\InsertNewDataInCrud;
use App\Util\InsertNewClient;
use App\Util\UpdateCrud;
use CodeIgniter\Model;
use CodeIgniter\RESTful\ResourceController;
use ReflectionException;

class ClientsController extends ResourceController
{
    private Clients $client;
    private DeleteCrudById $deleteCrudById;
    private UpdateCrud $updateCrud;
    private EditGetView $editGetView;
    private InsertNewClient $insertNewClient;


    public function __construct()
    {
        $this->client = new Clients();
        helper('secure_password_helper');
        $this->deleteCrudById = new DeleteCrudById($this);
        $this->updateCrud = new UpdateCrud($this);
        $this->editGetView = new EditGetView($this);
        $this->insertNewClient = new InsertNewClient($this);
    }

    /**
     * @throws ReflectionException
     */
    public function newOrder()
    {
        $client = $this->client;
        $product = new Products();
        $order = new Orders();
        $product = $product->find($this->request->getPost('product_id'));
        $client = $client->find($this->request->getPost('client_id'));

        $order->insert([
            'status' => 'Pedido Completo',
            'product_id' => $product['id'],
            'client_id' => $client['id'],
            'total' => $product['price'],
            ]);
    }

    public function clientsList()
    {
        $clients = $this->client->findAll();

        return $this->response->setJSON($clients);
    }

    public function create()
    {
        $this->insertNewClient->insertNewClientFunction();
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
