<?php

if (isset($router)) {
    $router->get("/", function () {
        return response()->json(['mensagem' => 'API Fidelidade'], 200);
    });

    $router->group(['prefix' => "/api"], function () use ($router) {
        $router->group(["prefix" => "/publica", "middleware" => "token"], function () use ($router) {
            $router->get("/estados", "EstadosController@index");
            $router->get("/cidades/{estadosId}", "CidadesController@buscaCidadesEstados");
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
                $router->post("/login", "ContaEstabelecimentosController@login");

                $router->post("/cadastro", "ContaEstabelecimentosController@register");
                
                $router->post("/verifica-cadastro", "ContaEstabelecimentosController@checkRegister");
                
                $router->post("/recuperar-senha", "ContaEstabelecimentosController@forgot");
            });

            $router->group(['prefix' => "/campanhas", "middleware" => "establishments"], function () use ($router) {
                $router->get('/', 'CampanhasController@index');
                $router->post('/', 'CampanhasController@store');
                $router->get('/{Id}', 'CampanhasController@show');
                $router->put('/{Id}', 'CampanhasController@update');
                $router->delete('/{Id}', 'CampanhasController@delete');
            });

            $router->group(['prefix' => "/clientes", "middleware" => "establishments"], function () use ($router) {
                $router->get('/', 'ClientesController@index');
                $router->get('/{Id}', 'ClientesController@show');
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
