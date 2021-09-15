<?php

namespace App\Controller;

use App\Form\MovieType;
use App\Repository\MovieRepository;
use stdClass;
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
    private $repository;

    public function __construct(MovieRepository $movieRepository)
    {
        // Chargement du movieRepository a la construction de ce controller
        $this->repository = $movieRepository;
    }

    /**
     * @Route(
     *  "_index",
     *  name="Index"
     * )
     */
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', 
            [
                'controller_name' => 'Rectorat',
            ]
        );
    }

    /**
     * Affichage de la liste des films
     * 
     * -> injection de la dépendance MovieRepository
     * 
     * @Route(
     *      "/list/{format}",
     *      name="List"
     * )
     */
    public function list(string $format = 'html') : Response
    {
        // Tableau de données fourni
        /* $movies = [
            [
                'id' => 1,
                'title' => 'Dune',
                'poster' => 'https://s1.qwant.com/thumbr/700x0/b/d/2e596fb92994ec190a3154c4d2dc9d0dc2bb9efe822e1ac6eafdba61e549b4/eedb3f70ef_50159947_dunes-mouvement-communication.jpg?u=https%3A%2F%2Fcdn.futura-sciences.com%2Fbuildsv6%2Fimages%2Flargeoriginal%2Fe%2Fe%2Fd%2Feedb3f70ef_50159947_dunes-mouvement-communication.jpg&q=0&b=1&p=0&a=0'
            ],
            [
                'id' => 2,
                'title' => 'Dune2',
                'poster' => 'https://s1.qwant.com/thumbr/0x380/3/c/cb51f543a7863dc374d37661c6f6db2aa09639b44cf5daf2bee95576454065/DUNE-1068x601.jpg?u=https%3A%2F%2Fwww.geekgeneration.fr%2Fwp-content%2Fuploads%2F2020%2F09%2FDUNE-1068x601.jpg&q=0&b=1&p=0&a=0'
            ],
        ]; */

        // On va chercher la liste des films en BASE
        $movies = $this->repository->findAll();

        // Préparation d'un renvoi d'une vue LISTE
        if ($format == 'json')
        {
            $output = $this->json($movies);
        }else{
            $output = $this->render(
                'movie/list.html.twig',
                [
                    'movies' => $movies
                ]
            );
        }

        // On pourrait faire un renvoi en json
        return $output;
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
        // Cherche la fiche du film
        $movie = $this->repository->find($idMovie);

        return $this->json($movie);
        
        //return new Response("Fiche demandée " . $idMovie);
    }

    /**
     * @Route(
     *      "/add",
     *      name="Add",
     *      methods={"GET"}
     * )
     */
    public function addMovie() : Response
    {
        // Appel au formulaire MovieType
        $formulaireAjoutFilm = $this->createForm(
            MovieType::class
        );

        dd($formulaireAjoutFilm);

    }
}
