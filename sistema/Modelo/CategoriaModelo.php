<?php

namespace sistema\Modelo;

use sistema\Nucleo\Conexao;
use sistema\Nucleo\Modelo;

/**
 * Classe CategoriaModelo
 *
 * @author Ronaldo Aires
 */
class CategoriaModelo extends Modelo
{

    protected $schema;

    public function __construct()
    {
      /*   $this->schema = $_SESSION['tenant_id'] ?? 'posts'; */
        $this->schema = 'tenant_2';
        parent::__construct('categorias', $this->schema);
    }

    /**
     * Retorna o total de posts de uma categoria
     * @param int $categoriaId
     * @return int
     */
 

    /**
     * Salva o post com slug
     * @return bool
     */
    public function salvar(): bool
    {
        $this->slug();
        return parent::salvar();
    }

}
