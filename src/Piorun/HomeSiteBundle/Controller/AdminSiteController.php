<?php

namespace Piorun\HomeSiteBundle\Controller;

use Piorun\HomeSiteBundle\Entity\Partnercode;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdminSiteController extends Controller {

    public function indexAction(Request $request) {
	
	

        $partnercode = new Partnercode();
        $form = $this->createFormBuilder($partnercode)
                ->add('name', 'text')
                ->add('partnercode', 'text')
                ->add('active', 'text')
                ->add('save', 'submit')
                ->getForm();

        if ($request->isMethod('POST')) {
            /* Pobranie danych z formularza */
            $form->bind($request);
            $name = $form->get('name')->getData();
            $partnercodes = $form->get('partnercode')->getData();
            $active = $form->get('active')->getData();
            
            $this->saveData($name,$partnercodes,$active,$partnercode);
         

            if ($form->isValid()) {

                // perform some action, such as saving the task to the database

                return $this->redirect($this->generateUrl('piorun_home_site_homepage'));
            }
        }

        return $this->render('PiorunHomeSiteBundle:AdminSite:adminsite.html.twig', array('form' => $form->createView()));
    }

    private function saveData($name,$partnercodes,$active,$partnercode){
        
            $partnercode->setName($name);
            $partnercode->setPartnercode($partnercodes);
            $partnercode->setActive($active);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($partnercode);
            $em->flush();

        
    }
    
}
