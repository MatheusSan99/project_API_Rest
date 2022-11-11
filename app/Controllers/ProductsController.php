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

    public function editProduct($id = null)
    {
        try {
            if ($id == null) {
                return $this->failValidationErrors('O ID é inválido');
            }
            $product = $this->product->find($id);

            if ($product == null) {
                return $this->failNotFound('Produto com o ID: ' . $id . ' Não Encontrado');
            }

            return $this->respond($product);

        }catch (Exception $exception) {
            return $this->failServerError('Erro no Servidor' . $exception->getMessage());
        }
    }

    public function updateProduct($id = null)
    {
        try {
            if ($id == null) {
                return $this->failValidationErrors('O ID passado é inválido');
            }
            $productVerified = $this->product->find($id);

            if ($productVerified == null) {
                return $this->failNotFound('Produto com o ID: ' . $id . ' Não Encontrado');
            }
            $product = $this->request->getJSON();

            if ($this->product->update($id,$product)) {
                $product->id = $id;
                return $this->respondUpdated($product);
            }
            return $this->failValidationErrors($this->product->validation->listErrors());
        } catch (Exception $exception) {
            return $this->failServerError('Ocorreu um problema no servidor ' . $exception->getMessage());
        }
    }

    public function delete($id = null)
    {
        {
            try {

                if ($id == null)
                    return $this->failValidationErrors('ID inválido');

                $productVerified = $this->product->find($id);
                if ($productVerified == null)
                    return $this->failNotFound('Produto com o ID : ' . $id . ' não encontrado');

                if ($this->product->delete($id)) :
                    return $this->respondDeleted($productVerified);
                else :
                    return $this->failServerError('Erro ao Excluir Produto');
                endif;
            } catch (Exception $e) {
                return $this->failServerError('Erro no Servidor' . $e->getMessage());
            }
        }
    }
}

