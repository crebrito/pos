<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;

class Configuracion extends BaseController
{
    protected $configuracion;
    protected $reglas;

    public function __construct()
    {
        $this->configuracion = new ConfiguracionModel();

        helper(['form']);

        $this->reglas = [
            'tienda_nombre' => [
                'label' => 'Nombre de la Tienda',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El texto ({value}) escrito en el campo {field} es mayor a {param} caracteres'
                ]
            ],
            'tienda_rif' => [
                'label' => 'RIF de la Tienda',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El texto ({value}) escrito en el campo {field} es mayor a {param} caracteres'
                ]
            ],
            'tienda_correo' => [
                'label' => 'Correo de la Tienda',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El texto ({value}) escrito en el campo {field} es mayor a {param} caracteres'
                ]
            ],
            'tienda_telefono' => [
                'label' => 'Teléfono de la Tienda',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El texto ({value}) escrito en el campo {field} es mayor a {param} caracteres'
                ]
            ],
            'tienda_direccion' => [
                'label' => 'Dirección de la Tienda',
                'rules' => 'max_length[100]',
                'errors' => [
                    'max_length' => 'El texto ({value}) escrito en el campo {field} es mayor a {param} caracteres'
                ]
            ],
            'ticket_leyenda' => [
                'label' => 'Leyenda del Ticket',
                'rules' => 'max_length[100]',
                'errors' => [
                    'max_length' => 'El texto ({value}) escrito en el campo {field} es mayor a {param} caracteres'
                ]
            ],
        ];
    }

    public function index()
    {
        $data['titulo'] = 'Configuraciones';
        $configuracion = $this->configuracion->findAll();
        foreach ($configuracion as $config) {
            $data[$config['nombre']] = $config['valor'];
        }

        echo view('header');
        echo view('configuracion/configuracion', $data);
        echo view('footer');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $configuraciones = $this->configuracion->findAll();
            foreach ($configuraciones as $config) {
                $valor = $this->request->getPost($config['nombre']);
                $this->configuracion->where('nombre', $config['nombre'])->set(['valor' => $valor])->update();
            }
            return redirect()->to(base_url() . '/configuracion');
        } else {
            $data['titulo'] = 'Configuraciones';
            $configuracion = $this->configuracion->findAll();
            foreach ($configuracion as $config) {
                $data[$config['nombre']] = $config['valor'];
            }
            $data['validation'] = $this->validator;
            echo view('header');
            echo view('configuracion/configuracion', $data);
            echo view('footer');
        }
    }
}
