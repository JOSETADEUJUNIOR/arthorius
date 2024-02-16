<?php

namespace sistema\Modelo;

use sistema\Nucleo\Modelo;

/**
 * Classe PostModelo
 *
 * @author Ronaldo Aires
 */
class PostModelo extends Modelo
{
    protected $schema;

    public function __construct(string $slug = '')
    {

/*         $this->schema = $_SESSION['tenant_id'] ?? $slug; */
        $this->schema = $slug;
        parent::__construct('equipamentos', $this->schema);
    }

    /**
     * Busca a categoria pelo ID
     * @return CategoriaModelo|null
     */
    public function categoria(): ?CategoriaModelo
    {
        if ($this->categoria_id) {
            return (new CategoriaModelo($this->schema))->buscaPorId($this->categoria_id);
        }
        return null;
    }

    /**
     * Busca o usuário pelo ID
     * @return UsuarioModelo|null
     */
    public function usuario(): ?UsuarioModelo
    {
        if ($this->usuario_id) {
            return (new UsuarioModelo())->buscaPorId($this->usuario_id);
        }
        return null;
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
