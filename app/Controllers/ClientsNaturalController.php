<?php

namespace App\Controllers;

use App\Models\ClientsNatural;
use CodeIgniter\Model;

class ClientsNaturalController extends BaseController
{
    private Model $client;

    public function __construct()
    {
        $this->client = new ClientsNatural();
    }

    public function index()
    {
        //
    }
    public function clientsList()
    {
        $clients = $this->client->findAll();

        return $this->response->setJSON($clients);
    }
}
