<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entidade\Vaga;

//validação
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
  header("Location: index.php?status=ERROR"); exit;
}

$obVaga = Vaga::getVaga($_GET['id']);

// validando o id da vaga
if(!$obVaga instanceof Vaga){
    header("Location: index.php?status=ERROR"); exit;
}

//validação do post
if(isset($_POST["excluir"])){

    $obVaga->Excluir();

    header("Location: index.php?status=success");
    exit;
}   

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include __DIR__.'/includes/footer.php';
