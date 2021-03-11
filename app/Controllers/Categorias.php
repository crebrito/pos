<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;

class Categorias extends BaseController
{
    protected $categorias;
    protected $reglas;

    public function __construct()
    {
        $this->categorias = new CategoriasModel();

        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
        ];
    }

    public function index($activo = 1)
    {
        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $data['titulo'] = 'Categorías';
        $data['datos'] = $categorias;

        echo view('header');
        echo view('categorias/categorias', $data);
        echo view('footer');
    }

    public function eliminados($activo = 0)
    {
        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $data['titulo'] = 'Categorías Eliminadas';
        $data['datos'] = $categorias;

        echo view('header');
        echo view('categorias/eliminados', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        $data['titulo'] = 'Agregar Categoría';

        echo view('header');
        echo view('categorias/nuevo', $data);
        echo view('footer');
    }

    public function insertar()
    {
        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $data = ['nombre' => $this->request->getPost('nombre')];
            $this->categorias->save($data);
            return redirect()->to(base_url() . '/categorias');
        } else {
            $data['titulo'] = 'Agregar Categoría';
            $data['validation'] = $this->validator;

            echo view('header');
            echo view('categorias/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id)
    {
        $data['titulo'] = 'Editar Categoría';
        $unidad = $this->categorias->where('id', $id)->first();
        $data['datos'] = $unidad;

        echo view('header');
        echo view('categorias/editar', $data);
        echo view('footer');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $id = $this->request->getPost('id');
            $data = ['nombre' => $this->request->getPost('nombre')];
            $this->categorias->update($id, $data);
            return redirect()->to(base_url() . '/categorias');
        } else {
            $data['titulo'] = 'Editar Categoría';
            $data['validation'] = $this->validator;
            $categoria = $this->categorias->where('id', $this->request->getPost('id'))->first();
            $data['datos'] = $categoria;

            echo view('header');
            echo view('categorias/editar', $data);
            echo view('footer');
        }
    }

    public function eliminar($id)
    {
        $data = ['activo' => 0];
        $this->categorias->update($id, $data);
        return redirect()->to(base_url() . '/categorias');
    }

    public function reingresar($id)
    {
        $data = ['activo' => 1];
        $this->categorias->update($id, $data);
        return redirect()->to(base_url() . '/categorias');
    }
}
