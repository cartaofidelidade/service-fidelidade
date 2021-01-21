<?php

if (isset($router)) {
    $router->get("/", "FidelidadeController@index");

    $router->group(['prefix' => "/api"], function () use ($router) {

        $router->get("/fidelidade/estados", "EstadosController@index");
        $router->get("/fidelidade/cidades", "CidadesController@index");

        $router->group(['prefix' => "/conta", 'middleware' => 'checkToken'], function () use ($router) {
            $router->post("/cadastro", "");
            $router->post("/verifica-cadastro", "");

            $router->post("/login", "");

            $router->post("/recuperar-senha", "");
            $router->post("/recuperar-senha/{codigo}", "");
        });

        $router->group(['prefix' => "/perfil", 'middleware' => 'checkToken'], function () use ($router) {
            $router->get('/{Id}', '');
            $router->put('/{Id}', '');
        });

        $router->group(['prefix' => "/estabelecimentos"], function () use ($router) {
            $router->get("listaEstabelecimentos/{router}", "EstabelecimentosController@listaEstabelecimentos");
            $router->post("cadastro/", "EstabelecimentosController@cadastro");

        });

        $router->group(['prefix' => "/clientes"], function () use ($router) {
            $router->get("listaClientes/{router}", "ClientesController@listaClientes");
            $router->post("cadastro/", "ClientesController@cadastro");

        });

        $router->group(['prefix' => "/IndividuosContatos"], function () use ($router) {
            $router->get("/", "IndividuosContatosController@index");
            $router->get("buscaContatos/{router}", "IndividuosContatosController@buscaContatos");
            $router->post("cadastro/", "IndividuosContatosController@cadastro");
            $router->put("atualizar/{router}", "IndividuosContatosController@update");
            $router->delete("delete/{router}", "IndividuosContatosController@destroy");
        });

        $router->group(['prefix' => "/IndividuosEnderecos"], function () use ($router) {
            $router->get("/", "IndividuosEnderecosController@index");
            $router->get("buscaContatos/{router}", "IndividuosEnderecosController@buscaEnderecos");
            $router->post("cadastro/", "IndividuosEnderecosController@cadastro");
            $router->put("atualizar/{router}", "IndividuosEnderecosController@update");
            $router->delete("delete/{router}", "IndividuosEnderecosController@destroy");
        });
    });
}
