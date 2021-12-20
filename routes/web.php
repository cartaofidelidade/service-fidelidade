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

        $router->group(["prefix" => "clientes"], function () use ($router) {
            $router->group(["prefix" => "conta"], function () use ($router) {
                $router->post('/cadastro', 'ClientesController@store');
                $router->put("/editar/{id}", "ClientesController@update");
            });

            $router->group(["prefix" => "cartelas"], function () use ($router) {
                $router->post('/cadastro', 'CartelasController@storeClient');
            });
        });

        $router->group(["prefix" => "conta", "middleware" => 'token'], function () use ($router) {
            $router->post("/login", "AuthController@auth");
            $router->post("/sair", "AuthController@logout");
            $router->post('/cadastro', 'AuthController@register');
            $router->post("/recuperar-senha", "AuthController@forgot");
            $router->post("/verifica-token", "AuthController@checkTokenForgot");
            $router->post("/alterarSenhaToken", "AuthController@changePasswordToken");
        });

        $router->group(["prefix" => "estabelecimentos"], function () use ($router) {
            $router->group(["prefix" => "conta"], function () use ($router) {
                $router->post("/cadastro", "EstabelecimentosController@store");
                $router->put("/{id}", "EstabelecimentosController@update");
                $router->put("/endereco/{id}", "EstabelecimentosController@updateAddress");
                $router->get("/", "EstabelecimentosController@show");
            });

            $router->group(['prefix' => "clientes"], function () use ($router) {
            });

            $router->group(['prefix' => "campanhas"], function () use ($router) {
                $router->get('/', 'CampanhasController@index');
                $router->get('/{id}', 'CampanhasController@show');
                $router->post('/', 'CampanhasController@store');
                $router->put('/{id}', 'CampanhasController@update');
                $router->delete('/{id}', 'CampanhasController@delete');
            });

            $router->group(['prefix' => "cartelas"], function () use ($router) {

                $router->post('/cadastro', 'CartelasController@store');
                $router->post('delete/{id}', 'CartelasController@delete');
            });
        });

        $router->group(['prefix' => "gerenciador"], function () use ($router) {
            $router->group(['prefix' => "segmentos"], function () use ($router) {
                $router->post('/', 'SegmentosController@store');
            });
        });
    });
}
