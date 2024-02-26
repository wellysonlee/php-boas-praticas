<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente(){
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
        self::assertEquals(2500, $maiorValor);
        }

    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDecrescente(){
        $leilao = new Leilao('Fiat 147 0KM');
    
        $wellyson = new Usuario('Wellyson');
        $weslley = new Usuario('Weslley');
    
        $leilao->recebeLance(new Lance($weslley, 2500));
        $leilao->recebeLance(new Lance($wellyson, 2000));
    
        $leiloeiro = new Avaliador();
    
        //Executa - ACT/When
        $leiloeiro->avalia($leilao);
    
        $maiorValor = $leiloeiro->getMaiorValor();
    
        //Testa - ACERT/Then
        self::assertEquals(2500, $maiorValor);
        }

    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente(){
        $leilao = new Leilao('Fiat 147 0KM');
        
        $wellyson = new Usuario('Wellyson');
        $weslley = new Usuario('Weslley');
        
        $leilao->recebeLance(new Lance($weslley, 2500));
        $leilao->recebeLance(new Lance($wellyson, 2000));
        
        $leiloeiro = new Avaliador();
        
        //Executa - ACT/When
        $leiloeiro->avalia($leilao);
        
        $menorValor = $leiloeiro->getMenorValor();
        
        //Testa - ACERT/Then
        self::assertEquals(2000, $menorValor);
        }

    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente(){
        $leilao = new Leilao('Fiat 147 0KM');
            
        $wellyson = new Usuario('Wellyson');
        $weslley = new Usuario('Weslley');
            
        $leilao->recebeLance(new Lance($wellyson, 2000));
        $leilao->recebeLance(new Lance($weslley, 2500));
            
        $leiloeiro = new Avaliador();
            
        //Executa - ACT/When
        $leiloeiro->avalia($leilao);
        
        $menorValor = $leiloeiro->getMenorValor();
            
        //Testa - ACERT/Then
        self::assertEquals(2000, $menorValor);
        }

    public function testAvaliadorDeveBuscar3MaioresValores(){
        $leilao = new Leilao('Fiat 147 0KM');
        $wellyson = new Usuario('Wellyson');
        $weslley = new Usuario('Weslley');
        $lena = new Usuario('Lena');
        $arnaldo = new Usuario('Arnaldo');

        $leilao->recebeLance(new Lance($lena, 1500));
        $leilao->recebeLance(new Lance($wellyson, 1000));
        $leilao->recebeLance(new Lance($weslley, 2000));
        $leilao->recebeLance(new Lance($arnaldo, 1700));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiores = $leiloeiro->getMaioresLances();
        static::assertCount(3, $maiores);
        static::assertEquals(2000, $maiores[0]->getValor());
        static::assertEquals(1700, $maiores[1]->getValor());
        static::assertEquals(1500, $maiores[2]->getValor());
    }
    
    }    