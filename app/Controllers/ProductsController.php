<?php

namespace App\Controllers;

use App\Models\Products;
use CodeIgniter\Model;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ProductsController extends ResourceController
{
    private Model $product;
    private $token = '123';

    public function __construct()
    {
        $this->product = new Products();
    }

    private function _tokenValidation()
    {
        return $this->request->getHeaderLine('token') == $this->token;
    }

    public function productsList()
    {
        $clients = $this->product->findAll();

        return $this->response->setJSON($clients);
    }
    public function createNewProduct()
    {
        $response = [];

        if ($this->_tokenValidation()) {
            $newProduct['name'] = $this->request->getPost('name');
            $newProduct['slug'] = $this->request->getPost('name');
            $newProduct['description'] = $this->request->getPost('description');
            $newProduct['price'] = $this->request->getPost('price');
            $newProduct['stock'] = $this->request->getPost('stock');

            try {
                if ($this->product->insert($newProduct)) {
                    $response = [
                        'response' => 'sucess', 'msg' => 'Produto Inserido Corretamente'
                    ];
                }
                else {
                    //caso não passe na validacão exibe uma mensagem com o erro
                    $response = [
                        'response' => 'Erro Ao Cadastrar Produto',
                        'msg' => 'Ocorreu um Erro ao Salvar o produto, tente novamente',
                        'errors' => [$this->product->errors()]];
                }
                return $this->response->setJSON($response);

            }catch (Exception $e) {
                $response = ['response' => 'error', 'msg' => 'erro ao salvar produto, excessão encontrada',
                    'errors' => $e->getMessage()];
            }
        }
        //caso o token seja invalido
        $response = ['response' => 'Erro de Token','msg' => 'O Token Utilizado é inválido'];

        return $this->response->setJSON($response);
    }
}

