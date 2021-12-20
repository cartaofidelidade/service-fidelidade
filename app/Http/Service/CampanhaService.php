<?php

namespace App\Http\Service;

use App\Models\Campanhas;
use App\Models\CampanhasModel;
use App\Utils\Arquivos;
use Illuminate\Support\Facades\Auth;


class CampanhaService
{
    public function show(string $id)
    {
        $campanhas = Campanhas::find($id);

        $arquivos = new Arquivos();
        if ($campanhas['imagem_carimbo_preenchido'])
            $campanhas['imagem_carimbo_preenchido'] = $arquivos->converteImagemBase64($campanhas['imagem_carimbo_preenchido']);

        if ($campanhas['imagem_carimbo_vazio'])
            $campanhas['imagem_carimbo_vazio'] = $arquivos->converteImagemBase64($campanhas['imagem_carimbo_vazio']);

        return $campanhas;
    }

    public function create($formData)
    {

        if (isset($formData['imagem_carimbo_vazio']) && !empty($formData['imagem_carimbo_vazio']))
            $formData['imagem_carimbo_vazio'] = (new Arquivos())->upload($formData['imagem_carimbo_vazio'], 'estabelecimentos-carimbos/');

        if (isset($formData['imagem_carimbo_preenchido']) && !empty($formData['imagem_carimbo_preenchido']))
            $formData['imagem_carimbo_preenchido'] = (new Arquivos())->upload($formData['imagem_carimbo_preenchido'], 'estabelecimentos-carimbos/');

        $campanhas = new Campanhas();
        $campanhas->estabelecimentos_id = Auth::user()->origem_id;
        $campanhas->nome = $formData['nome'];
        $campanhas->tipo = $formData['tipo'];
        $campanhas->pontos = $formData['pontos'] ?? 0;
        $campanhas->quantidade_carimbos = $formData['quantidade_carimbos'];
        $campanhas->limite_carimbos_dia = $formData['limite_carimbos_dia'];
        $campanhas->data_inicio = $formData['data_inicio'];
        $campanhas->data_final = $formData['data_final'];
        $campanhas->descricao = $formData['descricao'];
        $campanhas->imagem_carimbo_vazio = $formData['imagem_carimbo_vazio'] ?? '';
        $campanhas->imagem_carimbo_preenchido = $formData['imagem_carimbo_preenchido'] ?? '';

        if ($campanhas->save())
            return $campanhas;

    }

    public function update(string $id, $formData)
    {

        if (isset($formData['imagem_carimbo_vazio']) && !empty($formData['imagem_carimbo_vazio']))
            $formData['imagem_carimbo_vazio'] = (new Arquivos())->upload($formData['imagem_carimbo_vazio'], 'estabelecimentos-carimbos/');

        if (isset($formData['imagem_carimbo_preenchido']) && !empty($formData['imagem_carimbo_preenchido']))
            $formData['imagem_carimbo_preenchido'] = (new Arquivos())->upload($formData['imagem_carimbo_preenchido'], 'estabelecimentos-carimbos/');


        if ($id) {
            $campanhas = Campanhas::find($id);

            $campanhas->estabelecimentos_id = Auth::user()->origem_id;
            $campanhas->nome = $formData['nome'];
            $campanhas->tipo = $formData['tipo'];
            $campanhas->pontos = $formData['pontos'] ?? 0;
            $campanhas->quantidade_carimbos = $formData['quantidade_carimbos'];
            $campanhas->limite_carimbos_dia = $formData['limite_carimbos_dia'];
            $campanhas->data_inicio = $formData['data_inicio'];
            $campanhas->data_final = $formData['data_final'];
            $campanhas->descricao = $formData['descricao'];
            $campanhas->imagem_carimbo_vazio = $formData['imagem_carimbo_vazio'] ?? '';
            $campanhas->imagem_carimbo_preenchido = $formData['imagem_carimbo_preenchido'] ?? '';

            if ($campanhas->save())
                return $campanhas;

        }
    }


    public function delete(string $id)
    {
        $campanhas = Campanhas::find($id);
        $campanhas->ativo = 0;

        if ($campanhas->save())
            return $campanhas;
    }
}
