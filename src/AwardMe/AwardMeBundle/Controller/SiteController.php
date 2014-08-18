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

        $allpublications = array_merge($publications, $publicationsImages);

        // Trie le tableau $allpublications par date
        usort($allpublications, array($this, 'trie_par_date'));

        return $this->render('AwardMeBundle:Accueil:accueil.html.twig', array('publications' => $allpublications));
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

    private function trie_par_date($a, $b) {
        $date1 = strtotime($a->getDate()->format('r'));
        $date2 = strtotime($b->getDate()->format('r'));
        return $date1 < $date2 ;
    }

}
