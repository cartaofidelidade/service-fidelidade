<?php

if (isset($router)) {
    $router->get("/", function () {
        return response()->json(['mensagem' => 'API Fidelidade'], 200);
    });

    $router->group(['prefix' => "/api"], function () use ($router) {
        $router->get("/estados", "EstadosController@index");
        $router->get("/cidades/{estadosId}", "CidadesController@buscaCidadesEstados");
        $router->get("/segmentos", "SegmentosController@index");


        $router->group(["prefix" => "/clientes"], function () use ($router) {
            $router->group(["prefix" => "/conta"], function () use ($router) {
                $router->post("/login", "");

                $router->post("/cadastro", "");
                $router->post("/verifica-cadastro", "");

                $router->post("/recuperar-senha", "");
            });

            $router->group(['prefix' => "/perfil"], function () use ($router) {
                $router->get('/{Id}', '');
                $router->put('/{Id}', '');
            });
        });

        $router->group(["prefix" => "/estabelecimentos"], function () use ($router) {
            $router->group(["prefix" => "/conta"], function () use ($router) {
                $router->post("/cadastro", "EstabelecimentosController@store");
            });

            $router->group(['prefix' => "/campanhas"], function () use ($router) {
                $router->get('/', 'CampanhasController@index');
                $router->get('/{id}', 'CampanhasController@show');

                $router->post('/', 'CampanhasController@store');
                $router->put('/{id}', 'CampanhasController@update');
                $router->delete('/{id}', 'CampanhasController@delete');
            });

            $router->group(['prefix' => "/clientes"], function () use ($router) {
                $router->get('/', 'ClientesController@index');
                $router->get('/{Id}', 'ClientesController@show');
            });
        });

        $router->group(["prefix" => "/gerenciador"], function () use ($router) {
            $router->group(["prefix" => "/conta"], function () use ($router) {
                $router->post("/login", "");
                $router->post("/recuperar-senha", "");
            });

            $router->group(['prefix' => "/segmentos"], function () use ($router) {
                $router->get('/', 'SegmentosController@index');
                $router->get('/{Id}', 'SegmentosController@show');
                $router->post('/', 'SegmentosController@store');
                $router->put('/{Id}', 'SegmentosController@update');
                $router->delete('/{Id}', 'SegmentosController@delete');
            });
        });
    });
}
