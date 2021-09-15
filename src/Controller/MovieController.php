<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ici on déclare un "préfixe" de route
 * @Route(
 *      "/movie",
 *      name="Movie_"
 * )
 */
class MovieController extends AbstractController
{
    /**
     * @Route(
     *  "_index",
     *  name="Index"
     * )
     */
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }
}
