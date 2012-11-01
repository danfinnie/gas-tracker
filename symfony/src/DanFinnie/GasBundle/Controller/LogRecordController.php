<?php

namespace DanFinnie\GasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DanFinnie\GasBundle\Entity\LogRecord;
use Symfony\Component\HttpFoundation\Request;

class LogRecordController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('DanFinnieGasBundle:LogRecord');
        $records = $repository->findAll();
        $recordsArr = array_map(function($o) {
          return array(
             "id" => $o->getId(),
             "mileage" => $o->getMileage(),
             "gallonsAdded" => $o->getGallonsAdded()
          );
        }, $records);

        return $this->render('DanFinnieGasBundle:LogRecord:index.html.twig', array('log_records' => $recordsArr));
    }

    public function addAction(Request $req)
    {
        $logRecord = new LogRecord();
        $logRecord->setMileage($this->getExpectedMileage());
        $logRecord->setGallonsAdded($this->getExpectedGallonsAdded());

        $form = $this->createFormBuilder($logRecord)
            ->add('mileage', 'text')
            ->add('gallonsAdded', 'text')
            ->getForm();

        if ($req->isMethod('POST')) {
            $form->bind($req);

            if ($form->isValid()) {
               $manager = $this->getDoctrine()->getManager();
               $manager->persist($form->getData());
               $manager->flush();

               return $this->redirect($this->generateUrl('dan_finnie_gas_homepage'));
            }
        } else {
           return $this->render('DanFinnieGasBundle:LogRecord:add.html.twig', array('form' => $form->createView()));
        }
    }

    private function getExpectedMileage()
    {
        // TODO: Return expected next value based on max mileage and average mileage between fillups.
        return 100000;
    }

    private function getExpectedGallonsAdded()
    {
        // TODO: Return expected gallons added.
        return 10;
    }
}
