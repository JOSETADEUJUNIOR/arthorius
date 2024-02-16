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

    public function __construct(string $slug = '')
    {
      /*   $this->schema = $_SESSION['tenant_id'] ?? 'posts'; */
        $this->schema = $slug;
        parent::__construct('categorias', $this->schema);
    }

    /**
     * Retorna o total de posts de uma categoria
     * @param int $categoriaId
     * @return int
     */
    public function totalPosts(int $categoriaId): int
    {
        $query = "SELECT COUNT(*) as total FROM equipamentos WHERE categoria_id = {$categoriaId} ";
        $stmt = Conexao::getInstancia($this->schema)->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $resultado['total'];
    }


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
