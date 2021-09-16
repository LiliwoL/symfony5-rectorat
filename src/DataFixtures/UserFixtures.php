<?php

namespace App\DataFixtures;

use App\Entity\User;
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
    private $_encode;

    // Le constructeur prend l'interface donnantt accès au hashage utilisé pour le smots de passe
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->_encode = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("user");

        // Encodage du mot de passe
        $password = $this->_encode->hashPassword($user, 'user');
        $user->setPassword($password);

        // Roles
        $user->setRoles(
            ['ROLE_USER']
        );

        $manager->persist($user);

        // ***************************

        $admin = new User();
        $admin->setUsername("admin");

        // Encodage du mot de passe
        $password = $this->_encode->hashPassword($admin, 'admin');
        $admin->setPassword($password);

        // Roles
        $admin->setRoles(
            ['ROLE_ADMIN']
        );

        $manager->persist($admin);


        $manager->flush();
    }
}
