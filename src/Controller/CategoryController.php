<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_index")
     */
    public function index() :Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/add", name="category_add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request) :Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category
        );

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}