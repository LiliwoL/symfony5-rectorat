<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use App\Entity\User;
use App\Service\GeneratePassword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * 
 * Cette classe va nous permettre d'ajouter en base des utilsiateurs lambdas
 * 
 */
class UserFixtures extends Fixture
{
    // L'encodeur en attribut
    private $_encoder;

    // Le constructeur prend l'interface donnantt accès au hashage utilisé pour le smots de passe
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->_encoder = $encoder;
    }

    /**
     * Au chargement de cette fixture, on va créer 2 utilisateurs de base user et admin
     */
    public function load(ObjectManager $manager)
    {
       //Nouvel instance d'utilisateur
        $user = new User();

        // Utilisateur Simple
        $user->setUsername('user');
        
        // Il faut hasher les mots de passe
        $password = $this->_encoder->hashPassword( $user, 'user');
        $user->setPassword($password);

        // Roles
        $user->setRoles(
            ['ROLE_USER']
        );

        // Persister ce user en base
        $manager->persist($user);


        // **************************************
        
        $admin = new User();
        $admin->setUsername("admin");

        // Encodage du mot de passe
        $password = $this->_encoder->hashPassword($admin, 'admin');
        $admin->setPassword($password);

        // Roles
        $admin->setRoles(
            ['ROLE_ADMIN']
        );

        $manager->persist($admin);


        // Envoi de toutes les modifs à la base
        $manager->flush();
    }

    /**
     * Il est possible de placer cette fixture au sein d'un groupe de Fixtures
     */
    public static function getGroups(): array
    {
        return ['users'];
    }
}
