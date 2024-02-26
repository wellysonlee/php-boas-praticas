<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    /** @var Avaliador */
    private $leiloeiro;
    protected function setUp():void
    {
        $this->leiloeiro = new Avaliador();
    }
    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMaiorValorDeLances(Leilao $leilao){

        //Executa - ACT/When
        $this->leiloeiro->avalia($leilao);

        $maiorValor = $this->leiloeiro->getMaiorValor();

        //Testa - ACERT/Then
        self::assertEquals(2500, $maiorValor);
        }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMenorValorDeLances(Leilao $leilao){
        
        //Executa - ACT/When
        $this->leiloeiro->avalia($leilao);
        
        $menorValor = $this->leiloeiro->getMenorValor();
        
        //Testa - ACERT/Then
        self::assertEquals(1700, $menorValor);
        }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
        public function testAvaliadorDeveBuscar3MaioresValores(Leilao $leilao){
        
        $this->leiloeiro->avalia($leilao);

        $maiores = $this->leiloeiro->getMaioresLances();
        static::assertCount(3, $maiores);
        static::assertEquals(2500, $maiores[0]->getValor());
        static::assertEquals(2000, $maiores[1]->getValor());
        static::assertEquals(1700, $maiores[2]->getValor());
    }

    public function testLeilaoVazioNaoPodeSerAvaliado()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar leilão vazio');
        $leilao = new Leilao('Fusca Azul');
        $this->leiloeiro->avalia($leilao);
    }
    
    public function testLeilaoFinalizadoNaoPodeSerAvaliado()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Leilão já finalizado');
    
        $leilao = new Leilao('Fiat 147 0KM');
        $leilao->recebeLance(new Lance(new Usuario('Teste'), 2000));
        $leilao->finaliza();
    
        $this->leiloeiro->avalia($leilao);
    }
/**  --------DADOS------------- */
   public static function leilaoEmOrdemCrescente ()
    {
        $leilao = new Leilao('Fiat 147 0KM');
            
        $wellyson = new Usuario('Wellyson');
        $weslley = new Usuario('Weslley');
        $lena = new Usuario('Lena');
        
        $leilao->recebeLance(new Lance($lena, 1700));
        $leilao->recebeLance(new Lance($wellyson, 2000));
        $leilao->recebeLance(new Lance($weslley, 2500));

        return [
            'ordem-crescente'=> [$leilao]
        ];
    }

   public static function leilaoEmOrdemDecrescente ()
    {
        $leilao = new Leilao('Fiat 147 0KM');
            
        $wellyson = new Usuario('Wellyson');
        $weslley = new Usuario('Weslley');
        $lena = new Usuario('Lena');

        $leilao->recebeLance(new Lance($weslley, 2500));
        $leilao->recebeLance(new Lance($wellyson, 2000));
        $leilao->recebeLance(new Lance($lena, 1700));
        
        return [
            'ordem-decrescente'=> [$leilao]
        ];
    }

   public static function leilaoEmOrdemAleatoria ()
    {
        $leilao = new Leilao('Fiat 147 0KM');
            
        $wellyson = new Usuario('Wellyson');
        $weslley = new Usuario('Weslley');
        $lena = new Usuario('Lena');
        
        $leilao->recebeLance(new Lance($wellyson, 2000));
        $leilao->recebeLance(new Lance($weslley, 2500));
        $leilao->recebeLance(new Lance($lena, 1700));
        
        return [
            'ordem-aleatoria'=> [$leilao]
        ];
    }
    
    }    