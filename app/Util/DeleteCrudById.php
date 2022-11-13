<?php

namespace App\Util;

use App\Controllers\ClientsJuridicalController;
use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class DeleteCrudById extends ResourceController
{

    private Controller $clientType;

    public function __construct(Controller $clientType)
    {
        $this->clientType = $clientType;
    }

    public function delete($id = null)
    {
        try {
            if ($id == null)
                return $this->clientType->failValidationErrors('ID inválido');

            $clientVerified = $this->clientType->getClient()->find($id);
            if ($clientVerified == null)
                return $this->clientType->failNotFound('Cliente com o ID : ' . $id . ' não encontrado');

            if ($this->clientType->getClient()->delete($id)) :
                return $this->clientType->respondDeleted(['status'=>$this->clientType->getResponse()->getStatusCode(),'message' => 'Você apagou com sucesso, veja os dados que foram excluidos','data' => $clientVerified]);
            else :
                return $this->clientType->failServerError('Erro ao Excluir Cliente');
            endif;
        } catch (Exception $e) {
            return $this->clientType->failServerError('Erro no Servidor' . $e->getMessage());
        }
    }
}