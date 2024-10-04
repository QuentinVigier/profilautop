<?php

namespace App\Form;

use App\Entity\JobOffer;
use App\Entity\LinkedInMessage;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewLinkedInMessageType extends AbstractType
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
                'label' => 'Key Skills you have linked to the offer',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Create LinkedIn Message',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LinkedInMessage::class,
        ]);
    }
}
