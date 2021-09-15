<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route(
     *  "/contact", 
     *  name="contact"
     * )
     */
    public function index(): Response
    {
        // Renvoi d'une réponse présentant un fichier twig
        return $this->render(
            'contact/index.html.twig',
            [
                'controller_name' => 'ContactController',
            ]
        );
    }

    /**
     * @Route(
     *  "/test/{name}/{id}",
     *  name="test",
     * 
     *  requirements={
     *      "name"="\D+",
     *      "id"="\d"
     *  }
     * )
     */
    public function test(string $name = "defaut", int $id = 5): Response
    {
        return new Response("Coucou " . $name . " " . $id);
    }

    /**
     * @Route(
     *  "/test",
     *  name="test2",
     *  priority=2
     * )
     */
    public function test2(): Response
    {
        return new Response("Coucou2");
    }
}
