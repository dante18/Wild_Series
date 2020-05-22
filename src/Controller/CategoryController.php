<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_index")
     */
    public function index() :Response
    {
        return $this->render('category/index.html.twig');
    }

    /**
     * @Route("/category/add", name="category_add")
     */
    public function add() :Response
    {
        return $this->render('category/add.html.twig');
    }
}