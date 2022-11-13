<?php

namespace App\Util;

use App\Controllers\ClientsJuridicalController;
use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class UpdateCrud extends ResourceController
{

    private Controller $crudType;

    public function __construct(Controller $crudType)
    {
        $this->crudType = $crudType;
    }

    public function updateCrud($id = null)
    {
        try {
            if ($id == null) {
                return $this->crudType->failValidationErrors('O ID passado é inválido');
            }
            $clientVerified = $this->crudType->getClient()->find($id);

            if ($clientVerified == null) {
                return $this->crudType->failNotFound('O cadastro com o ID: ' . $id . ' Não foi Encontrado');
            }
            $client = $this->crudType->getRequest()->getJSON();

            if ($this->crudType->getClient()->update($id, $client)) {
                $client->id = $id;
                return $this->crudType->respondUpdated(['status'=>$this->crudType->getResponse()->getStatusCode(),'message' => 'Você editou com sucesso, veja os dados atualizados abaixo','data' => $client]);
            }
        } catch (Exception $exception) {
            return $this->crudType->failServerError('Ocorreu um problema no servidor ' . $exception->getMessage());
        }
        return $this->crudType->failValidationErrors($this->crudType->getClient()->validation->listErrors());
    }
}