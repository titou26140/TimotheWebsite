<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        // Nous récupérons le nom d'hôte depuis l'URL
        $hostname = $request->getSchemeAndHttpHost();

        // On initialise un tableau pour lister les URLs
        $urls = [];

        // On ajoute les URLs "statiques"
        $urls[] = ['loc' => $this->generateUrl('home')];

        // On ajoute les URLs dynamiques des articles dans le tableau
        /*foreach ($this->getDoctrine()->getRepository(Articles::class)->findAll() as $article) {
            $images = [
                'loc' => '/uploads/images/featured/'.$article->getFeaturedImage(), // URL to image
                'title' => $article->getTitre()    // Optional, text describing the image
            ];

            $urls[] = [
                'loc' => $this->generateUrl('article', [
                    'slug' => $article->getSlug(),
                ]),
                'lastmod' => $article->getUpdatedAt()->format('Y-m-d'),
                'image' => $images
            ];
        }*/

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', ['urls' => $urls,
                'hostname' => $hostname]),
            200
        );

        // Ajout des entêtes
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
