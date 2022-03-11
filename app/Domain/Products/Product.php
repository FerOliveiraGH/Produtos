<?php

namespace App\Domain\Products;

class Product
{
    private string $nome;
    private string $descricao;
    private float $valor;
    private Picture $foto;
    
    public function __construct(string $nome, string $descricao, float $valor, Picture $foto)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->foto = $foto;
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