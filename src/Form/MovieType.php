<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                    'required' => true
                ]
            )
            ->add('poster')
            ->add('year')
            ->add('synopsis')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
