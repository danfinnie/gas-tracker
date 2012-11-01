<?php

namespace DanFinnie\GasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DanFinnieGasBundle:Default:index.html.twig', array('name' => $name));
    }
}
