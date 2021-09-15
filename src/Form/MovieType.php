<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('poster')
            ->add('year')
            ->add('synopsis')
            ->add('idDirector',
                EntityType::class,
                [
                    // https://symfony.com/doc/current/reference/forms/types/entity.html

                    'label' => 'Artiste', 
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'class' => Artist::class,

                    'choice_label' => 'name',
                    //* On peut appeler une méthode d'affichage spécifique
                    /*
                    'choice_label' => function ($artist){
                        return $artist->__toString();
                    },*/

                    //'multiple' => true,

                    /* On ne veut afficher que certains acteurs */
                    //'query_builder' => https://symfony.com/doc/current/reference/forms/types/entity.html#ref-form-entity-query-builder
                    /*'query_builder' => function (ArtistRepository $artistRepository) {
                        return $artistRepository->findAllWithPhoto();
                    }*/
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
