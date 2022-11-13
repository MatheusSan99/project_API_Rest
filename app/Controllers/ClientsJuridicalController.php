<?php

namespace App\Controllers;

use App\Models\ClientsJuridical;
use App\Util\DeleteCrudById;
use App\Util\EditGetView;
use App\Util\InsertNewDataInCrud;
use App\Util\UpdateCrud;
use CodeIgniter\Model;
use CodeIgniter\RESTful\ResourceController;

class ClientsJuridicalController extends ResourceController
{
    private Model $client;
    private DeleteCrudById $deleteCrudById;
    private UpdateCrud $updateCrud;
    private EditGetView $editGetView;
    private InsertNewDataInCrud $insertNewDataInCrud;


    public function __construct()
    {
        $this->client = new ClientsJuridical();
        $this->deleteCrudById = new DeleteCrudById($this);
        $this->updateCrud = new UpdateCrud($this);
        $this->editGetView = new EditGetView($this);
        $this->insertNewDataInCrud = new InsertNewDataInCrud($this);
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

}
