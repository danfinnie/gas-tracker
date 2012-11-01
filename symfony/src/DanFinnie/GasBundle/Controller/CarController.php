<?php

namespace DanFinnie\GasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CarController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('DanFinnieGasBundle:Car');
        $cars = $repository->findAll();
        $carsArr = array_map(function($o) {
          return array(
             "id" => $o->getId(),
             "name" => $o->getName(),
          );
        }, $cars);

        return $this->render('DanFinnieGasBundle:Car:index.html.twig', array('cars' => $carsArr));
    }

    public function detailsAction($id)
    {
        echo($id);
    }

}
