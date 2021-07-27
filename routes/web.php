<?php

use Illuminate\Support\Facades\Mail;

if (isset($router)) {
    $router->get("/", function () {
        return response()->json(['mensagem' => 'API Fidelidade'], 200);
    });

    $router->group(['prefix' => "api"], function () use ($router) {
        $router->group(["prefix" => "publica"], function () use ($router) {
            $router->get("/estados", "EstadosController@index");
            $router->get('/cidades', "CidadesController@index");
            $router->get("/segmentos", "SegmentosController@index");
            $router->get("/geraQrCode", "EstabelecimentosController@geraQrCode");
        });

        $router->group(["prefix" => "estabelecimentos"], function () use ($router) {
            $router->group(["prefix" => "conta"], function () use ($router) {
                $router->post("/login", "AuthController@authEstabelecimento");
                $router->post("/logout", "AuthController@logout");


                $router->post("/recuperarSenha", "AuthController@recuperarSenha");
                $router->post("/alterarSenha", "AuthController@alterarSenha");

                $router->get('/buscaEstabelecimento/{id}', 'EstabelecimentosController@buscaEstabelecimento');


                $router->post("/cadastro", "EstabelecimentosController@store");
                $router->post("/editar", "EstabelecimentosController@update");
            });

            $router->group(['prefix' => "campanhas"], function () use ($router) {
                $router->get('/consultar', 'CampanhasController@index');
                $router->get('/buscaCampanha/{id}', 'CampanhasController@show');

                $router->post('/cadastro', 'CampanhasController@store');
                $router->post('/editar/{id}', 'CampanhasController@update');
                $router->post('delete/{id}', 'CampanhasController@delete');
            });
        });

        $router->group(['prefix' => "gerenciador"], function () use ($router) {
            $router->group(['prefix' => "segmentos"], function () use ($router) {
                $router->post('/', 'SegmentosController@store');
            });
        });
    });
}
