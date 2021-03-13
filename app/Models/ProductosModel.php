<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table = "productos";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        "codigo",
        "nombre",
        "precio_venta",
        "precio_compra",
        "existencias",
        "stock_minimo",
        "inventariable",
        "id_unidad",
        "id_categoria",
        "activo",
    ];

    protected $useTimestamps = true;
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField = "deleted_at";

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function actualizaStock($id_producto, $cantidad)
    {
        $actual = $this->where('id', $id_producto)->first()['existencias'];

        $this->set('existencias', $actual + $cantidad);
        $this->where('id', $id_producto);
        $this->update();
    }
}
