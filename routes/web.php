<?php

if (isset($router)) {
    $router->get("/", function () {
        return response()->json(['mensagem' => 'API Fidelidade'], 200);
    });

    $router->group(['prefix' => "api"], function () use ($router) {
        $router->group(["prefix" => "publica"], function () use ($router) {
            $router->get("/estados", "EstadosController@index");
            $router->get("/cidades/buscaCidades/{id}", "CidadesController@buscasCidades");
            $router->get('/cidades', "CidadesController@index");
            
            $router->get("/segmentos", "SegmentosController@index");
        });

        $router->group(["prefix" => "estabelecimentos"], function () use ($router) {
            $router->group(["prefix" => "conta"], function () use ($router) {
                $router->post("/login", "AuthController@authEstabelecimento");
                $router->post("/logout", "AuthController@logout");

                $router->post("/cadastro", "EstabelecimentosController@store");
                $router->post("/editar/{id}", "EstabelecimentosController@update");
            });

            $router->group(['prefix' => "campanhas"], function () use ($router) {
                $router->get('/', 'CampanhasController@index');
                $router->get('/{id}', 'CampanhasController@show');

                $router->post('/cadastro', 'CampanhasController@store');
                $router->put('/{id}', 'CampanhasController@update');
                $router->delete('/{id}', 'CampanhasController@delete');
            });
        });

        $router->group(['prefix' => "gerenciador"], function () use ($router) {
            $router->group(['prefix' => "segmentos"], function () use ($router) {
                $router->post('/', 'SegmentosController@store');
            });
        });
    });
}
