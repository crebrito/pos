<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CajasModel;

class Cajas extends BaseController
{
    protected $cajas;
    protected $reglas;

    public function __construct()
    {
        $this->cajas = new CajasModel();

        helper(['form']);

        $this->reglas = [
            'numero_caja' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
            'folio' => [
                'label' => 'Folio',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ]
        ];
    }

    public function index($activo = 1)
    {
        $cajas = $this->cajas->where('activo', $activo)->findAll();
        $data['titulo'] = 'Cajas';
        $data['datos'] = $cajas;

        echo view('header');
        echo view('cajas/cajas', $data);
        echo view('footer');
    }

    public function eliminados($activo = 0)
    {
        $cajas = $this->cajas->where('activo', $activo)->findAll();
        $data['titulo'] = 'Cajas Eliminadas';
        $data['datos'] = $cajas;

        echo view('header');
        echo view('cajas/eliminados', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        $data['titulo'] = 'Agregar Caja';

        echo view('header');
        echo view('cajas/nuevo', $data);
        echo view('footer');
    }

    public function insertar()
    {

        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $data = [
                'nombre' => $this->request->getPost('nombre'), 
                'folio' => $this->request->getPost('folio'),
                'numero_caja' => $this->request->getPost('numero_caja')
            ];
            $this->cajas->save($data);
            return redirect()->to(base_url() . '/cajas');
        } else {
            $data['titulo'] = 'Agregar Caja';
            $data['validation'] = $this->validator;

            echo view('header');
            echo view('cajas/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id)
    {
        $data['titulo'] = 'Editar Caja';
        $unidad = $this->cajas->where('id', $id)->first();
        $data['datos'] = $unidad;

        echo view('header');
        echo view('cajas/editar', $data);
        echo view('footer');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $id = $this->request->getPost('id');
            $data = [
                'nombre' => $this->request->getPost('nombre'), 
                'folio' => $this->request->getPost('folio'),
                'numero_caja' => $this->request->getPost('numero_caja')
            ];
            $this->cajas->update($id, $data);
            return redirect()->to(base_url() . '/cajas');
        } else {
            $data['titulo'] = 'Editar Caja';
            $data['validation'] = $this->validator;
            $unidad = $this->cajas->where('id', $this->request->getPost('id'))->first();
            $data['datos'] = $unidad;

            echo view('header');
            echo view('cajas/editar', $data);
            echo view('footer');
        }
    }

    public function eliminar($id)
    {
        $data = ['activo' => 0];
        $this->cajas->update($id, $data);
        return redirect()->to(base_url() . '/cajas');
    }

    public function reingresar($id)
    {
        $data = ['activo' => 1];
        $this->cajas->update($id, $data);
        return redirect()->to(base_url() . '/cajas');
    }
}
