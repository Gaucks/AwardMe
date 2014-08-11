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
        $securityContext = $this->container->get('security.context'); // Le controleur de sécurité

        if(!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->render('AwardMeBundle:Welcome:welcome.html.twig');
        }

        $user = $securityContext->getToken()->getUser(); // L'utilisateur courant

        $publications = $this->getDoctrine()->getManager()->getRepository('AwardMeBundle:Publication')->findByUser($user);

        return $this->render('AwardMeBundle:Accueil:accueil.html.twig', array('publications' => $publications));
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
