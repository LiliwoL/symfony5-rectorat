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

    /**
     * Affichage de la liste des films
     * 
     * @Route(
     *      "/list",
     *      name="List"
     * )
     */
    public function list() : Response
    {
        // Préparation d'un renvoi d'une vue LISTE
        return $this->render(
            'movie/list.html.twig',
            [
                'cle' => 'valeur'
            ]
        );
    }

    /**
     * Affichage de la fiche d'un film
     * 
     * > Paramètre dans l'url
     * > Paramètre décimal
     * 
     * @Route(
     *      "/{idMovie}",
     *      name="Show",
     *      requirements={"idMovie"="\d+"}
     * )
     */
    public function showMovie(int $idMovie) : Response
    {
        return new Response("Fiche demandée " . $idMovie);
    }
}
