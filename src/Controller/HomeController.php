<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Mail;
use App\Form\MailType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $mail = new Mail();
        $form = $this->createForm(MailType::class, $mail);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $mailData = $form->getData();
            dump($mailData);
            exit;
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
            return $this->redirectToRoute('home', ['_fragment' => 'meContacter']);

        }

        return $this->render('home/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
