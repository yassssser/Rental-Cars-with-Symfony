<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\reservation;
use AdminBundle\Form\reservationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $em = $this->getDoctrine()->getManager();

        $reservation = new reservation();
         $form = $this->createFormBuilder()
                    ->add('select', EntityType::class , array(
                            'class' => 'AdminBundle\Entity\Voiture',
                            'choice_label' => 'libelle',
                            'expanded' => false,
                            'multiple' => false))
                    ->add('Number', NumberType::class)
                    ->add('date', DateType::class, array(
                        'widget' => 'single_text',
                        'format' => 'yyyy-MM-dd',
                        'data' => new \DateTime()
                    ))
                    ->add('client' , TextType::class)
                    ->add('Search' , SubmitType::class)
                    ->getForm();
                    

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $data = $form->getData();

            $date =  $data['date'];
            $Number =  $data['Number'];
            $select =  $data['select'];
            $client =  $data['client'];

            $reservation->setDateDeb($date);
            $reservation->setNbJours($Number);
            $reservation->setVoiture($select);
            $reservation->setClient($client);

            $em->persist($reservation);
            $em->flush();

            $voitures = $em->getRepository('AdminBundle:Voiture')->findBy([] , [] , 4 ,null);
            return $this->render('default/index.html.twig', [
                'voitures' => $voitures,
                'form' => $form->createView()
            ]);
        }

        $voitures = $em->getRepository('AdminBundle:Voiture')->findBy([] , [] , 4 ,null);
        return $this->render('default/index.html.twig', [
            'voitures' => $voitures,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/", name="adminpage")
     */
    public function adminAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/admin.html.twig', []);
    }

    /**
     * @Route("/car/{id}", name="car_show")
     */
    public function show($id){

        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository('AdminBundle:Voiture')->find($id);
        return $this->render('default/show.html.twig', [
            'voiture' => $car,
        ]);
    }

    /**
     * @Route("/car", name="car")
     */
    public function car(){

        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository('AdminBundle:Voiture')->findAll();
        return $this->render('default/car.html.twig', [
            'voitures' => $car,
        ]);
    }
}
