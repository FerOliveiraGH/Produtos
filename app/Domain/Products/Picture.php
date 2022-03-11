<?php

namespace App\Domain\Products;

use Illuminate\Http\UploadedFile;

class Picture
{
    private string $nome;
    
    public function __construct($foto)
    {
        if (!$foto instanceof UploadedFile) {
            $this->nome = $foto ?? '';
            return;
        }
    
        $path = 'storage/fotos/';
        $nome = uniqid() . '-' . $foto->getClientOriginalName();
        $upload = $foto->storeAs('fotos', $nome);
        
        if ($upload) {
            $this->nome = $path . $nome;
        }
    }
    
    public function __toString(): string
    {
        return $this->nome;
    }
}