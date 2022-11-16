<?php

namespace App\Controllers;

use App\Models\Products;
use App\Util\DeleteCrudById;
use App\Util\EditGetView;
use App\Util\InsertNewDataInCrud;
use App\Util\UpdateCrud;
use CodeIgniter\Model;
use CodeIgniter\RESTful\ResourceController;

class ProductsController extends ResourceController
{
    private Model $product;
    private InsertNewDataInCrud $insertNewDataInCrud;
    private DeleteCrudById $deleteCrudById;
    private UpdateCrud $updateCrud;
    private EditGetView $editGetView;

    public function __construct()
    {
        $this->product = new Products();
        $this->deleteCrudById = new DeleteCrudById($this);
        $this->updateCrud = new UpdateCrud($this);
        $this->editGetView = new EditGetView($this);
        $this->insertNewDataInCrud = new InsertNewDataInCrud($this);

    }

    public function productsList()
    {
        $clients = $this->product->findAll();

        return $this->response->setJSON(['status' => $this->response->getStatusCode(),'message' => 'Você está acessando a lista de produtos!', $clients]);
    }
    public function create()
    {
        return $this->insertNewDataInCrud->create();
    }

    public function editProduct($id = null)
    {
        return $this->editGetView->editClient($id);
    }

    public function updateProduct($id = null)
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
        return $this->product;
    }


}

