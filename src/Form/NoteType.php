<?php

namespace App\Form;

use App\Entity\Notes;
use App\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType


{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('matiere', EntityType::class, [
            'class' => Matiere::class,
            'choice_label' => function ($matiere) {
                return $matiere->getNom() . ' - coeff. ' . $matiere->getCoef();
            },
        ])
        ->add('note', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Notes::class,
        ]);
    }
}
