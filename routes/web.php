<?php

if (isset($router)) {
    $router->get("/", "FidelidadeController@index");

    $router->group(['prefix' => "/api"], function () use ($router) {
        $router->group(["prefix" => "/publica", "middleware" => "token"], function () use ($router) {
            $router->get("/estados", "EstadosController@index");
            $router->get("/cidades/buscaCidadesEstados/{estadosId}", "CidadesController@buscaCidadesEstados");
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

        $router->group(['prefix' => "/conta"], function () use ($router) {
            $router->post("/cadastro", "");
            $router->post("/verifica-cadastro", "");

            $router->post("/login", "");

            $router->post("/recuperar-senha", "");
            $router->post("/recuperar-senha/{codigo}", "");
        });
    });
}
