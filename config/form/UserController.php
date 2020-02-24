<?php

// namespace Form;
// require "config/View.php";
// require "config/Route.php";
// use Controllers\Users;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
// use Symfony\Component\Form\Extension\Core\Type\SubmitType;

// class UserController extends AbstractController{
//     public function new(Request $request)
//     {
//         // creates a task and gives it some dummy data for this example
//         $user = new Users();
//         $user->setTask('Write a blog post');
//         $user->setDueDate(new \DateTime('tomorrow'));

//         $form = $this->createFormBuilder($user)
//             ->add('task', TextType::class)
//             ->add('dueDate', DateType::class)
//             ->add('save', SubmitType::class, ['label' => 'Create Task'])
//             ->getForm();

//         return View::render('task/welcome.html', [
//             'form' => $form->createView(),
//         ]);
//     }
// }