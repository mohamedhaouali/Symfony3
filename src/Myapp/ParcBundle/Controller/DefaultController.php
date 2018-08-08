<?php

namespace Myapp\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParcBundle:Default:index.html.twig');
    }
}
