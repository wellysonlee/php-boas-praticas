<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testeAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente(){
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

        public function testeAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDecrescente(){
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

            public function testeAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente(){
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

                public function testeAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente(){
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
    }    