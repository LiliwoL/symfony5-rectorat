<?php

namespace App\Security\Voter;

use App\Entity\Movie;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class MovieVoter extends Voter
{
    private $_security;

    public function __construct(Security $security)
    {
        $this->_security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // Dans quels cas ce Voter va s'appliquer

        // Le Voter s'appliquera uniquement dans le cadre ou le $subject est une instance de Movie
        //dd($subject);
        //dd($attribute);

        if (!$subject instanceof Movie) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {      
        // On sait que dans ce cas le sujet correspond à une entité Movie
        $movie = $subject;

        // Ne sera autorisé que le film ayant l'id 24
        if ($movie->getId() == 24)
        {
            return true;
        }else{
            // Autoriser tout de même les ROLE_ADMIN
            if ( $this->_security->isGranted('ROLE_ADMIN') ){
                return true;
            }
        }



        return false;
    }
}
