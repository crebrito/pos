<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;
use App\Models\ProductosModel;
use App\Models\UnidadesModel;

class Productos extends BaseController
{
    protected $productos;
    protected $categorias;
    protected $unidades;
    protected $reglas;

    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->categorias = new CategoriasModel();
        $this->unidades = new UnidadesModel();

        helper(['form']);

        $this->reglas = [
            'codigo' => [
                'label' => 'Código',
                'rules' => 'required|is_unique[productos.codigo]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'is_unique' => 'El {field} {value} ya existe'
                ]
            ],
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
            'precio_venta' => [
                'label' => 'Precio de Venta',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
            'precio_compra' => [
                'label' => 'Precio de Compra',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
        ];
    }

    public function index($activo = 1)
    {
        $productos = $this->productos->where("activo", $activo)->findAll();
        $data["titulo"] = "Productos";
        $data["datos"] = $productos;

        echo view("header");
        echo view("productos/productos", $data);
        echo view("footer");
    }

    public function eliminados($activo = 0)
    {
        $productos = $this->productos->where("activo", $activo)->findAll();
        $data["titulo"] = "Productos Eliminadas";
        $data["datos"] = $productos;

        echo view("header");
        echo view("productos/eliminados", $data);
        echo view("footer");
    }

    public function nuevo()
    {
        $data["titulo"] = "Agregar Producto";
        $data["categorias"] = $this->categorias->where("activo", 1)->findAll();
        $data["unidades"] = $this->unidades->where("activo", 1)->findAll();

        echo view("header");
        echo view("productos/nuevo", $data);
        echo view("footer");
    }

    public function insertar()
    {

        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $data = [
                "codigo" => $this->request->getPost("codigo"),
                "nombre" => $this->request->getPost("nombre"),
                "id_unidad" => $this->request->getPost("id_unidad"),
                "id_categoria" => $this->request->getPost("id_categoria"),
                "precio_venta" => $this->request->getPost("precio_venta"),
                "precio_compra" => $this->request->getPost("precio_compra"),
                "stock_minimo" => $this->request->getPost("stock_minimo"),
                "inventariable" => $this->request->getPost("inventariable"),
                "existencias" => $this->request->getPost("existencias"),
            ];
            $this->productos->save($data);
            return redirect()->to(base_url() . "/productos");
        } else {
            $data["titulo"] = "Agregar Unidad";
            $data["validation"] = $this->validator;

            echo view("header");
            echo view("productos/nuevo", $data);
            echo view("footer");
        }
    }

    public function editar($id)
    {
        $data["titulo"] = "Editar Producto";
        $producto = $this->productos->where("id", $id)->first();
        $data["categorias"] = $this->categorias->where("activo", 1)->findAll();
        $data["unidades"] = $this->unidades->where("activo", 1)->findAll();
        $data["datos"] = $producto;

        echo view("header");
        echo view("productos/editar", $data);
        echo view("footer");
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $id = $this->request->getPost("id");
            $data = [
                "codigo" => $this->request->getPost("codigo"),
                "nombre" => $this->request->getPost("nombre"),
                "id_unidad" => $this->request->getPost("id_unidad"),
                "id_categoria" => $this->request->getPost("id_categoria"),
                "precio_venta" => $this->request->getPost("precio_venta"),
                "precio_compra" => $this->request->getPost("precio_compra"),
                "stock_minimo" => $this->request->getPost("stock_minimo"),
                "inventariable" => $this->request->getPost("inventariable"),
                "existencias" => $this->request->getPost("existencias"),
            ];
            $this->productos->update($id, $data);
            return redirect()->to(base_url() . "/productos");
        } else {
            $data["titulo"] = "Editar Producto";
            $producto = $this->productos->where("id", $this->request->getPost("id"))->first();
            $data["categorias"] = $this->categorias->where("activo", 1)->findAll();
            $data["unidades"] = $this->unidades->where("activo", 1)->findAll();
            $data["datos"] = $producto;
            $data["validation"] = $this->validator;

            echo view("header");
            echo view("productos/editar", $data);
            echo view("footer");
        }
    }

    public function eliminar($id)
    {
        $data = ["activo" => 0];
        $this->productos->update($id, $data);
        return redirect()->to(base_url() . "/productos");
    }

    public function reingresar($id)
    {
        $data = ["activo" => 1];
        $this->productos->update($id, $data);
        return redirect()->to(base_url() . "/productos");
    }
}
