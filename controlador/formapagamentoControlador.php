<?php
require("servico/validarServico.php");
require_once 'modelo/formapagamentoModelo.php';

function adicionarFormapagamento () {
    if (ehPost()){
        $descricao = $_POST["descricao"];
            
        $errors= array();
            
        if  (validar_elementos_obrigatorios($descricao, "descricao") != NULL){
             $errors[]= validar_elementos_obrigatorios($descricao, "descricao");
        }    
      
    if (count($errors) > 0){
        $dados= array();
        $dados["errors"]= $errors;
        exibir ("formapagamento/formulario", $dados);
    } else{   
    $msg = formapagamento($descricao);
    echo $msg;
    redirecionar("formapagamento/listarFormaPagamento");
    }
}else{
    exibir("formapagamento/formulario");

    }
}

function listarFormaPagamento (){
    $dados= array();
    $dados["formapagamentos"]= pegarTodasFormaPagamento();
    exibir ("formapagamento/listar", $dados);
}

function ver ($idFormaPagamento){
    $dados["formapagamento"]= pegarFormaPagamentoPorId($idFormaPagamento);
    exibir ("formapagamento/visualizar", $dados);
}

function deletar ($idFormaPagamento){
    $msg = deletarFormaPagamento($idFormaPagamento);
    redirecionar ("formapagamento/listarFormaPagamento");
}

function editar($idFormaPagamento) {
    if (ehPost()){
            $descricao = $_POST["descricao"];
			
			editarFormaPagamento($idFormaPagamento, $descricao);
            redirecionar("formapagamento/listarFormaPagamento");
	} else {
            $dados["formapagamento"] = pegarFormaPagamentoPorId($idFormaPagamento);
            exibir("formapagamento/formulario", $dados);			
	}
}