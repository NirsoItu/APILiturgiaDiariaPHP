<?php

header("Access-Control-Allow-Origin: *");

   $dia = $_GET['dia'];
   $mes = $_GET['mes'];
   $ano = $_GET['ano'];

$dadosSite = file_get_contents("http://liturgiadiaria.cnbb.org.br/app/user/user/UserView.php?ano=$ano&mes=$mes&dia=$dia");
$titulos = explode('<h3 class="title-leitura">',$dadosSite);



$lista = array();
for( $i = 1; $i < count($titulos) ; $i++ )
    {
    $titulo = explode('</h3>', $titulos[$i]);
    $titulo[0] = trim($titulo[0]);

    $subTitulo = explode('</div>', $titulo[1]);
    $subTitulo[2] = trim( str_replace( "<div>", "", $subTitulo[2]));
    $subTitulo[2] = str_replace( "<br />", " ", $subTitulo[2]);
    $subTitulo[2] = str_replace( '<div class="cit_direita_italico">', "", $subTitulo[2]);
    $subTitulo[2] = str_replace( "<div class='cit_direita_italico'>", "", $subTitulo[2]);
    $subTitulo[3] = trim( str_replace( '<div class="cit_direita">', "", $subTitulo[3]) );

    $corpo = trim($subTitulo[4]);


    $retorno = new Leitura();
    $retorno->titulo = limpaTexto($titulo[0]);
    $retorno->subTituloA = limpaTexto($subTitulo[2]);
    $retorno->subTituloB = limpaTexto($subTitulo[3]);
    $retorno->texto = limpaTexto($corpo);
    $lista[] = $retorno;
    }
    echo json_encode($lista);


