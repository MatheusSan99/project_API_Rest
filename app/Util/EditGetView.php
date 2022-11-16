<?php

namespace App\Util;

use App\Controllers\ClientsJuridicalController;
use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class EditGetView extends ResourceController
{

    private Controller $crudType;

    public function __construct(Controller $crudType)
    {
        $this->crudType = $crudType;
    }

    public function editClient($id = null)
    {
        try {
            if ($id == null) {
                return $this->crudType->failValidationErrors('O ID é inválido');
            }
            $product = $this->crudType->getClient()->find($id);

            if ($product == null) {
                return $this->crudType->failNotFound('Cliente com o ID: ' . $id . ' Não Encontrado');
            }

            return $this->crudType->getResponse()->setJSON(['status' => $this->crudType->getResponse()->getStatusCode(),'message' => 'Você está visualizando um Crud, para edita-lo, mude o link de edit para update e o metodo para PUT!',$product]);

        } catch (Exception $exception) {
            return $this->crudType->failServerError('Erro no Servidor' . $exception->getMessage());
        }
    }
}