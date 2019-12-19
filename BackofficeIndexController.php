<?php

namespace  App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controleur de la page d'accueil admin
 */
class BackofficeIndexController extends Controller {
    /**
     * @Route("/admin", name = "admin", methods="GET|POST")
     */
    public function indexAction()
    {
        return $this->render('back/back.html.twig');
    }
}