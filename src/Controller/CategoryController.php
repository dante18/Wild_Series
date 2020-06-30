<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @IsGranted("ROLE_ADMIN")
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

    /**
     * @param CategoryRepository $categoryRepository
     * @param ProgramRepository $programRepository
     * @return Response
     */
    public function categoryList(CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        return $this->render('category/_list.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }
}
