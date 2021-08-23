<?php

namespace App\Utils;

class Arquivos
{
    public function upload(string $arquivo, string $path): string
    {
        $imagem_parts = explode(";base64,", $arquivo);
        $imagem_type_aux = explode("image/", $imagem_parts[0]);
        $imagem_type = $imagem_type_aux[1];
        $imagem_base64 = base64_decode($imagem_parts[1]);

        $name_arquivo = uniqid() . '.' . $imagem_type;
        file_put_contents($path . $name_arquivo, $imagem_base64);

        return $path . $name_arquivo;
    }

    public function converteImagemBase64(string $path)
    {
    
      return base64_encode(file_get_contents($path));
    
    }
}
