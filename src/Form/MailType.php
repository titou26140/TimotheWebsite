<?php

namespace App\Form;

use App\Entity\Mail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emailFrom', null, ['label' => 'Votre adresse e-mail (pour que je puisse vous répondre)', 'attr' => [
                'placeholder' => 'test@test.com'
            ]])
            ->add('object', null, ['label' => 'Objet du message', 'attr' => [
                'placeholder' => 'Demande de devis ...'
            ]])
            ->add('content', null, ['label' => 'Mon message', 'attr' => [
                'placeholder' => 'Votre message ...'
            ]])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mail::class,
        ]);
    }
}
