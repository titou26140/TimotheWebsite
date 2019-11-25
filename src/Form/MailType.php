<?php

namespace App\Form;

use App\Entity\Mail;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;


class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recaptcha', EWZRecaptchaType::class, array(
                'label' => false,
                'mapped' => false,
                'constraints' => array(
                    new RecaptchaTrue()
                )
            ))
            ->add('emailFrom', null, ['label' => 'Votre adresse e-mail (pour que je puisse vous répondre)', 'attr' => [
                'placeholder' => 'test@test.com'
            ]])
            ->add('object', null, ['label' => 'Objet du message', 'attr' => [
                'placeholder' => 'Demande de devis ...'
            ]])
            ->add('content', null, ['label' => 'Mon message', 'attr' => [
                'placeholder' => 'Votre message ...'
            ]]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mail::class,
        ]);
    }
}
