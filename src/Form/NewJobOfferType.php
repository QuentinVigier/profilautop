<?php

namespace App\Form;

use App\Entity\JobOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewJobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-1'],
                'label' => 'Choose a title',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                'help' => 'This is the title of your Job Offer',
                'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('company', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-1'],
                'label' => "Choose a company's name",
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                'help' => 'This is the name of the Company of your Job Offer',
                'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('link', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-1'],
                'label' => 'Enter the link of the Job Offer',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                'help' => 'This is the link to access the Job Offer',
                'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('location', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-1'],
                'label' => 'Choose a location',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                'help' => 'This is the location of your Job Offer',
                'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('salary', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-1'],
                'label' => 'Enter the salary',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                'help' => 'This is the salary of your Job Offer',
                'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('contactPerson', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-1'],
                'label' => 'Enter the name of the contact person',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                'help' => 'This is the contact person of your Job Offer',
                'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('contactEmail', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-1'],
                'label' => 'Enter an email address',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                'help' => 'This is the email adress of the contact person of your Job Offer',
                'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('applicationDate', null, [
                'widget' => 'single_text',
                'row_attr' => ['class' => 'flex flex-col gap-1'],
                'label' => 'Enter the date of application',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                'help' => 'This is the date of application for your Job Offer',
                'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'À postuler' => 'À postuler',
                    'En attente' => 'En attente',
                    'Entretien' => 'Entretien',
                    'Refusé' => 'Refusé',
                    'Accepté' => 'Accepté'
                ],
                'placeholder' => 'Choisissez un statut',
                'required' => true,
                'row_attr' => ['class' => 'flex flex-col gap-1'],
                'label' => 'Choose a status',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                'help' => 'This is the status of your Job Offer',
                'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Create Job Offer',
                'attr' => [
                    'class' => 'bg-violet-600 text-white px-4 py-2 rounded-full hover:bg-violet-700',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
