<?php

namespace sistema\Controlador\Admin;

use sistema\Controlador\Admin\AdminControlador;
use sistema\Modelo\ConfiguracaoModelo;
use sistema\Nucleo\Helpers;
use Verot\Upload\Upload;

class AdminConfiguracao extends AdminControlador
{

    private $logo;

   public function listar()
   {
    $config = new ConfiguracaoModelo();

    if ($config) {
        $ultimoId = $config->ultimoId();
        $dados = $config->buscaPorId($ultimoId);

    }
    echo $this->template->renderizar('configuracao/listar.html', ['dados'=>$dados]);
   }
   
   public function editar(int $id):void
   {
    $config = (new ConfiguracaoModelo())->buscaPorId($id);
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($dados)) {
        if ($this->validarDados($dados)) {
            $config = (new ConfiguracaoModelo())->buscaPorId($config->id);
            $config->config_nome = $dados['config_nome'];
            $config->config_endereco = $dados['config_endereco'];
            $config->config_cep = $dados['config_cep'];
            $config->config_horario = $dados['config_horario'];
            $config->config_fone1 = $dados['config_fone1'];
            $config->config_fone2 = $dados['config_fone2'];
            $config->config_site_keywords = $dados['config_site_keywords'];
            $config->config_site_description = $dados['config_site_description'];
            $config->config_site_ga = $dados['config_sobre'];
            if (!empty($_FILES['logo']['name'])) {
                if ($config->config_foto && file_exists("uploads/empresa/{$config->config_foto}")) {
                    unlink("uploads/empresa/{$config->config_foto}");
                    unlink("uploads/empresa/thumbs/{$config->config_foto}");
                }
                $config->config_foto = $this->logo ?? null;
            }
            if ($config->salvar()) {
                $this->mensagem->sucesso('Post atualizado com sucesso')->flash();
                Helpers::redirecionar('admin/configuracao/listar');
            }else {
                    $this->mensagem->erro($config->erro())->flash();
                    Helpers::redirecionar('admin/configuracao/listar');
            }
        }
    }

   }



   public function validarDados(array $dados): bool
   {

       if (empty($dados['config_nome'])) {
           $this->mensagem->alerta('Digite um nome para a empresa!')->flash();
           return false;
       }

       if (!empty($_FILES['logo'])) {
           $upload = new Upload($_FILES['logo'], 'pt_BR');
           if ($upload->uploaded) {
               $titulo = $upload->file_new_name_body = Helpers::slug($dados['config_nome']);
               $upload->jpeg_quality = 90;
               $upload->image_convert = 'jpg';
               $upload->process("uploads/empresa/");

               if ($upload->processed) {
                   $this->logo = $upload->file_dst_name;
                   $upload->file_new_name_body = $titulo;
                   $upload->image_resize = true;
                   $upload->image_x = 540;
                   $upload->image_y = 304;
                   $upload->jpeg_quality = 70;
                   $upload->image_convert = 'jpg';
                   $upload->process("uploads/empresa/thumbs/");
                   $upload->clean();
               } else {
                   $this->mensagem->alerta($upload->error)->flash();
                   return false;
               }
           }
       }

       return true;
   }

    
}