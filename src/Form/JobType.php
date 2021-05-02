<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Techno;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('company')
            ->add('contract', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
            ->add('description')
            ->add('experience')
            ->add('salary')
            ->add('technos',
                EntityType::class,
                [
                    'class' => Techno::class,
                    'multiple' => true,
                    'choice_label' => 'name'
                ]
            )
            ->add('city')
            ->add('address')
            ->add('postal_code')
            ->add('is_remote_only')
            ->add('is_available');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
        return array_flip(Job::CONTRACT);
    }
}
