<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientesModel;

class Clientes extends BaseController
{
    protected $clientes;
    protected $categorias;
    protected $unidades;
    protected $reglas;

    public function __construct()
    {
        $this->clientes = new ClientesModel();

        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
        ];
    }

    public function index($activo = 1)
    {
        $clientes = $this->clientes->where("activo", $activo)->findAll();
        $data["titulo"] = "Clientes";
        $data["datos"] = $clientes;

        echo view("header");
        echo view("clientes/clientes", $data);
        echo view("footer");
    }

    public function eliminados($activo = 0)
    {
        $clientes = $this->clientes->where("activo", $activo)->findAll();
        $data["titulo"] = "Clientes Eliminados";
        $data["datos"] = $clientes;

        echo view("header");
        echo view("clientes/eliminados", $data);
        echo view("footer");
    }

    public function nuevo()
    {
        $data["titulo"] = "Agregar Cliente";

        echo view("header");
        echo view("clientes/nuevo", $data);
        echo view("footer");
    }

    public function insertar()
    {

        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $data = [
                "nombre" => $this->request->getPost("nombre"),
                "direccion" => $this->request->getPost("direccion"),
                "telefono" => $this->request->getPost("telefono"),
                "correo" => $this->request->getPost("correo"),
            ];
            $this->clientes->save($data);
            return redirect()->to(base_url() . "/clientes");
        } else {
            $data["titulo"] = "Agregar Cliente";
            $data["validation"] = $this->validator;

            echo view("header");
            echo view("clientes/nuevo", $data);
            echo view("footer");
        }
    }

    public function editar($id)
    {
        $data["titulo"] = "Editar Cliente";
        $cliente = $this->clientes->where("id", $id)->first();
        $data["datos"] = $cliente;

        echo view("header");
        echo view("clientes/editar", $data);
        echo view("footer");
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $id = $this->request->getPost("id");
            $data = [
                "nombre" => $this->request->getPost("nombre"),
                "direccion" => $this->request->getPost("direccion"),
                "telefono" => $this->request->getPost("telefono"),
                "correo" => $this->request->getPost("correo"),
            ];
            $this->clientes->update($id, $data);
            return redirect()->to(base_url() . "/clientes");
        } else {
            $data["titulo"] = "Editar Cliente";
            $cliente = $this->clientes->where("id", $this->request->getPost("id"))->first();
            $data["datos"] = $cliente;
            $data["validation"] = $this->validator;

            echo view("header");
            echo view("clientes/editar", $data);
            echo view("footer");
        }
    }

    public function eliminar($id)
    {
        $data = ["activo" => 0];
        $this->clientes->update($id, $data);
        return redirect()->to(base_url() . "/clientes");
    }

    public function reingresar($id)
    {
        $data = ["activo" => 1];
        $this->clientes->update($id, $data);
        return redirect()->to(base_url() . "/clientes");
    }
}
