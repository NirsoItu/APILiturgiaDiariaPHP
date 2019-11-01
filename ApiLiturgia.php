<?php
   header("Access-Control-Allow-Origin: *");

   $dia = $_GET['dia'];
   $mes = $_GET['mes'];
   $ano = $_GET['ano'];
   
   $url = "http://liturgiadiaria.cnbb.org.br/app/user/user/UserView.php?ano=$ano&mes=$mes&dia=$dia";

   $dados = file_get_contents($url);
   $dados = mb_convert_encoding($dados, 'HTML-ENTITIES', "UTF-8");

   $dataSemana1 = '<div class="bs-callout bs-callout-info">';
   $posIniData = strpos($dados , $dataSemana1   );
   $posFinalData = strpos($dados, "</em>");

  // echo "Ini:".$posIniData." -fin:".($posFinalData-$posIniData);
    
   $dataSemana = substr( $dados, $posIniData + strlen($dataSemana1) , $posFinalData-$posIniData);
   
   LimpaSemana( $dataSemana );
  

   //Pega o titulo e texto

   $texto1 = '<div id="corpo_leituras">';
   $posIni = strpos($dados , $texto1);
   $posFinal = strpos($dados, "<!-- /.blog-post -->");

   $texto = substr( $dados, $posIni + strlen($texto1) , $posFinal-$posIni);


   $arrTexto = explode( '<h3 class="title-leitura">', $texto);

   $lista = array();
   for( $i=1; $i < count( $arrTexto) ; $i++)
   {
        $lista[] = limpaTexto( $arrTexto[$i]);
   }
   

   echo json_encode($lista);

   

   function LimpaSemana( $texto )
   {
       $tempo = GetFromTags($texto, "<h2>", "</h2>");
       $dia = GetFromTags($texto, "<strong>", "</strong>");
       $frase = GetFromTags($texto,"<h2>",'</h2>');
       $cor = GetFromTags($texto."<em>","Cor:", '</em>');

       //echo "Tempo:".$tempo." Data:".$dia." Frase:".$frase."Cor:".$cor;    

       $retorno = new Tempos();
       $retorno->tempo = $tempo;
       $retorno->dia = $dia;
       $retorno->frase = $frase;
       $retorno->cor = $cor;
    
      
       $retorno->tempo = strip_tags( $tempo );
       $retorno->tempo = strip_tags( $dia );
       $retorno->tempo = strip_tags( $frase );
       $retorno->tempo = strip_tags( $cor ); 
    
       return $retorno;
   }
   
   


   function GetFromTags( $texto, $tag1, $tag2 )
   {
      $posA = strpos($texto, $tag1)+strlen($tag1);
      $posB = strpos($texto, $tag2);
      
      return substr($texto, $posA, $posB-$posA );

   }

   
   function limpaTexto( $texto )
   {
   $texto = str_replace( '< type="text/java" src="/app/arquivos/bootstrap/js/addthis_widget.js#pubid=ra-4e1212f86ebe42f7"></>', "", $texto );
   $texto = str_replace( "<span class='tab_num2'>", " - ", $texto );
   $texto = str_replace( "<span class='tabulacao'>", "", $texto );
   $texto = str_replace( "</span>", "", $texto );
   $texto = str_replace(array("\n", "\r"), '', $texto);
   $texto = str_replace( "&ordf;", "ª", $texto );
   $texto = str_replace( "&ordm;", "º", $texto );
   $texto = str_replace( "&deg;", "°", $texto );
   $texto = str_replace( "*", "", $texto );
   $texto = str_replace( "+", "", $texto );
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
   $texto = str_replace( "R.", "", $texto );
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
   

   $titEnd = strpos( $texto, "</h3>" );
   
   $titulo = trim( substr( $texto, 0, $titEnd) );

   $retorno = new Leitura();
   $retorno->titulo = $titulo;

   $texto = trim( substr( $texto, $titEnd + 5, strlen($texto)-$titEnd+5) );
   $texto = str_replace(array("\n", "\r", "\t"), '', $texto);
   $retorno->texto = strip_tags( $texto ); // strip_tags( $texto );

   return $retorno;
   }
  
   class Leitura
   {
       public $titulo;

       public $texto;
   }

   class Tempos
   {
       public $tempo;

       public $dia;

       public $frase;

       public $cor;
   }
   ?>