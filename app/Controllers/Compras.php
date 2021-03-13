<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\TemporalCompraModel;
use App\Models\DetalleCompraModel;
use App\Models\ProductosModel;

class Compras extends BaseController
{
    protected $compras, $temporal_compra, $detalle_compra, $productos;
    protected $reglas;

    public function __construct()
    {
        $this->compras = new ComprasModel();
        $this->detalle_compra = new DetalleCompraModel();

        helper(['form']);
    }

    public function index($activo = 1)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data['titulo'] = 'Compras';
        $data['datos'] = $unidades;

        echo view('header');
        echo view('unidades/unidades', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        echo view('header');
        echo view('compras/nuevo');
        echo view('footer');
    }

    public function guarda()
    {
        $id_compra = $this->request->getPost('id_compra');
        
        $total = $this->request->getPost('total');

        $session = session();

        $id_usuario = $session->id_usuario;

        $id = $this->compras->insertaCompra($id_compra, $total, $id_usuario);

        $this->temporal_compra = new TemporalCompraModel();

        if($id){

            $detalles = $this->temporal_compra->porCompra($id_compra);

            foreach($detalles as $fila){

                $data = [
                    'id_compra' => $id,
                    'id_producto' => $fila['id_producto'],
                    'nombre' => $fila['nombre'],
                    'cantidad' => $fila['cantidad'],
                    'precio' => $fila['precio']
                ];

                $this->detalle_compra->save($data);

                $this->productos = new ProductosModel();
                $this->productos->actualizaStock($fila['id_producto'],$fila['cantidad']);


            }

            $this->temporal_compra->eliminarCompra($id_compra);

        }

        return redirect()->to(base_url('productos'));
    }

}
