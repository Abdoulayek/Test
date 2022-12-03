<?php

namespace App\Form;

use App\Entity\Clientscall;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientscallType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civ')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('codePostal')
            ->add('telephone')
            ->add('modele')
            ->add('idContact')
            ->add('echeanceProjet')
            ->add('statut')
            ->add('codeConcession')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clientscall::class,
        ]);
    }
}
