<?php

namespace Piorun\HomeSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeSiteController extends Controller
{
    public function indexAction()
    {
        return $this->render('PiorunHomeSiteBundle:HomeSite:index.html.twig', array());
    }
}
