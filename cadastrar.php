<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entidade\Vaga;

define("TITLE","Cadastrar Vaga");

$obVaga = new Vaga;

//validação do post
if(isset($_POST["titulo"], $_POST["descricao"], $_POST["ativo"])){


    $obVaga->titulo = $_POST["titulo"];
    $obVaga->descricao = $_POST["descricao"];
    $obVaga->ativo = $_POST["ativo"];
    $obVaga->cadastrar();

    header("Location: index.php?status=success");
    exit;
}   

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';
