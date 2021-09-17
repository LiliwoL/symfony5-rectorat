<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Movie;
use App\Event\MovieCreatedEvent;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Ici on déclare un "préfixe" de route
 * @Route(
 *      "/movie",
 *      name="movie_"
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
     * Affichage de la liste des films
     * 
     * -> injection de la dépendance MovieRepository
     * 
     * @Route(
     *      "/list/{format?}",
     *      name="list"
     * )
     */
    public function list(?string $format) : Response
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
        if ($format === 'json')
        {

            // Json demandé
            $output = $this->json(
                $movies,
                200,
                [],
                [AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object){return $object->getId();}]
            );

        }else{

            // Renvoi en HTML
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
     *      "/{idMovie}/{format?}",
     *      name="show",
     *      requirements={"idMovie"="\d+"}
     * )
     */
    public function showMovie(?string $format, int $idMovie, SerializerInterface $serializerInterface) : Response
    {
        
        // Cherche la fiche du film
        $movie = $this->repository->find($idMovie);


        // Préparation d'un renvoi d'une vue LISTE
        if ($format === 'json')
        {

             // Si on laisse ceci, on a un souci de référence circulaire
            //return $this->json($movie);

            // Il faut alors gérer un contexte de sérialisation
            $output = $this->json($movie,200,[],['circular_reference_handler' => function ($object) {
                return $object->getId();
            }]);

        }else{

            // Renvoi en HTML
            $output = $this->render(
                'movie/show.html.twig',
                [
                    'movie' => $movie
                ]
            );

        }

       return $output;
    }

    /**
     * @Route(
     *      "/add",
     *      name="add",
     *      methods={"GET"}
     * )
     */
    public function addMovie() : Response
    {
        // Appel au formulaire MovieType
        $formulaireAjoutFilm = $this->createForm(
            MovieType::class
        );

        return $this->render(
            'movie/add.html.twig',
            [
                'formulaireAjoutFilm' => $formulaireAjoutFilm->createView()
            ]
        );
    }

    /**
     * On aurait pu tout faire dans la même action de controller
     * 
     * @Route(
     *      "/add",
     *      name="addPOST",
     *      methods={"POST"}
     * )
     */
    public function addMoviePOST(Request $request, EntityManagerInterface $em, EventDispatcherInterface $dispatcher) : Response
    {
        // Instance vide de MOVIE
        $movie = new Movie();

        // Appel au formulaire MovieType
        $formulaireAjoutFilm = $this->createForm(
            MovieType::class,
            $movie
        );

        $em = $this->getDoctrine()->getManager();

        // On demande au formulaire de gérer la requête HTTP en cours
        $formulaireAjoutFilm->handleRequest($request);

        // Le formulaire a t'il été soumis et est il valide?
        if ( $formulaireAjoutFilm->isSubmitted() && $formulaireAjoutFilm->isValid())
        {
            // Le formulaire est OK, on s'occupe des données
            $movie = $formulaireAjoutFilm->getData();

            // ********* Ecriture en base

                // On a une instance de Movie, on peut la mettre en base de données
                // dd($movie);
                // Cette instance n'a pas encore d'id!

                // Appel de l'entity manager pour une persistance en base
                $em->persist($movie);

                // On aurait pu avoir plusieurs choses à mettre en base
                $em->flush();
            

            // ********* Confirmation
                // Ajout d'un message de confirmation
                $this->addFlash(
                    'success',
                    'La fiche du film ' . $movie->getTitle() . " a bien été ajoutée!"
                );

            // ******* Dispatch de l'événement
                // Création de notre événement personnalisé 
                // en lui affectant le $movie qui vient d'être créé
                $eventMovieCreated = new MovieCreatedEvent($movie);

                // Dispatch de l'événement
                $dispatcher->dispatch($eventMovieCreated, MovieCreatedEvent::NAME);



            // ********* Redirection
                // Inséré en base, donc on a l'id
                return $this->redirectToRoute(
                    "movie_show",
                    [
                        'idMovie' => $movie->getId()
                    ]
                );
        }else{

            dd($formulaireAjoutFilm->isValid());

            // ********* Confirmation
            // Le formulaire n'est pas soumis ou pas valide
            // Ajout d'un message de confirmation
            $this->addFlash(
                'error',
                'Il y a eu un souci'
            );

            // ********* Redirection
            return $this->redirectToRoute(
                "movie_add"
            );

        }
    }

    /**
     * @Route(
     *      "/delete/{id}",
     *      name="delete",
     *      methods={ "POST" }
     * )
     */
    public function deleteMovie(Movie $movie, EntityManagerInterface $em, Request $request) : Response
    {   
        // La conversion de paramètre a automatiquement chargé l'instance Movie

        // On  peut la tester
        if ($movie)
        {
             // Vérification du CSRF
            if ($this->isCsrfTokenValid('delete'. $movie->getId(), $request->request->get('_token')))
            {

                // Suppression
                $em->remove($movie);
                $em->flush();

                // ************* Confirmation
                    // Ajout d'un message de confirmation
                    $this->addFlash(
                        'success',
                        'Le film a bien été supprimé'
                    );
            }else{
                // ************* Confirmation
                // Ajout d'un message de confirmation
                $this->addFlash(
                    'error',
                    'Erreur de CSRF'
                ); 
            }
            

        
        }else{
            // Pas de Movie, donc erreur
             // ************* Confirmation
                // Ajout d'un message de confirmation
                $this->addFlash(
                    'error',
                    'Erreur de suppression'
                );            
        }

        return $this->redirectToRoute('movie_list');
    }


    /**
     * @Route(
     *      "/edit/{id}",
     *      name="edit",
     *      methods={"GET", "POST"}
     * )
     * 
     * Utilisation du ParamConverter
     * **ParamConverter("Artist", options={"id" = "id"})**
     */    
    public function editMovie(Movie $movie, Request $request, EntityManagerInterface $em): Response
    {
        // Création du formulaire de Movie
        $formulaire = $this->createForm(
            MovieType::class,
            $movie
        );

        // Ce formulaire gère la requête en cours
        $formulaire->handleRequest($request);

        // Test du formulaire (test de la soumission avant la validation)
        if ( $formulaire->isSubmitted() && $formulaire->isValid() )
        {
            // Update en base
            //$em->persist($movie); 
            // Persits non obligatoire dans le cadre d'un update

            $em->flush();

            // ************* Confirmation
                // Ajout d'un message de confirmation
                $this->addFlash(
                    'success',
                    'Le film ' . $movie->getTitle() . ' a bien été mis à jour'
                );

            return $this->redirectToRoute('movie_list');
        }

        //Affichage du formulaire avec les données du Movie en cours
        return $this->render(
            'movie/edit.html.twig',
            [
                'formulaire' => $formulaire->createView()
            ]
        );
    }

    /**
     * @Route(
     *      "/search", 
     *      methods="GET",
     *      name="search"
     * )
     */
    public function search(Request $request): Response
    {
        $query = $request->query->get('q', '');

        $movies = $this->repository->findBySearchQuery($query, 100);

        // Renvoi en HTML
        return $this->render(
            'movie/list.html.twig',
            [
                'movies' => $movies,
                'query' => $query
            ]
        );
    }
}
