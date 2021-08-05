<?php

use Illuminate\Support\Facades\Mail;

if (isset($router)) {
    $router->get("/", function () {
        return response()->json(['mensagem' => 'API Fidelidade'], 200);
    });

    // $router->group(['prefix' => "api", "middleware" => "token"], function () use ($router) {
    $router->group(['prefix' => "api"], function () use ($router) {
        $router->group(["prefix" => "publica"], function () use ($router) {
            $router->get("/estados", "EstadosController@index");
            $router->get('/cidades', "CidadesController@index");
            $router->get("/segmentos", "SegmentosController@index");            
            $router->get("/geraQrCode", "EstabelecimentosController@geraQrCode");
        });

        $router->group(["prefix" => "clientes"], function () use ($router) {
            $router->group(["prefix" => "conta"], function () use ($router) {
                $router->post('/cadastro', 'ClientesController@store');
                $router->put("/editar/{id}", "ClientesController@update");
            });

            $router->group(["prefix" => "cartelas"], function () use ($router) {
                $router->post('/cadastro', 'CartelasController@store');
            });
        });

        $router->group(['prefix' => "conta"], function () use ($router) {
            $router->post("/login", "AuthController@auth");
            $router->post("/sair", "AuthController@logout");
            $router->post('/cadastro', 'ClientesController@store');
            $router->post("/recuperarSenha", "AuthController@recuperarSenha");
            $router->post("/alterarSenha", "AuthController@alterarSenha");  
        });

        $router->group(["prefix" => "estabelecimentos"], function () use ($router) {
            $router->group(["prefix" => "conta"], function () use ($router) {
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
