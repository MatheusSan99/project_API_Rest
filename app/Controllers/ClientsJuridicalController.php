<?php

namespace App\Controllers;

use App\Models\ClientsJuridical;
use CodeIgniter\Model;

class ClientsJuridicalController extends BaseController
{
    private Model $client;

    public function __construct()
    {
        $this->client = new ClientsJuridical();
    }

    public function index()
    {
    }

    public function clientsList()
    {
        $clients = $this->client->findAll();

        return $this->response->setJSON($clients);
    }
}
