<?php

namespace App\Models;

use CodeIgniter\Model;

class Clients extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clients';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','name','trade_name','cnpj','adress','city','client_type_id','order_id','cpf','order_id','balance','password'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'alpha_numeric_space|min_length[1]',
        'cpf' =>  'permit_empty|is_unique[clients.cpf]',
        'cnpj' =>  'permit_empty|is_unique[clients.cnpj]',
    ];
    protected $validationMessages   = [
        'cpf' => [
            'is_unique' => 'Este CPF já se encontra cadastrado'],
        'cnpj' => [
            'is_unique' => 'Este CNPJ já se encontra cadastrado']];
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
