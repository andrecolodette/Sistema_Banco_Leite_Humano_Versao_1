<!--Slide Show-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo">

        <div class="DivSlideShow">
            <!--Slides-->
            <?php
            $t = $this->slideShow->rowCount();
            $t += 1;
            ?>

            <div class="mySlide fade">
                <a href="#">
                    <div class="slideNumber">1 / <?php echo $t; ?></div>
                    <img class="imgSlide w100" src="<?php echo DIRIMG."slide/slide_padrao.jpeg"?>" alt="Imagem do Slide 1">
                    <div class="slideText">LEITICIA - Banco de Leite Humano</div>
                </a>
            </div>

            <?php
            $n = 2;
            foreach($this->slideShow as $slide){
                echo "<div class='mySlide fade'> \n";
                echo "    <a href='".$slide['link']."' target='_blank'> \n";
                echo "        <div class='slideNumber'>$n / $t</div> \n";
                echo "        <img class='imgSlide w100' src='".DIRIMG."slide/".$slide['imagem']."' alt='Imagem do Slide $n'> \n";
                echo "        <div class='slideText'>".$slide['titulo']."</div> \n";
                echo "    </a> \n";
                echo "</div>";
                $n++;
            }
            ?>

            <!--Botões de Avançar e Voltar-->
            <a class="slidePrev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="slideNext" onclick="plusSlides(1)">&#10095;</a>
            <!--Indicadores-->
            <div class="slideIndicador textCenter">
                <span class="slideDot" onclick="currentSlide(1)"></span>
                <?php
                for($i = 2; $i<$n; $i++){
                    echo "<span class='slideDot' onClick='currentSlide($i)'></span> \n";
                }
                ?>
            </div>
        </div>

    </div>
</div>


<!--Postagem-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo">


      <?php
      $t = $this->postagem->rowCount();
      $area;
      $i;
      if($t == 1){
          $area = "wp100";
          $i = $t;
      }elseif(($t % 2) == 0){
          $area = "wp50";
          $i = $t;
      }elseif(($t % 3) == 0){
          $area = "wp33";
          $i = $t;
      }else{
          $area = "wp33";
          $i = 3;
      }

      $n = 0;
      foreach($this->postagem as $post){
          $n++;
          echo "<div class='divisaoPostagem $area'> \n";
          echo "    <div class='myPostagem'> \n";
          echo "        <div class='imgPostagem w100'> \n";
          echo "            <img class='' src='".DIRIMG."postagem/".$post['imagem']."' alt='Imagem da Postagem $n'> \n";
          echo "        </div> \n";
          echo "        <div class='ConteudoPostagem w100'> \n";
          echo "            <header class='w100'> \n";
          echo "                <h2 class='w100'>".$post['titulo']."</h2> \n";
          echo "            </header> \n";
          echo "            <section class='w100'> \n";
          echo "                <p class='w100'>".$post['descricao']."</p> \n";
          echo "            </section> \n";
          echo "            <footer class='w100'> \n";
          echo "                <a class='buttonBasico' href='".DIRFILE."postagem/".$post['arquivo']."' target='_blank'>Leia Mais!</a> \n";
          echo "            </footer> \n";
          echo "        </div> \n";
          echo "    </div> \n";
          echo "</div> \n";

          $i--;
          if($i <= 0){
              if($n < $t){
                  if(($t - $n) >= 3){
                      $area = "wp33";
                      $i = 3;
                  }else{
                      $area = "wp50";
                      $i = 2;
                  }
              }
          }
      }
      ?>
    </div>
</div>


<div class="DivPosicaoConteudo"></div>
