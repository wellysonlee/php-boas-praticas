<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

//Prepara
$leilao = new Leilao('Fiat 147 0KM');

$wellyson = new Usuario('Wellyson');
$rayane = new Usuario('Rayane');

$leilao->recebeLance(new Lance($wellyson, 2000));
$leilao->recebeLance(new Lance($rayane, 2500));

// Executa
$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();

// Verifica
$valorEsperado = 2500;

if ($maiorValor == $valorEsperado){
    echo "Teste OK.";
} else {
    echo 'Teste falhou';
}