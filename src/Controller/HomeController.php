<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Campanha;
use App\Entity\Pontuacao;
use App\Entity\Cla;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="app_home")
     */
    public function home(): Response {
        $campanha = $this->getDoctrine()->getRepository(Campanha::class)->findOneByEncerrada(false);
        $pontuacaoGeral = $this->getDoctrine()->getRepository(Pontuacao::class)->groupByCla($campanha);
        $ultimosPontos = $this->getDoctrine()->getRepository(Pontuacao::class)->findBy(['campanha' => $campanha], ['id' => 'DESC'], 10);
        return $this->render('home/default.html.twig', [
                    'campanha' => $campanha,
                    'pontuacaoGeral' => $pontuacaoGeral,
                    'ultimosPontos' => $ultimosPontos,
        ]);
    }

    /**
     * @Route("/campanha", name="app_campanha")
     */
    public function campanha(): Response {
        $campanha = $this->getDoctrine()->getRepository(Campanha::class)->findOneByEncerrada(false);
        $pontuacaoGeral = $this->getDoctrine()->getRepository(Pontuacao::class)->groupByCla($campanha);
        $pontuacoes = $this->getDoctrine()->getRepository(Pontuacao::class)->findBy(['campanha' => $campanha], ['id' => 'DESC']);
        return $this->render('home/campanha.html.twig', [
                    'campanha' => $campanha,
                    'pontuacaoGeral' => $pontuacaoGeral,
                    'pontuacoes' => $pontuacoes,
        ]);
    }
    
    /**
     * @Route("/clas", name="app_clas")
     */
    public function clas(): Response {
        $clas = $this->getDoctrine()->getRepository(Cla::class)->findAll();
        return $this->render('home/clas.html.twig',[
           'clas' => $clas 
        ]);
    }

}