function limpaTexto( $texto )
   {
   $texto = strip_tags($texto);
   $texto = str_replace( '< type="text/java" src="/app/arquivos/bootstrap/js/addthis_widget.js#pubid=ra-4e1212f86ebe42f7"></>', " ", $texto );
   $texto = str_replace( "<span class='tab_num2'>", " - ", $texto );
   $texto = str_replace( "<div class='cit_direita '>", " ", $texto );
   $texto = str_replace( "<div class='cit_direita>", " ", $texto );
   $texto = str_replace( "<span class='tabulacao'>", " ", $texto );
   $texto = str_replace( '<br>', " ", $texto );
   $texto = str_replace( '<br />', " ", $texto );
   $texto = str_replace( '</p>', " ", $texto );
   $texto = str_replace( "<span class='tabulacao negrito'>", " ", $texto );
   $texto = str_replace( "<div class=\'refrao_salmo\'>", " ", $texto );
   $texto = str_replace( '<div class=\"refrao_salmo\">', " ", $texto );
   $texto = str_replace( "<span class=\"tabulacao\">", " ", $texto );
   $texto = str_replace( "<span class=\'tabulacao\'>", " ", $texto );
   $texto = str_replace( '<span class=\"tabulacao negrito\">', " ", $texto );
   $texto = str_replace( "<div class='refrao_salmo'>", " ", $texto );
   $texto = str_replace( '<div class="refrao_salmo">', " ", $texto );
   $texto = str_replace( "<span class=\"refrao_salmo\">", " ", $texto );
   $texto = str_replace( "<pan class='tabulacao'>", " ", $texto );
   $texto = str_replace( "<div id=\"171\" style=\"display: none;\">", " ", $texto );
   $texto = str_replace( "<span CLASS='tabulacao negrito'>", " ", $texto );
   $texto = str_replace( "<span class='refrao_salmo'>", " ", $texto );
   $texto = str_replace( "<span class=' tab_num'>", " ", $texto );
   $texto = str_replace( "<span class=' tab_num '>", " ", $texto );
   $texto = str_replace( '<div id="3098" style="display: none;">', " ", $texto );
   $texto = str_replace( "<div id=\"3\" style=\"display: none;\">", " ", $texto );
   $texto = str_replace( '<span class="negrito tabulacao">', " ", $texto );
   $texto = str_replace( '"<div class="refrao_salmo">"', " ", $texto );
   $texto = str_replace( "<div id='3098' style='display: none;'>", " ", $texto );
   $texto = str_replace( "<span class='negrito tabulacao'>", " ", $texto );
   $texto = str_replace( '<span class="tabulacao">', " ", $texto );
   $texto = str_replace( "<span class='tabulacao'>", " ", $texto );
   $texto = str_replace( '<span class="tabulacao negrito">', " ", $texto );
   $texto = str_replace( "<p>", "", $texto );
   $texto = str_replace( '<span class="tab_num">', " ", $texto );
   $texto = str_replace( '<span class="tab_num1">', " ", $texto );
   $texto = str_replace( '<span class="tab_num2">', " ", $texto );
   $texto = str_replace( '<span class="tab_num3">', " ", $texto );
   $texto = str_replace( '<span class="tab_num4">', " ", $texto );
   $texto = str_replace( '<span class="tab_num5">', " ", $texto );
   $texto = str_replace( '<span class="tab_num6">', " ", $texto );
   $texto = str_replace( '<span class="tab_num7">', " ", $texto );
   $texto = str_replace( '<span class="tab_num8">', " ", $texto );
   $texto = str_replace( '<span class="tab_num9">', " ", $texto );
   $texto = str_replace( '<span class="tab_num10">', " ", $texto );
   $texto = str_replace( "<span class='tab_num'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num1'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num2'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num3'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num4'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num5'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num6'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num7'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num8'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num9'>", " ", $texto );
   $texto = str_replace( "<span class='tab_num10'>", " ", $texto );
   $texto = str_replace( '<div class="cit_direita_italico">', " ", $texto );
   $texto = str_replace( "<div class='cit_direita_italico'>", " ", $texto );
   $texto = str_replace( "<div class='cit_direita'>", " ", $texto );
   $texto = str_replace( '<div class="cit_direita">', " ", $texto );
   $texto = str_replace( '&nbsp;', "", $texto );
   $texto = str_replace( '&eth;', "õ", $texto );
   $texto = str_replace( '&Eth;', "Õ", $texto );
   $texto = str_replace( "</span>", " ", $texto );
   $texto = str_replace( "</span>", " ", $texto );
   $texto = str_replace(array("\n", "\r"), '', $texto);
   $texto = str_replace( "&ordf;", "ª", $texto );
   $texto = str_replace( "&ordm;", "º", $texto );
   $texto = str_replace( "&deg;", "°", $texto );
   $texto = str_replace( "*", " ", $texto );
   $texto = str_replace( "+", " ", $texto );
   $texto = str_replace( "&atilde;", "ã", $texto );
   $texto = str_replace( "&Atilde;", "Ã", $texto );
   $texto = str_replace( "&otilde;", "õ", $texto );
   $texto = str_replace( "&Otilde;", "Õ", $texto );
   $texto = str_replace( "&aacute;", "á", $texto );
   $texto = str_replace( "&Aacute;", "Á", $texto );
   $texto = str_replace( "&eacute;", "é", $texto );
   $texto = str_replace( "&Eacute;", "É", $texto );
   $texto = str_replace( "&iacute;", "í", $texto );
   $texto = str_replace( "&Iacute;", "Í", $texto );
   $texto = str_replace( "&oacute;", "ó", $texto );
   $texto = str_replace( "&Oacute;", "Ó", $texto );
   $texto = str_replace( "&uacute;", "ú", $texto );
   $texto = str_replace( "&Uacute;", "Ú", $texto );
   $texto = str_replace( "&ccedil;", "ç", $texto );
   $texto = str_replace( "&Ccedil;", "Ç", $texto );
   $texto = str_replace( "R.", " ", $texto );
   $texto = str_replace( "&Acirc;", "Â", $texto );
   $texto = str_replace( "&acirc;", "â", $texto );
   $texto = str_replace( "&ocirc;", "ô", $texto );
   $texto = str_replace( "&Ocirc;", "Ô", $texto );
   $texto = str_replace( "&agrave;", "à", $texto );
   $texto = str_replace( "&Agrave;", "À", $texto );
   $texto = str_replace( "&Ecirc;", "Ê", $texto );
   $texto = str_replace( "&ecirc;", "ê", $texto );
   $texto = str_replace( "&uacute;", "ú", $texto );
   $texto = str_replace( "&Uacute;", "Ú", $texto );
   return $texto;
   }
  
   class Leitura
   {
       public $titulo;
       public $subTituloA;
       public $subTituloB;
       public $texto;
   }

?>