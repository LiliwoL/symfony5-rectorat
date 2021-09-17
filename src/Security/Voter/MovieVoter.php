<?php

namespace App\Security\Voter;

use App\Entity\Movie;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class MovieVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    protected function supports(string $attribute, $subject): bool
    {
        // Dans quels cas ce Voter va s'appliquer
        
        // Le voter s'appliquera uniquement dans le cadre d'une instance de Movie
        if (!$subject instanceof Movie) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $movie = $subject;

        // On ne votera TRUE que si le Movie a l'id 24
        if ($movie->getId() == 24)
        {
            return true;
        }

        // ROLE_ADMIN peut voir
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        return false;
    }
}
