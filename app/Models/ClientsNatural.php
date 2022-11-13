<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientsNatural extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clientsnatural';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','name','cpf','order_id','balance','password'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|alpha_numeric_space|min_length[1]',
        'cpf' =>  'required|is_unique[clientsnatural.cpf]'
    ];
    protected $validationMessages   = [
        'name' => ['required' => 'O nome é necessário para criar um novo usuário'],
        'cpf' => [
            'is_unique' => 'Este CPF já se encontra cadastrado',
            'required' => 'O CPF é necessário para continuar']];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
