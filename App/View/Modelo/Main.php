<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb3">
            <li class=""><a href="#">Novo</a></li>
            <li class=""><a href="#">Listagem</a></li>
            <li class=""><a href="#">Opções</a></li>
        </ul>
    </nav>
</div>

<!--Slide Show-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo">

        <div class="DivSlideShow">
            <!--Slides-->
            <div class="mySlide fade">
                <a href="https://www.w3schools.com/howto/img_mountains_wide.jpg" target="_blank">
                    <div class="slideNumber">1 / 3</div>
                    <img class="imgSlide w100" src="https://www.w3schools.com/howto/img_mountains_wide.jpg" alt="Imagem do Slide 1">
                    <div class="slideText">Titulo do Slide 1</div>
                </a>
            </div>
            <div class="mySlide fade">
                <a href="https://www.w3schools.com/howto/img_snow_wide.jpg" target="_blank">
                    <div class="slideNumber">2 / 3</div>
                    <img class="imgSlide w100" src="https://www.w3schools.com/howto/img_snow_wide.jpg" alt="Imagem do Slide 2">
                    <div class="slideText">Titulo do Slide 2</div>
                </a>
            </div>
            <div class="mySlide fade">
                <a href="https://www.w3schools.com/howto/img_nature_wide.jpg" target="_blank">
                    <div class="slideNumber">3 / 3</div>
                    <img class="imgSlide w100" src="https://www.w3schools.com/howto/img_nature_wide.jpg" alt="Imagem do Slide 3">
                    <div class="slideText">Titulo do Slide 3</div>
                </a>
            </div>
            <!--Botões de Avançar e Voltar-->
            <a class="slidePrev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="slideNext" onclick="plusSlides(1)">&#10095;</a>
            <!--Indicadores-->
            <div class="slideIndicador textCenter">
                <span class="slideDot" onclick="currentSlide(1)"></span>
                <span class="slideDot" onclick="currentSlide(2)"></span>
                <span class="slideDot" onclick="currentSlide(3)"></span>
            </div>
        </div>

    </div>
</div>

<!--Postagem-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo">

      <div class="divisaoPostagem">
          <div class="myPostagem">
              <div class="imgPostagem w100">
                  <img class="w100 h100" src="https://www.w3schools.com/howto/img_mountains_wide.jpg" alt="Imagem da Postagem 1">
              </div>
              <div class="ConteudoPostagem w100">
                  <header class="w100">
                      <h2 class="w100">Titulo da Postagem 1</h2>
                  </header>
                  <section class="w100">
                      <p class="w100">Breve Introdução / Conteudo da Postagem 1</p>
                  </section>
                  <footer class="w100">
                      <a class="buttonBasico" href="#" target="_blank">Leia Mais!</a>
                  </footer>
              </div>
          </div>
      </div>
      <div class="divisaoPostagem">
          <div class="myPostagem">
              <div class="imgPostagem w100">
                  <img class="w100 h100" src="https://www.w3schools.com/howto/img_snow_wide.jpg" alt="Imagem da Postagem 1">
              </div>
              <div class="ConteudoPostagem w100">
                  <header class="w100">
                      <h2 class="w100">Titulo da Postagem 2</h2>
                  </header>
                  <section class="w100">
                      <p class="w100">Breve Introdução / Conteudo da Postagem 2</p>
                  </section>
                  <footer class="w100">
                      <a class="buttonBasico" href="#" target="_blank">Leia Mais!</a>
                  </footer>
              </div>
          </div>
      </div>
      <div class="divisaoPostagem">
          <div class="myPostagem">
              <div class="imgPostagem w100">
                  <img class="w100 h100" src="https://www.w3schools.com/howto/img_nature_wide.jpg" alt="Imagem da Postagem 1">
              </div>
              <div class="ConteudoPostagem w100">
                  <header class="w100">
                      <h2 class="w100">Titulo da Postagem 3</h2>
                  </header>
                  <section class="w100">
                      <p class="w100">Breve Introdução / Conteudo da Postagem 3</p>
                  </section>
                  <footer class="w100">
                      <a class="buttonBasico" href="#" target="_blank">Leia Mais!</a>
                  </footer>
              </div>
          </div>
      </div>
    </div>
</div>

