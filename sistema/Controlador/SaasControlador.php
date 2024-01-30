<?php

namespace sistema\Controlador;

use sistema\Nucleo\Controlador;
use sistema\Nucleo\Helpers;
use sistema\Nucleo\Sessao;

class SaasControlador extends Controlador
{
    private $usuario;


    public function __construct()
    {
      parent::__construct('');
      $this->usuario = UsuarioControlador::usuario();

      if (!$this->usuario or $this->usuario->level != 1) {
        $this->mensagem->alerta('Área exclusiva para usuários!')->flash();

        $sessao = new Sessao();
        $sessao->limpar('usuarioId');

        Helpers::redirecionar();
      }
     
    }

    public function index(): void
    {   
       
            $posts = new PostModelo();
            $usuarios = new UsuarioModelo();
            $categorias = new CategoriaModelo();
    
            echo $this->template->renderizar('dashboard.html', [
                'posts' => [
                    'posts' => $posts->busca()->ordem('id DESC')->limite(5)->resultado(true),
                    'total' => $posts->busca(null, 'COUNT(id)','id')->total(),
                    'ativo' => $posts->busca('status = :s', 's=1 COUNT(status)', 'status')->total(),
                    'inativo' => $posts->busca('status = :s', 's=0 COUNT(status)', 'status')->total()
                ],
                'categorias' => [
                    'categorias' => $categorias->busca()->ordem('id DESC')->limite(5)->resultado(true),
                    'total' => $categorias->busca()->total(),
                    'categoriasAtiva' => $categorias->busca('status = 1')->total(),
                    'categoriasInativa' => $categorias->busca('status = 0')->total(),
                ],
                'usuarios' => [
                    'logins' => $usuarios->busca()->ordem('ultimo_login DESC')->limite(5)->resultado(true),
                    'usuarios' => $usuarios->busca('level != 3')->total(),
                    'usuariosAtivo' => $usuarios->busca('status = 1 AND level != 3')->total(),
                    'usuariosInativo' => $usuarios->busca('status = 0 AND level != 3')->total(),
                    'admin' => $usuarios->busca('level = 3')->total(),
                    'adminAtivo' => $usuarios->busca('status = 1 AND level = 3')->total(),
                    'adminInativo' => $usuarios->busca('status = 0 AND level = 3')->total()
                ],
            ]);
        

    }

    public function cadastrar(): void
    {
        if ($this->usuario->level ==1) {
            echo 'pode cadastrar algo';
        }else{
            echo 'não pode cadastrar';
        }

    }
}