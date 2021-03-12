<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CajasModel;
use App\Models\RolesModel;
use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    protected $usuarios;
    protected $roles;
    protected $cajas;
    protected $reglas, $reglasLogin, $reglasCambia;

    public function __construct()
    {
        $this->usuarios = new UsuariosModel();
        $this->cajas = new CajasModel();
        $this->roles = new RolesModel();

        helper(['form']);

        $this->reglas = [
            'usuario' => [
                'rules' => 'required|is_unique[usuarios.usuario]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'is_unique' => 'El {field} {value} ya existe'
                ]
            ],
            'password' => [
                'label' => 'Contraseña',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                ]
            ],
            'repassword' => [
                'label' => 'Repetir Contraseña',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'matches' => 'Las contraseñas no coinciden',
                ]
            ],
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
            'id_caja' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
            'id_rol' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido'
                ]
            ],
        ];
        $this->reglasLogin = [
            'usuario' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                ]
            ],
            'password' => [
                'label' => 'Contraseña',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                ]
            ],
        ];
        $this->reglasCambia = [
            'password' => [
                'label' => 'Contraseña',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                ]
            ],
            'repassword' => [
                'label' => 'Repetir Contraseña',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'matches' => 'Las contraseñas no coinciden',
                ]
            ],
        ];
    }

    public function index($activo = 1)
    {
        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data['titulo'] = 'Usuarios';
        $data['datos'] = $usuarios;

        echo view('header');
        echo view('usuarios/usuarios', $data);
        echo view('footer');
    }

    public function eliminados($activo = 0)
    {
        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data['titulo'] = 'Usuarios Eliminadas';
        $data['datos'] = $usuarios;

        echo view('header');
        echo view('usuarios/eliminados', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        $data['titulo'] = 'Agregar Usuario';
        $data["cajas"] = $this->cajas->where("activo", 1)->findAll();
        $data["roles"] = $this->roles->where("activo", 1)->findAll();

        echo view('header');
        echo view('usuarios/nuevo', $data);
        echo view('footer');
    }

    public function insertar()
    {

        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {

            $hash = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);

            $data = [
                'usuario' => $this->request->getPost('usuario'),
                'password' => $hash,
                'nombre' => $this->request->getPost('nombre'), 
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol')
            ];
            $this->usuarios->save($data);
            return redirect()->to(base_url() . '/usuarios');
        } else {
            $data['titulo'] = 'Agregar Usuario';
            $data['validation'] = $this->validator;
            $data["cajas"] = $this->cajas->where("activo", 1)->findAll();
            $data["roles"] = $this->roles->where("activo", 1)->findAll();

            echo view('header');
            echo view('usuarios/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id)
    {
        $data['titulo'] = 'Editar Usuario';
        $usuario = $this->usuarios->where('id', $id)->first();
        $data["cajas"] = $this->cajas->where("activo", 1)->findAll();
        $data["roles"] = $this->roles->where("activo", 1)->findAll();
        $data['datos'] = $usuario;

        echo view('header');
        echo view('usuarios/editar', $data);
        echo view('footer');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == 'post' && $this->validate($this->reglas)) {
            $id = $this->request->getPost('id');
            
            $hash = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);

            $data = [
                'usuario' => $this->request->getPost('usuario'),
                'password' => $hash,
                'nombre' => $this->request->getPost('nombre'), 
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol')
            ];
            $this->usuarios->update($id, $data);
            return redirect()->to(base_url() . '/usuarios');
        } else {
            $data['titulo'] = 'Editar Usuario';
            $data['validation'] = $this->validator;
            $usuario = $this->usuarios->where('id', $this->request->getPost('id'))->first();
            $data["cajas"] = $this->cajas->where("activo", 1)->findAll();
            $data["roles"] = $this->roles->where("activo", 1)->findAll();
            $data['datos'] = $usuario;

            echo view('header');
            echo view('usuarios/editar', $data);
            echo view('footer');
        }
    }

    public function eliminar($id)
    {
        $data = ['activo' => 0];
        $this->usuarios->update($id, $data);
        return redirect()->to(base_url() . '/usuarios');
    }

    public function reingresar($id)
    {
        $data = ['activo' => 1];
        $this->usuarios->update($id, $data);
        return redirect()->to(base_url() . '/usuarios');
    }

    public function login(){
        echo view('login');
    }

    public function valida(){
        if ($this->request->getMethod() == 'post' && $this->validate($this->reglasLogin)) {
            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $datosUsuario = $this->usuarios->where('usuario', $usuario)->first();

            if($datosUsuario != null){

                if(password_verify($password,$datosUsuario['password'])){
                    $datosSesion = [
                        'id_usuario' => $datosUsuario['id'],
                        'nombre' => $datosUsuario['nombre'],
                        'id_rol' => $datosUsuario['id_rol'],
                        'id_caja' => $datosUsuario['id_caja']
                    ];
                    $session = session();
                    $session->set($datosSesion);

                    return redirect()->to(base_url() . '/configuracion');

                }else{
                    $data['error'] = 'Contraseña incorrecta';
                    echo view('login', $data);
                }

            }else{
                $data['error'] = 'El usuario no existe';
                echo view('login', $data);
            }
        }else{
            $data["validation"] = $this->validator;
            echo view('login', $data);
        }
    }

    public function logout(){
        $session = session();
        $session->destroy();

        return redirect()->to(base_url());
    }

    public function cambia_password(){
        
        $data['titulo'] = 'Cambiar contraseña';

        echo view('header');
        echo view('usuarios/cambia_password',$data);
        echo view('footer');

    }

    public function actualiza_password()
    {
        if ($this->request->getMethod() == 'post' && $this->validate($this->reglasCambia)) {
            
            $id = session()->id_usuario;
            
            $hash = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);

            $data = [
                'password' => $hash
            ];
            $this->usuarios->update($id, $data);

            $data['mensaje'] = 'Contraseña actualizada';
            $data['titulo'] = 'Cambiar contraseña';

            echo view('header');
            echo view('usuarios/cambia_password',$data);
            echo view('footer');

        } else {

            $data['validation'] = $this->validator;
            $data['titulo'] = 'Cambiar contraseña';

            echo view('header');
            echo view('usuarios/cambia_password',$data);
            echo view('footer');

        }
    }

}
