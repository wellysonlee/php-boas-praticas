<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

//Prepara - ARRANGE/Given
$leilao = new Leilao('Fiat 147 0KM');

$wellyson = new Usuario('Wellyson');
$weslley = new Usuario('Weslley');

$leilao->recebeLance(new Lance($wellyson, 2000));
$leilao->recebeLance(new Lance($weslley, 2500));

$leiloeiro = new Avaliador();

//Executa - ACT/When
$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();

//Testa - ACERT/Then
$valorEsperado = 2500;

if($valorEsperado == $maiorValor){
    echo "TESTE OK.";
} else {
    echo "TESTE FALHOU.";
}