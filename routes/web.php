<?php

if (isset($router)) {
    $router->get("/", function () {
        return response()->json(['mensagem' => 'API Fidelidade'], 200);
    });

    $router->group(['prefix' => "/api"], function () use ($router) {
        $router->group(["prefix" => "/publica", "middleware" => "token"], function () use ($router) {
            $router->get("/estados", "EstadosController@index");
            $router->get("/cidades", "CidadesController@index");
            $router->get("/segmentos", "SegmentosController@index");
        });

        $router->group(["prefix" => "/clientes"], function () use ($router) {
            $router->group(["prefix" => "/conta", "middleware" => "token"], function () use ($router) {
                $router->post("/login", "");

                $router->post("/cadastro", "");
                $router->post("/verifica-cadastro", "");

                $router->post("/recuperar-senha", "");
            });

            $router->group(['prefix' => "/perfil", "middleware" => "clients"], function () use ($router) {
                $router->get('/{Id}', '');
                $router->put('/{Id}', '');
            });
        });

        $router->group(["prefix" => "/estabelecimentos"], function () use ($router) {
            $router->group(["prefix" => "/conta", "middleware" => "token"], function () use ($router) {
                $router->post("/login", "");

                $router->post("/cadastro", "");
                $router->post("/verifica-cadastro", "");

                $router->post("/recuperar-senha", "");
            });

            $router->group(['prefix' => "/perfil", "middleware" => "establishments"], function () use ($router) {
                $router->get('/{Id}', '');
                $router->put('/{Id}', '');
            });
        });

        $router->group(["prefix" => "/gerenciador"], function () use ($router) {
            $router->group(["prefix" => "/conta", "middleware" => "token"], function () use ($router) {
                $router->post("/login", "");
                $router->post("/recuperar-senha", "");
            });

            $router->group(['prefix' => "/segmentos", "middleware" => "clients"], function () use ($router) {
                $router->get('/', 'SegmentosController@index');
                $router->get('/{Id}', 'SegmentosController@show');
                $router->post('/', 'SegmentosController@store');
                $router->put('/{Id}', 'SegmentosController@update');
                $router->delete('/{Id}', 'SegmentosController@delete');
            });
        });
    });
}
