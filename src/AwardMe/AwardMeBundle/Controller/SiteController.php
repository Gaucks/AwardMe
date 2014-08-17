<?php

namespace AwardMe\AwardMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SiteController extends Controller
{
    public function welcomeAction()
    {
        return $this->render('AwardMeBundle:Welcome:welcome.html.twig');
    }

    public function indexAction()
    {
        $publications = $this->getDoctrine()->getManager()->getRepository('AwardMeBundle:Publication')->findBy(
                                                                                array('user' => $this->getUser()), array('date' => 'DESC'));

        $publicationsImages = $this->getDoctrine()->getManager()->getRepository('AwardMeBundle:PublicationImage')->findBy( array('user' => $this->getUser()), array('date' => 'DESC'));

        return $this->render('AwardMeBundle:Accueil:accueil.html.twig', array('publications' => $publications, 'publicationsimages' => $publicationsImages ));
    }

    public function headerAction()
    {
        return $this->render('AwardMeBundle:Template:header.html.twig');
    }

    public function underheaderAction()
    {
        return $this->render('AwardMeBundle:Template:underheader.html.twig');
    }

    public function menuAction()
    {
        return $this->render('AwardMeBundle:Template:menu.html.twig');
    }

}
