<?php

namespace Src\Classes;

class ClassPassword
{

    public function __construct(){}

    #Criar o hash da senha para salvar no banco de dados
    public function passwordHash($senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    #Verificar se o hash da senha está correto
    public function verifyHash($senha, $hashSenha)
    {
        return password_verify($senha, $hashSenha);
    }

}


#Hash da senha admin
#$2y$10$.8L.ghDGCAI4OdPnfbqR/Oa.Cwh8RJHsh8IIWNs8NVU20ki8sV72m
