<?php

namespace App\Controller;

use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WildController extends AbstractController
{
    /**
     * Show all rows from Program’s entity
     *
     * @Route("/wild", name="wild_index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        if (!$programs) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }

        return $this->render(
            'wild/index.html.twig',
            ['programs' => $programs]
        );
    }

    /**
     * @Route("/wild/show/{slug}",
     *     requirements={"slug"="[a-z0-9-]+"},
     *     name="wild_show")
     * @param string $slug
     * @return Response
     */
    public function show(string $slug = ''): Response
    {
        if (empty($slug)) {
            $serieTitle = "Aucune série sélectionnée, veuillez choisir une série";
        } else {
            $serieTitle = str_replace('-', ' ', $slug);
            $serieTitle = ucwords($serieTitle);
        }

        return $this->render('wild/show.html.twig', [
            'serieTitle' => $serieTitle
        ]);
    }
}