<!--Formulario-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor">
        <form class="Form" id="" name="" action="" method="post" enctype="multipart/form-data">
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo Text - Obrigatório
                    <input class="campoForm" type="text" id="" name="" value="" placeholder="Mensagem de Fundo" required>
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo Number
                    <input class="campoForm" type="number" id="" name="" value="" placeholder="Mensagem de Fundo">
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo Date
                    <input class="campoForm" type="date" id="" name="" value="" placeholder="Mensagem de Fundo">
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo E-mail
                    <input class="campoForm" type="email" id="" name="" value="" placeholder="Mensagem de Fundo">
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo Password
                    <input class="campoForm" type="password" id="" name="" value="" placeholder="Mensagem de Fundo">
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo URL
                    <input class="campoForm" type="url" id="" name="" value="" placeholder="Mensagem de Fundo">
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo File
                    <input class="campoForm" type="file" id="" name="" value="" placeholder="Mensagem de Fundo">
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo Select
                    <select class="campoForm" id="" name="">
                        <option value="">Opção 01</option>
                        <option value="">Opção 02</option>
                        <option value="">Opção 03</option>
                        <option value="">Opção 04</option>
                    </select>
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo Radio - Sexo</label>
                <label class="campoMarcar wp50">
                    <input type="radio" id="" name="sexo" value="" placeholder="Mensagem de Fundo" checked>
                    <p>Campo Radio - Masculino</p>
                </label>
                <label class="campoMarcar wp50">
                    <input type="radio" id="" name="sexo" value="" placeholder="Mensagem de Fundo">
                    <p>Campo Radio - Feminino</p>
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo Checkbox</label>

                <label class="campoMarcar wp50">
                    <input type="checkbox" id="" name="" value="" placeholder="Mensagem de Fundo">
                    <p>Campo Checkbox - 01</p>
                </label>
                <label class="campoMarcar wp50">
                    <input type="checkbox" id="" name="" value="" placeholder="Mensagem de Fundo">
                    <p>Campo Checkbox - 02</p>
                </label>
            </div>
            <div class="divCamposForm wp100">
                <label class="labelForm">Campo Ranger
                    <input class="campoForm" type="range" id="" name="" value="" placeholder="Mensagem de Fundo">
                </label>
            </div>

            <div class="DivBotoes">
                <ul class="actions">
                    <li><input class="buttonBasico" type="submit" value="Submeter!"></li>
                    <li><input class="buttonBasico" type="reset" value="Resetar!"></li>
                </ul>
            </div>

        </form>
    </div>
</div>

<!--Tabela/Listagem-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor">
        <div class="tabelaRolagem">
            <table class="tableListagem">
                <col class="colN">
                <col class="">
                <col class="">
                <col class="">
                <col class="">
                <col class="colAcaoes nb3">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>COLUNA 1</th>
                        <th>COLUNA 2</th>
                        <th>COLUNA 3</th>
                        <th>COLUNA 4</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Conteudo 1 / 1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <ul class="acoes nb3">
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/visualizar_16.png' ?>" alt="Visualizar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/edite_16.png' ?>" alt="Editar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/lixeira_16.png' ?>" alt="Excluir"></a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Conteudo 1 / 2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <ul class="acoes nb3">
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/visualizar_16.png' ?>" alt="Visualizar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/edite_16.png' ?>" alt="Editar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/lixeira_16.png' ?>" alt="Excluir"></a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Conteudo 1 / 3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <ul class="acoes nb3">
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/visualizar_16.png' ?>" alt="Visualizar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/edite_16.png' ?>" alt="Editar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/lixeira_16.png' ?>" alt="Excluir"></a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Conteudo 1 / 4</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <ul class="acoes nb3">
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/visualizar_16.png' ?>" alt="Visualizar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/edite_16.png' ?>" alt="Editar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/lixeira_16.png' ?>" alt="Excluir"></a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Conteudo 1 / 5</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <ul class="acoes nb3">
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/visualizar_16.png' ?>" alt="Visualizar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/edite_16.png' ?>" alt="Editar"></a></li>
                                <li><a class="buttonBasico buttonAcao" href="#"><img class="iconAcao" src="<?php echo DIRIMG.'icon/lixeira_16.png' ?>" alt="Excluir"></a></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="divPaginacao">
            <ul>
                <li><a href="#">1 <<</a></li>
                <li><a href="#"><</a></li>
                <li class="ocultarPequeno"><a href="#">#-2</a></li>
                <li class="ocultarPequeno"><a href="#">#-1</a></li>
                <li><a href="#">#</a></li>
                <li class="ocultarPequeno"><a href="#">#+1</a></li>
                <li class="ocultarPequeno"><a href="#">#+2</a></li>
                <li><a href="#">></a></li>
                <li><a href="#">>> N</a></li>
            </ul>
        </div>
    </div>
</div>

<!--Página Básica de Conteudo/Texto-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor h500">
        <p class="pagTexto">
            Página Básica de Conteudo/Texto - O tamnho pode ser facilmente alterado
        </p>
    </div>
</div>

<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor">
        Sem nada - está aqui de sobra!
    </div>
</div>

<div class="DivPosicaoConteudo"></div>
