<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('categorie', ChoiceType::class, [
            'choices' => [
                'Médecine générale' => 'Médecine générale',
                'Médecine dentaire' => 'Médecine dentaire',
                'Pédiatrie' => 'Pédiatrie',
                'Médecine interne' => 'Médecine interne',
                'Je ne sais pas' => 'Je ne sais pas',

            ],
            'data_class' => null,

        ])
        ->add('hide_name', CheckboxType::class, [
            'label' => 'Hide Name',
            'required' => false,
            'attr' => [
                'data-toggle' => 'toggle', // optional: if you want to use Bootstrap Toggle
            ],
        ])
            ->add('id_user')
            ->add('question')
            ->add('image', FileType::class, ['label' => 'pieces joints']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
