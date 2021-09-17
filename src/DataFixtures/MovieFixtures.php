<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Nouvelle instance de l'entité Movie
        /*$movie = new Movie();

        // On ajoute des données
        $movie->setTitle("Twelve Monkeys");
        $movie->setReleased(date_create("1995-12-29"));
        $movie->setSynopsis("A deadly virus released in 1996 wipes out almost all of humanity, forcing survivors to live underground. A group known as the Army of the Twelve Monkeys is believed to have released the virus. In 2035, James Cole is a prisoner living in a subterranean compound beneath the ruins of Philadelphia. Cole is selected to be trained and sent back in time to find the original virus in order to help scientists develop a cure. Meanwhile, Cole is troubled by recurring dreams involving a foot chase and shooting at an airport.");
        $movie->setCountry("USA");
        $movie->setGenre("SF");
        $movie->setPoster("https://artworks.thetvdb.com/banners/movies/706/posters/706.jpg");
        $manager->persist($movie);
        

        $movie = new Movie();
        $movie->setTitle("Maniac Cop");
        $movie->setReleased(date_create("1988-05-13"));
        $movie->setSynopsis("In New York City, a waitress named Cassie Philips is on her way home when she is assaulted by two muggers and seeks aid from a police officer, who kills her by breaking her neck. Over the next two nights, the hence-forth dubbed \"Maniac Cop\" kills a man named Sam and an unnamed musician. This prompts Lieutenant Frank McCrae (Tom Atkins (actor)), who was told by his superiors to suppress eyewitness accounts that the killer was wearing a police uniform, to pass on information to a journalist, in an attempt to protect civilians. Unfortunately, this causes panic and dissent among the city and results in innocent patrolmen being shot to death or avoided on the streets by paranoid people.");
        $movie->setCountry("USA");
        $movie->setGenre("Horror");
        $movie->setPoster("https://artworks.thetvdb.com/banners/movies/9472/posters/9472.jpg");
        $manager->persist($movie);


        $movie = new Movie();
        $movie->setTitle("Star Wars: Episode I - The Phantom Menace");
        $movie->setReleased(date_create("1999-06-03"));
        $movie->setSynopsis("With the galactic federation weakened, two promising Jedi Knights journey to find and protect a young queen from a mysterious creature who wants to destroy her.");
        $movie->setCountry("USA");
        $movie->setGenre("SF");
        $movie->setPoster("https://artworks.thetvdb.com/banners/movies/334/posters/334.jpg");
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle("Yesterday");
        $movie->setReleased(date_create("2019-06-28"));
        $movie->setSynopsis("During a worldwide blackout, a struggling musician named Jack Malik is hit by a bus and awakens to find the world knows no trace of the super-band the Beatles. Knowing their music by heart, Jack achieve instant success by following in their footsteps.");
        $movie->setCountry("GB");
        $movie->setGenre("Comedy");
        $movie->setPoster("https://artworks.thetvdb.com/banners/movies/13306/posters/13306.jpg");
        $manager->persist($movie);


        $manager->flush();*/
    }
}