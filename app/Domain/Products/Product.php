<?php

namespace App\Domain\Products;

class Product
{
    private int $id;
    private string $nome;
    private string $descricao;
    private float $valor;
    private Picture $foto;

    public function __construct(int $id, string $nome, string $descricao, float $valor, Picture $foto)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->foto = $foto;
    }

    public function getId(): int
    {
        return $this->id;
    }
    
    public function getNome(): string
    {
        return $this->nome;
    }
    
    public function getDescricao(): string
    {
        return $this->descricao;
    }
    
    public function getValor(): float
    {
        return $this->valor;
    }
    
    public function getFoto(): string
    {
        return $this->foto;
    }
}