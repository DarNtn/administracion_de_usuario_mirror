<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require __DIR__ . './../vendor/autoload.php';
    require "./auth.php";
    require "./estudiante.php";
    require_once '../funciones/conexion/php_conexion.php';

    $php_conexion = new php_conexion();
    $app = new Slim\App;

    // basic auth
    $app->add(new Tuupola\Middleware\HttpBasicAuthentication([
        "path" => "/*",
        "users" => [
            "root" => "root",
            "somebody" => "root"
        ]
    ]));
    
    // auth
    $app->post('/auth', function ($request, $response) {
        
        $data = $request->getParsedBody();
        $username = $data["user"];
        $password = $data["password"];
        
        return auth($username, $password);
      
    });
    
    // estudiante
    //$app->group('/estudiante', function () use ($app) {     
    $app->get('/estudiante', function (Request $request, Response $response) {
        
        $cedula = $request->getParams()["cedula"];
        return getEstudiante($cedula);

    });
    
    // autorizados
    $app->get('/autorizado', function (Request $request, Response $response){
        
        if (isset($request->getParams()["cedulaR"])){
            return getAutorizado($request->getParams()["cedulaR"]);
        } else if (isset($request->getParams()["cedulaA"])){
            return getAutorizados($request->getParams()["cedulaA"]);
        }       
    });

    $app->run();