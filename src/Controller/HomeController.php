<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Mail;
use App\Form\MailType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $mail = new Mail();
        $form = $this->createForm(MailType::class, $mail);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mail = $form->getData();
            $mail->setDate(new \DateTime());
            $message = (new \Swift_Message("Site WEB (" . $mail->getEmailFrom() . ") : " . $mail->getObject()))
                ->setFrom("timotheduc@gmail.com")
                ->setTo('timotheduc@gmail.com')
                ->setBody($mail->getContent(),
                    'text/plain'
                )
            ;
            $mailer->send($message);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mail);
            $entityManager->flush();
            return $this->redirectToRoute('home', ['_fragment' => 'meContacter']);

        }

        return $this->render('home/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
