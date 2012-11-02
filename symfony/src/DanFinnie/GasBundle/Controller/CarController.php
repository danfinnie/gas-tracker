<?php

namespace DanFinnie\GasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use DanFinnie\GasBundle\Entity\LogRecord;
use DanFinnie\GasBundle\Form\Type\LogRecordNoCarType;

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
        $carRepo = $this->getDoctrine()->getRepository('DanFinnieGasBundle:Car');
        $car = $carRepo->findOneByIdWithAnnotations($id);

        return $this->render('DanFinnieGasBundle:Car:details.html.twig', array(
            'car' => array(
                'name' => $car->getName(),
                'mpg' => $car->getMpg(),
                'mileage' => $car->getMileage(),
                'mpgColor' => $this->mpgColor($car->getMpg()),
            ),
        ));
    }

    public function addLogRecordAction(Request $req, $id)
    {
        $carRepo = $this->getDoctrine()->getRepository('DanFinnieGasBundle:Car');
        $car = $carRepo->findOneByIdWithAnnotations($id);

        $logRecord = new LogRecord();
        $logRecord->setCar($car);
        $logRecord->setMileage($car->getMileage());
        $logRecord->setGallonsAdded(10);

        $form = $this->createForm(new LogRecordNoCarType(), $logRecord);

        if ($req->isMethod('POST')) {
            $form->bind($req);

            if ($form->isValid()) {
               $manager = $this->getDoctrine()->getManager();
               $manager->persist($form->getData());
               $manager->flush();

               return $this->redirect($this->generateUrl('dan_finnie_car_details', array("id" => $car->getId())));
            }
        } else {
           return $this->render('DanFinnieGasBundle:LogRecord:add.html.twig', array('form' => $form->createView()));
        }
    }

    private function mpgColor($mpg)
    {
        if ($mpg > 32)
            return "green";
        elseif ($mpg > 20)
            return "yellow";
        return "red";
    }
}
