<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnidadesModel;

class Unidades extends BaseController
{
    protected $unidades;
    protected $reglas;

    public function __construct()
    {
        $this->unidades = new UnidadesModel();

        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
            'nombre_corto' => [
                'label' => 'Nombre Corto',
                'rules' => 'required|max_length[10]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El texto ({value}) escrito en el campo {field} es mayor a {param} caracteres'
                ]
            ]
        ];
    }

    public function index($activo = 1)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data['titulo'] = 'Unidades';
        $data['datos'] = $unidades;

        echo view('header');
        echo view('unidades/unidades', $data);
        echo view('footer');
    }

    public function eliminados($activo = 0)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data['titulo'] = 'Unidades Eliminadas';
        $data['datos'] = $unidades;

        echo view('header');
        echo view('unidades/eliminados', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        $data['titulo'] = 'Agregar Unidad';

        echo view('header');
        echo view('unidades/nuevo', $data);
        echo view('footer');
    }

    public function insertar()
    {

        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $data = ['nombre' => $this->request->getPost('nombre'), 'nombre_corto' => $this->request->getPost('nombre_corto')];
            $this->unidades->save($data);
            return redirect()->to(base_url() . '/unidades');
        } else {
            $data['titulo'] = 'Agregar Unidad';
            $data['validation'] = $this->validator;

            echo view('header');
            echo view('unidades/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id)
    {
        $data['titulo'] = 'Editar Unidad';
        $unidad = $this->unidades->where('id', $id)->first();
        $data['datos'] = $unidad;

        echo view('header');
        echo view('unidades/editar', $data);
        echo view('footer');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $id = $this->request->getPost('id');
            $data = ['nombre' => $this->request->getPost('nombre'), 'nombre_corto' => $this->request->getPost('nombre_corto')];
            $this->unidades->update($id, $data);
            return redirect()->to(base_url() . '/unidades');
        } else {
            $data['titulo'] = 'Editar Unidad';
            $data['validation'] = $this->validator;
            $unidad = $this->unidades->where('id', $this->request->getPost('id'))->first();
            $data['datos'] = $unidad;

            echo view('header');
            echo view('unidades/editar', $data);
            echo view('footer');
        }
    }

    public function eliminar($id)
    {
        $data = ['activo' => 0];
        $this->unidades->update($id, $data);
        return redirect()->to(base_url() . '/unidades');
    }

    public function reingresar($id)
    {
        $data = ['activo' => 1];
        $this->unidades->update($id, $data);
        return redirect()->to(base_url() . '/unidades');
    }
}
