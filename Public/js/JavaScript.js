/*
Pega a URL do site
*/
var DIRPAGE="http://"+document.location.hostname+"/Projetos/leiticia/";

/*
Tela de Listagem - Configuração das Colunas, Paginação, Pesquisas e Filtros
*/

//Atualizar Tabela de Listagem
function functionAtualizarTabelaListagem(url, formData){
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        data: formData,
        success: function(resposta){
            $("#idDivTabelaListagem").empty();
            $("#idDivTabelaListagem").html(resposta);
        }
    });
}
//Pegar todas as configurações e filtros da tela de listagem
function functionListaGetFiltros(pagina = ""){
    var formCol=$("#formColConfig");
    var url = formCol.attr('action');
    var formData=formCol.serialize();

    var formPesquisa=$("#formListPesquizar");
    formData += "&" + formPesquisa.serialize();

    var formFiltro=$("#formListFiltro");
    formData += "&" + formFiltro.serialize();

    formData += pagina;

    functionAtualizarTabelaListagem(url, formData);
    return false;
}


//Selecionar as colunas e a qtd de listagem
$(document).ready(function(){
    $("#formColConfig").on('submit',function(e){
        e.preventDefault();
        /*
        var form=$(this);
        var url = form.attr('action');
        var formData=$(this).serialize();

        functionAtualizarTabelaListagem(url, formData);
        return false;
        */
        functionListaGetFiltros();
        return false;
    });
});


$(document).ready(function(){
    $("#formListPesquizar").on('submit',function(e){
        e.preventDefault();
        /*
        var form=$("#formColConfig");
        var url = form.attr('action');
        var formData = form.serialize();

        var form=$(this);
        formData += "&" + $(this).serialize();
        alert("OI");

        functionAtualizarTabelaListagem(url, formData);
        return false;
        */
        functionListaGetFiltros();
        return false;
    });
});

//Filtrar data de Listagem
$(document).ready(function(){
    $("#formListFiltro").on('submit',function(e){
        e.preventDefault();
        /*
        var form=$(this);
        var url = form.attr('action');
        var formData=$(this).serialize();

        functionAtualizarTabelaListagem(url, formData);
        return false;
        */
        functionListaGetFiltros();
        return false;
    });
});

//Ir para as páginas dos extremos
function functionPagTelaListagem(pag){
    /*
    var form=$("#formColConfig");
    var url = form.attr('action');
    var formData = form.serialize();
    formData += ('&pagListagem='+pag);

    functionAtualizarTabelaListagem(url, formData);
    return false;
    */
    var pagina = '&pagListagem='+pag

    functionListaGetFiltros(pagina);
    return false;
}

//Selecionar alguma página
function functionIrPagTelaListagem(n = 0){
    /*
    var form=$("#formColConfig");
    var url = form.attr('action');
    var formData = form.serialize();

    var pag = $("#pagAtual").val();
    pag = parseInt(pag) + parseInt(n);
    if(pag < 1){ pag=1; }
    formData += ('&pagListagem='+pag);

    functionAtualizarTabelaListagem(url, formData);
    return false;
    */
    var pag = $("#pagAtual").val();
    pag = parseInt(pag) + parseInt(n);
    if(pag < 1){ pag=1; }

    var pagina = '&pagListagem='+pag

    functionListaGetFiltros(pagina);
    return false;
}



/*
Tela de Cadastro - Pré Visialização de Img
*/

function preVisualizacaoImg(inputImg){
    var inputFile = document.getElementById(inputImg);
    if(inputFile.files && inputFile.files[0]){
        var file = new FileReader();
        file.onload = function(f){
            $("#divFormImgPrevia").html("<img src='"+f.target.result+"'>")
        }
        file.readAsDataURL(inputFile.files[0]);
    }
}

$(document).ready(function(){
    $("#formSlideImagem").on('change', function(e){
        preVisualizacaoImg("formSlideImagem");
    });
});

$(document).ready(function(){
    $("#formPostagemImagem").on('change', function(e){
        preVisualizacaoImg("formPostagemImagem");
    });
});

/*
Sistema de Notificação
*/
/*-----Formulários*/

//Funções
function enviarFormulario(formulario){
  var form=$('#'+formulario);
  var url = form.attr('action');
  var formData = new FormData(document.getElementById(formulario));
  $.ajax({
      url: url,
      method: 'post',
      //dataType: 'html',
      dataType: 'JSON',
      data: formData,
      processData: false,
      contentType: false,
      success: function(resposta){
          notificarFormularioJsonAlerta(resposta);
      }
  });
}

function notificarFormularioJsonAlerta(resposta){
    $("#DivMensgemAlerta").empty();
    if(resposta.sucesso){/*Em caso de Sucesso*/}
    else{/*Em caso de Erro*/}

    $.each(resposta.mensagem,function(key,value){
        $("#DivMensgemAlerta").append(value+'<br />');
    });

    if(resposta.redirecionar != null){
        //Em caso de haver uma URL
        window.location.href=resposta.redirecionar;
    }else{
        //Em caso de não houver uma URL
    }

    //document.getElementById('formDoacaoIdCadastrado').value = resposta.id_doacao;
    if(resposta.extra != null){
        notificarFormExtra(resposta.extra);
        /*$.each(resposta.extra,function(key,value){
            alert(key);
            alert(value);
        });*/
    }
}

function notificarFormExtra(array){
    $.each(array,function(key,value){
        if(key == 'id_doacao'){
            document.getElementById('formDoacaoIdCadastrado').value = value;
            alert("ID da Doação: " + value);
        }
    });
}

//Gatilhos
$(document).ready(function(){
    $("#formCadastro").on('submit',function(e){
        e.preventDefault();
        enviarFormulario('formCadastro');
        return false;
    });
});

$(document).ready(function(){
    $("#formAtualizar").on('submit',function(e){
        e.preventDefault();
        enviarFormulario('formAtualizar');
        return false;
    });
});

$(document).ready(function(){
    $("#formLogin").on('submit',function(e){
        e.preventDefault();
        enviarFormulario('formLogin');
        $("#formLogin").trigger("reset");
        return false;
    });
});

$(document).ready(function(){
    $("#formNovaSenha").on('submit',function(e){
        e.preventDefault();
        enviarFormulario('formNovaSenha');
        $("#formNovaSenha").trigger("reset");
        return false;
    });
});




/*Confimar exclusão*/

function fLinkExcluir(link){
    if(confirm("Deseja mesmo excluir esse registro?")){
        $.ajax({
            url: link,
            //method: 'post',
            method: 'get',
            //dataType: 'html',
            dataType: 'JSON',
            //data: formData,
            //processData: false,
            //contentType: false,
            success: function(resposta){
                notificarFormularioJsonAlerta(resposta);
            }
        });
    }else{
        //return false;
    }
    functionIrPagTelaListagem();
    return false;
}


/*
Mascara dos formularios
*/
//Doadora
VMasker(document.querySelector("#formDoadoraCpf")).maskPattern("999.999.999-99");
VMasker(document.querySelector("#formDoadoraCartaoSus")).maskPattern("999 9999 9999 9999");
VMasker(document.querySelector("#formDoadoraCelular")).maskPattern("(99) 99999 - 9999");
VMasker(document.querySelector("#formDoadoraEstado")).maskPattern("AA");
VMasker(document.querySelector("#formDoadoraCep")).maskPattern("99.999-999");
