<?php
namespace Src\Classes;

class ClassString
{
    function mascara_string($mask,$string)
    {
       $maskared =  "";
       $j =  0;
       $tam =  strlen($mask); // tam da mascara

       for($i = 0; $i < $tam; $i++)
       {
          if($mask[$i] == '#')
          {
              if(isset($string[$j])){
                  $maskared .= $string[$j]; //recebe a string na pos j
                  $j++;
              }
          }else if(isset($mask[$i])){
              $maskared .= $mask[$i]; // recebe a mascara na pos i
          }
       }
       return $maskared;
    }
}
