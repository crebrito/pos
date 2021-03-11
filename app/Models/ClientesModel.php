<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table = "clientes";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        "nombre",
        "direccion",
        "telefono",
        "correo",
        "activo",
    ];

    protected $useTimestamps = true;
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField = "deleted_at";

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}