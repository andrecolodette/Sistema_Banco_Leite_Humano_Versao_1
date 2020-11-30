<?php

namespace Src\Classes;

class ClassValidateCampos
{
    /*Construtor*/
    public function __construct(){}

    #Validar se os campos desejados foram preenchidos
    public function validateFields($par)
    {
        $i=0;
        foreach ($par as $key => $value){
            if(empty($value)){
                $i++;
            }
        }
        if($i==0){
            return true;
        }else{
            return false;
        }
    }

    #Validar numero de caracter
    public function validateTamanhoMaximoTexto($par, $limite)
    {
        $tamanho = strlen($par);
        if($tamanho <= $limite){
            return true;
        }else{
            return false;
        }
    }
    #Validar numero de caracter
    public function validateTamanhoMinimoTexto($par, $limite)
    {
        $tamanho = strlen($par);
        if($tamanho >= $limite){
            return true;
        }else{
            return false;
        }
    }

    #Validação se o dado é um email
    public function validateEmail($par)
    {
        if(filter_var($par, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    #Validação se o dado é uma data
    public function validateData($par, $dt="Data")
    {
        $data=\DateTime::createFromFormat("d/m/Y",$par);
        if(($data) && ($data->format("d/m/Y") === $par)){
            return true;
        }else{
            return false;
        }
    }

    #Validação se é um cpf real
    public function validateCpf($par)
    {
        #Limpando a string para que tenha apenas numeros
        $cpf = preg_replace('/[^0-9]/', '', (string) $par);
        #Verificando se tem 11 digitos
        if (strlen($cpf) != 11){
            return false;
        }
        #Verificando o primeiro digito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
            $soma += $cpf{$i} * $j;
            $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
        {
            return false;
        }
        #Verificando o segundo digito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
            $soma += $cpf{$i} * $j;
            $resto = $soma % 11;
        if ($cpf{10} != ($resto < 2 ? 0 : 11 - $resto))
        {
          return false;
        }

        return true;
    }

    #Verificar se a senha é igual a confirmação de senha
    public function validateConfSenha($senha,$senhaConf)
    {
        if($senha === $senhaConf){
            return true;
        }else{
            //$this->setMsgErro("Senha diferente de confirmação de senha!");
            return false;
        }
    }

}
