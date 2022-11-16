<?php

namespace App\Util;

use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class InsertNewDataTryCatch extends  ResourceController

{
    private Controller $crudTypeController;

    /**
     * @param Controller $crudTypeController
     */
    public function __construct(Controller $crudTypeController)
    {
        $this->crudTypeController = $crudTypeController;
    }

    public function tryCatchValidation($newClient)
    {
        try {
            if ($this->crudTypeController->getClient()->insert($newClient)) {
                $response = [
                    'response' => 'Sucesso', 'msg' => 'Você Cadastrou o dado Corretamente'
                ];
            } else {
                //caso não passe na validacão exibe uma mensagem com o erro
                $response = [
                    'response' => 'Erro Ao Cadastrar os Dados',
                    'msg' => 'Ocorreu um Erro ao Salvar os Dados, tente novamente',
                    'errors' => [$this->crudTypeController->getClient()->errors()]];
            }

            return $this->crudTypeController->getResponse()->setJSON(['status' => $this->crudTypeController->getResponse()->getStatusCode(),'message' => 'Você Está cadastrando um dado novo', $response]);


        } catch (Exception $e) {
            $response = ['response' => 'error', 'msg' => 'erro ao Cadastrar os dados, excessão encontrada',
                'errors' => $e->getMessage()];
        }

         //caso o token seja invalido
        $response = ['response' => 'Erro de Token', 'msg' => 'Token Incorreto'];

        return $this->crudTypeController->getResponse()->setJSON($response);
    }
}