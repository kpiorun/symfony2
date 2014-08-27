<?php

namespace Piorun\HomeSiteBundle\Controller;

use Piorun\HomeSiteBundle\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class RegisterClientSiteController extends Controller {

    public function registerClientAction(Request $request) {


        $client = new Client();
        $form = $this->createFormBuilder($client)
                ->add('name', 'text')
                ->add('lastname', 'text')
                ->add('save', 'submit')
                ->getForm();




        /* Aby uzywac na kazdej stronie nalezy nadpisac klase controller */

        $session = new Session();
        $session->set('partnercode', $request->get('partnercode'));
        /*         * ************************************************************ */

        /* zapis do bazy danych */

        if ($request->isMethod('POST')) {
            /* Pobranie danych z formularza */
            $form->bind($request);
            $name = $form->get('name')->getData();
            $lastname = $form->get('lastname')->getData();
            $partnercode = $session->get('partnercode');
            if ($form->isValid()) {
                if ($partnercode) {
                    $this->getClientPartnersCodeAction($partnercode,$lastname,$name);
                }
                return $this->redirect($this->generateUrl('piorun_home_site_homepage'));
            }
        }





        return $this->render('PiorunHomeSiteBundle:RegisterSite:register.html.twig', array('form' => $form->createView()));
    }

    public function getClientPartnersCodeAction($partnercode,$lastname,$name) {

        $repository = $this->getDoctrine()
                ->getRepository('PiorunHomeSiteBundle:Partnercode');

        $query = $repository->createQueryBuilder('p')
                ->where('p.partnercode = :partnercode AND p.active=1')
                ->setParameter('partnercode', $partnercode)
                ->getQuery();

        $partnercodes = $query->getResult();


        if ($partnercodes) {
            $this->saveClient($partnercodes[0]->getId(),$lastname,$name);
        } else {
            throw $this->createNotFoundException(
                    'Brak kodu klienta o podanym id ' . $partnercode
            );
        }

        return $partnercodes;
    }

    protected function saveClient($partnercode,$lastname,$name) {

        $client = new Client();
        $client->setName($name);
        $client->setLastname($lastname);
        $client->setPartnercodeid($partnercode);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($client);
        $em->flush();
    }

}
