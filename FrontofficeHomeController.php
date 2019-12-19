<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;
use App\Entity\ProgrammationCircuit;

class FrontofficeHomeController extends AbstractController
{
    /**
     * @Route("/home", name="frontoffice_home")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $programmations = $em->getRepository(ProgrammationCircuit::class)->findAll();
        $circuits = $em->getRepository(Circuit::class)->findAll();
        
        dump($programmations);
        dump($circuits);
        
        return $this->render('front/home.html.twig', array(
            'programmations' => $programmations,
            'circuits' => $circuits,
        ));
    }
    /**
     * Finds and displays a circuit entity.
     *
     * @Route("/circuit/{id}", name="front_circuit_show")
     */
    public function circuitShow($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $programmation = $em->getRepository(ProgrammationCircuit::class)->find($id);
        
        dump($programmation);
        
        return $this->render('front/circuit_show.html.twig', [
            'programmation' => $programmation,
        ]);
    }
    /**
     * @Route("/circuit/likes/{id}", name="frontoffice_circuit_likes")
     */
    public function circuitLike($id)
    {
        $em = $this->getDoctrine()->getManager();
        $programmation = $em->getRepository(ProgrammationCircuit::class)->find($id);
        $likes = $this->get('session')->get('likes');
        
        // si l'identifiant n'est pas présent dans le tableau des likes, l'ajouter
        if ( $likes == null || (! in_array($id, $likes)) )
        {
            $likes[] = $id;
        }
        else
        // sinon, le retirer du tableau
        {
            $likes = array_diff($likes, array($id));
        }
        $this->get('session')->set('likes', $likes);
        
        
        dump($likes);
        
        return $this->render('front/circuit_show.html.twig', array(
            'programmation' => $programmation,
        ));
    }
}
