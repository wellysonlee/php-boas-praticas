<?php

namespace Alura\Leilao\tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testUm () 
    {
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
        self::assertEquals(2500, $maiorValor);
    }
    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente()
    {
    // Arrange - Given / Preparamos o cenário do teste
    $leilao = new Leilao('Fiat 147 0km');

    $maria = new Usuario('Maria');
    $joao = new Usuario('Joao');

    $leilao->recebeLance(new Lance($maria, 2500));
    $leilao->recebeLance(new Lance($joao, 2000));


    $leiloeiro = new Avaliador();

    // Act - When / Executamos o código a ser testado
    $leiloeiro->avalia($leilao);

    $menorValor = $leiloeiro->getMenorValor();

    // Assert - Then / Verificamos se a saída é a esperada
    self::assertEquals(2000, $menorValor);

    }
    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente()
    {
    // Arrange - Given / Preparamos o cenário do teste
    $leilao = new Leilao('Fiat 147 0km');

    $maria = new Usuario('Maria');
    $joao = new Usuario('Joao');

    $leilao->recebeLance(new Lance($joao, 2000));
    $leilao->recebeLance(new Lance($maria, 2500));
    
    $leiloeiro = new Avaliador();

    // Act - When / Executamos o código a ser testado
    $leiloeiro->avalia($leilao);

    $menorValor = $leiloeiro->getMenorValor();

    // Assert - Then / Verificamos se a saída é a esperada
    self::assertEquals(2000, $menorValor);

    }

    public function testAvaliadorDeveBuscar3MaioresValores()
    {
    $leilao = new Leilao('Fiat 147 0KM');
    $wellyson = new Usuario('João');
    $rayane = new Usuario('Maria');
    $rayssa = new Usuario('Ana');
    $weslley = new Usuario('weslley');

    $leilao->recebeLance(new Lance($rayane, 1500));
    $leilao->recebeLance(new Lance($wellyson, 2500));
    $leilao->recebeLance(new Lance($rayssa, 2000));
    $leilao->recebeLance(new Lance($weslley, 1700));

    $leiloeiro = new Avaliador();
    $leiloeiro->avalia($leilao);

    $maiores = $leiloeiro->getMaioresLances();
    static::assertCount(3,$maiores);
    static::assertEquals(2500, $maiores[0]->getValor());
    static::assertEquals(2000, $maiores[1]->getValor());
    static::assertEquals(1700, $maiores[2]->getValor());
    }

}