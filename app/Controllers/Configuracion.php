<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;
use App\Libraries\permisosMenu;

class Configuracion extends BaseController
{
    protected $configuracion;
    protected $reglas, $session;

    public function __construct()
    {
        $this->permisosMenu = new permisosMenu();
        $this->configuracion = new ConfiguracionModel();
        $this->session = session();
        helper(['form', 'upload']);
        $this->reglas = [
            'tienda_nombre' => [
                'rules' => 'required'
            ], 'tienda_rfc' => [
                'rules' => 'required'
            ], 'tienda_telefono' => [
                'rules' => 'required|min_length[7]|integer'
            ], 'tienda_direccion' => [
                'rules' => 'required'
            ], 'ticket_leyenda' => [
                'rules' => 'required'
            ], 'tienda_email' => [
                'rules' => 'required|valid_email'
            ]
        ];
    }

    public function index($activo = 1)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $nombre = $this->configuracion->where('nombreConfiguracion', 'tienda_nombre')->first();
            $rfc = $this->configuracion->where('nombreConfiguracion', 'tienda_rfc')->first();
            $telefono = $this->configuracion->where('nombreConfiguracion', 'tienda_telefono')->first();
            $email = $this->configuracion->where('nombreConfiguracion', 'tienda_email')->first();
            $direccion = $this->configuracion->where('nombreConfiguracion', 'tienda_direccion')->first();
            $leyenda = $this->configuracion->where('nombreConfiguracion', 'ticket_leyenda')->first();

            $data = ['titulo' => 'Configuración', 'nombre' => $nombre, 'rfc' => $rfc, 'telefono' => $telefono, 'email' => $email, 'direccion' => $direccion, 'leyenda' => $leyenda];
            echo view('header');
            $this->permisosMenu->habilitarpermisos();
            echo view('configuracion/configuracion', $data);
            echo view('footer');
        }
    }

    public function editar($valid = null)
    {
        $nombre = $this->configuracion->where('nombreConfiguracion', 'tienda_nombre')->first();
        $rfc = $this->configuracion->where('nombreConfiguracion', 'tienda_rfc')->first();
        $telefono = $this->configuracion->where('nombreConfiguracion', 'tienda_telefono')->first();
        $email = $this->configuracion->where('nombreConfiguracion', 'tienda_email')->first();
        $direccion = $this->configuracion->where('nombreConfiguracion', 'tienda_direccion')->first();
        $leyenda = $this->configuracion->where('nombreConfiguracion', 'ticket_leyenda')->first();

        if ($valid != null) {
            $data = ['titulo' => 'Configuración', 'nombre' => $nombre, 'rfc' => $rfc, 'telefono' => $telefono, 'email' => $email, 'direccion' => $direccion, 'leyenda' => $leyenda, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Configuración', 'nombre' => $nombre, 'rfc' => $rfc, 'telefono' => $telefono, 'email' => $email, 'direccion' => $direccion, 'leyenda' => $leyenda];
        }
        echo view('header');
        echo view('configuracion/configuracion', $data);
        echo view('footer');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->configuracion->whereIn('nombreConfiguracion', ['tienda_nombre'])->set(['valorConfiguracion' => $this->request->getPost('tienda_nombre')])->update();
            $this->configuracion->whereIn('nombreConfiguracion', ['tienda_rfc'])->set(['valorConfiguracion' => $this->request->getPost('tienda_rfc')])->update();
            $this->configuracion->whereIn('nombreConfiguracion', ['tienda_telefono'])->set(['valorConfiguracion' => $this->request->getPost('tienda_telefono')])->update();
            $this->configuracion->whereIn('nombreConfiguracion', ['tienda_email'])->set(['valorConfiguracion' => $this->request->getPost('tienda_email')])->update();
            $this->configuracion->whereIn('nombreConfiguracion', ['tienda_direccion'])->set(['valorConfiguracion' => $this->request->getPost('tienda_direccion')])->update();
            $this->configuracion->whereIn('nombreConfiguracion', ['ticket_leyenda'])->set(['valorConfiguracion' => $this->request->getPost('ticket_leyenda')])->update();

            $validacion = $this->validate([
                'tienda_logo' => [
                    'uploaded[tienda_logo]',
                    'mime_in[tienda_logo,image/png]',
                    'max_size[tienda_logo, 4096]'
                ]
            ]);
            if ($validacion) {
                $ruta_logo = "images/logotipo.png";
                if (file_exists($ruta_logo)) {
                    unlink($ruta_logo);
                }

                $img = $this->request->getFile('tienda_logo');
                $img->move('./images', 'logotipo.png');
            } else {
                echo 'error';
            }
            return redirect()->to(base_url() . '/configuracion')->with('mensaje', 'Se ha modificado correctamente.');
        } else {
            return $this->editar($this->validator);
        }
    }
}
