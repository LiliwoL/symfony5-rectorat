<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Movie;
use App\Repository\ArtistRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Le builder attend qu'on lui ajoute les champs à afficher dans le formulaire

        // Les champs disponibles de base sont disponibles ici:
        // https://symfony.com/doc/current/reference/forms/types.html
        $builder
            // Le champ titre peut être configuré en TextField
            ->add(
                'title',
                TextType::class,
                [
                    'label' => 'Titre du film',
                    'attr'  => [
                        'placeholder'   => 'Les Goonies, Evita...',
                        'class'         => 'form-control'
                    ],
                    'constraints' => [
                        new NotBlank(),
                        new Length(
                            [
                                'min' => 2,
                                'minMessage' => 'Le titre doit faire plus de 2 caractères!'
                            ]
                        )
                    ]
                ]
            )
            ->add(
                'poster',
                UrlType::class,
                [
                    'label' => 'URL de l\'affiche du film',
                    'attr' => [
                        'placeholder' => 'http://...',
                        'class' => 'form-control'
                    ],                    
                ]

            )
            ->add(
                'year',
                IntegerType::class,
                [
                    'label' => 'Année de sortie',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'synopsis',
                TextareaType::class,
                [
                    'label' => 'Synopsis',
                    'attr' => [
                        'placeholder' => 'Il était une fois...',
                        'class' => 'form-control'
                    ],
                    'required' => false
                ]
            )
            // Champs entité lié
            ->add(
                'id_director',
                EntityType::class,
                [
                    'label' => 'Réalisateur.rice',
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    //'class' => Artist::class,
                    'class' => "App\Entity\Artist",

                    // Champ de la classe liée qui va être affiché
                    //'choice_label' => 'name',
                    // On peut définir une fonction anonyme pour l'affichage
                    'choice_label' => function ($artist){
                        // Utilisation de __toString()
                        return $artist;
                    },
                    // Lien vers la doc https://symfony.com/doc/current/reference/forms/types/entity.html#query-builder                    
                    /*'query_builder' => function (ArtistRepository $artistRepository){
                        return $artistRepository->findArtistBornAfter1980();
                    }*/
                    // Query Builder pour ordonner
                    'query_builder' => function (ArtistRepository $artistRepository) {
                        return $artistRepository->createQueryBuilder('a')
                            ->orderBy('a.name', 'ASC');
                    },
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Ajouter / Modifier',
                    'attr' => [
                        'class' => 'btn btn-primary'
                    ]
                ],
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
