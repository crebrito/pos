<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;

class Roles extends BaseController
{
    protected $roles;
    protected $reglas;

    public function __construct()
    {
        $this->roles = new RolesModel();

        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ]
        ];
    }

    public function index($activo = 1)
    {
        $roles = $this->roles->where('activo', $activo)->findAll();
        $data['titulo'] = 'Roles';
        $data['datos'] = $roles;

        echo view('header');
        echo view('roles/roles', $data);
        echo view('footer');
    }

    public function eliminados($activo = 0)
    {
        $roles = $this->roles->where('activo', $activo)->findAll();
        $data['titulo'] = 'Roles Eliminados';
        $data['datos'] = $roles;

        echo view('header');
        echo view('roles/eliminados', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        $data['titulo'] = 'Agregar Rol';

        echo view('header');
        echo view('roles/nuevo', $data);
        echo view('footer');
    }

    public function insertar()
    {

        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $data = ['nombre' => $this->request->getPost('nombre')];
            $this->roles->save($data);
            return redirect()->to(base_url() . '/roles');
        } else {
            $data['titulo'] = 'Agregar Rol';
            $data['validation'] = $this->validator;

            echo view('header');
            echo view('roles/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id)
    {
        $data['titulo'] = 'Editar Rol';
        $rol = $this->roles->where('id', $id)->first();
        $data['datos'] = $rol;

        echo view('header');
        echo view('roles/editar', $data);
        echo view('footer');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $id = $this->request->getPost('id');
            $data = ['nombre' => $this->request->getPost('nombre')];
            $this->roles->update($id, $data);
            return redirect()->to(base_url() . '/roles');
        } else {
            $data['titulo'] = 'Editar Rol';
            $data['validation'] = $this->validator;
            $rol = $this->roles->where('id', $this->request->getPost('id'))->first();
            $data['datos'] = $rol;

            echo view('header');
            echo view('roles/editar', $data);
            echo view('footer');
        }
    }

    public function eliminar($id)
    {
        $data = ['activo' => 0];
        $this->roles->update($id, $data);
        return redirect()->to(base_url() . '/roles');
    }

    public function reingresar($id)
    {
        $data = ['activo' => 1];
        $this->roles->update($id, $data);
        return redirect()->to(base_url() . '/roles');
    }
}
