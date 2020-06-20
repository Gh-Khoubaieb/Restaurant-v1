<?php

namespace App\Controller;

use App\Repository\MealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Meal;
use Symfony\Component\Routing\Annotation\Route;

class MealController  extends  AbstractController
{

    /**
     * @var MealRepository
     */
    private $repository;

    public function __construct(MealRepository $repository)
    {
        $this->repository = $repository;
    }

    public function  index () :Response
    {
        $meals = $this->repository->findAll();
        return new Response($this->renderView('meal/meal.html.twig',[
            'current_meal' => 'meals',
            'meals' => $meals

        ]));
    }

}