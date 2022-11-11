<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientsJuridical extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clientsjuridical';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','trade_name','cnpj','order_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|alpha_numeric_space|min_length[1]',
        'cnpj' => 'required||is_unique[clients.juridical.cnpj]'
    ];
    protected $validationMessages   = [
        'name' => ['required' => 'O nome é necessário para criar um novo usuário'],
        'cnpj' => ['is_unique' => 'Este CNPJ já se encontra cadastrado']];
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
