<?php

namespace App\Form;

use App\Entity\CoverLetter;
use App\Entity\JobOffer;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewCoverLetterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jobOffer', EntityType::class, [
                'class' => JobOffer::class,
                'choice_label' => 'title',
            ])
            ->add('description', TextareaType::class, [
                'mapped' => false,
                'label' => 'Description of the offer',
            ])
            ->add('key-skills', TextareaType::class, [
                'mapped' => false,
                'label' => 'Key Skills you want to be highlighted in the cover letter',
            ])
            ->add('experiences', TextareaType::class, [
                'mapped' => false,
                'label' => 'Experiences related to the offer that you want to be talked in the cover letter',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Create Cover Letter',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CoverLetter::class,
        ]);
    }
}
