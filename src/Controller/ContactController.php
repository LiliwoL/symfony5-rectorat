<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    /**
     * @Route(
     *  "/", 
     *  name="home"
     * )
     */
    public function home() : Response
    {
        // Renvoi d'une réponse présentant un fichier twig
        return $this->render(
            'contact/index.html.twig',
            [
            ]
        );
    }

    /**
     * @Route(
     *  "/contact", 
     *  name="contact"
     * )
     */
    public function contact(NotifierInterface $notifier): Response
    {

        /*
            Notification pour prévenir d'une nouvelle commande
        */
            // Création d'une notification avec un sujet et un canal            
            $notification = new Notification('Nouvelle notification', ['email']);
            // Le tableau de canal définit comment la notification va être distribuée
            // ['email', 'sms']  enverrait à a fois par mail ET par SMS

            // Ajout du contenu à la notification
            $notification->content('Une nouvelle notification vous a été adressée');

            // On peut aussi ajouter des emojis
            $notification->emoji('�');

            /*
            Destinataire de la notification
            */
            // Création du destinataire
            $recipient = new Recipient(
                'destinataire@test.fr',
                '0633111111'
            );

            /*
		Envoi de la notification
	*/
		$notifier->send($notification, $recipient);

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
     *     "/translate/{_locale}",
     *     name="translate",
     *     requirements={
     *         "_locale": "en|fr|de",
     *     }
     * )
     */
    public function translate(TranslatorInterface $translator, Request $request, string $_locale = 'fr')
    {
        // Traduction à partir de la locale
        //$translator->trans('Hello, this message need to be translated');

        // Affichage de la locale depuis la requête
        //dd($request->getLocale());

        return $this->render(
            'contact/translate.html.twig'
        );
    }
}