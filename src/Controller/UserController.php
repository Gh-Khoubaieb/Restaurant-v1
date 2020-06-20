<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Meal;
use App\Entity\Order;
use App\Entity\User;
use App\Form\BookingType;
use App\Form\MealType;
use App\Form\UserType;
use App\Repository\MealRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends  AbstractController
{

    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(UserRepository $repository,EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/user",name="user")
     *
     */
    public function index()
    {
        $user = $this->repository->findAll();
        return $this->render('user/login/login.html.twig',['users' => $user]);
    }

    /**
     * @Route("/new",name="new.user")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public  function  create(Request $request, UserPasswordEncoderInterface $encoder )
{

    $user = new User();
    $form = $this->createForm(UserType::class,$user);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
        $this->addFlash('success',
            'votre compte a été créer avec succés'
        );

        $password =$user->getPassword();
        $hash = $encoder->encodePassword($user,$password);
        $user->setPassword($hash);
        $this->em->persist($user);
        $this->em->flush();
        return $this->redirectToRoute('index');
    }
    return $this->render('user/new.html.twig',[
        'form' => $form->createView(),
        'user' => $user
    ]);



}

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/user/booking",name="booking")
     */
    public function booking(Request $request)
    {
        $book = new Booking();
        $user = new User();
        $user_id = $user->getId();
        $form = $this->createForm(BookingType::class,$book);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $this->addFlash('booking' , 'Votre réservation a été crée avec succés ');
                $book->setUserId(26);
                $this->em->persist($book);
                $this->em->flush();
                return  $this->redirectToRoute('index');
            }
        return $this->render('user/booking/booking.html.twig',[

            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("user/admin",name ="admin")
     * @param Order $orders
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function admin(OrderRepository $repository )
    {

        $orders = $repository->findAll();

        return $this->render('user/meal/meal.html.twig',[

            'orders' => $orders
        ]);
    }

    /**
     *
     * @Route("user/admin/meal",name="addMeal")
     */
    public function add(Request $request)
    {
        $meal = new Meal();

        $form =  $this->createForm(MealType::class,$meal);
        $form->handleRequest($request);
        return $this->render('user/meal/add.html.twig',[
            'form' => $form->createView()
            ]
        );
    }

    /**
     *
     * @Route("order",name="order")
     * @param MealRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function order(MealRepository $repository)
    {
        $order = $repository->findAll();
    
        return $this->render('order/order.html.twig',[
            'orders'=> $order
        ]);
    }
}


