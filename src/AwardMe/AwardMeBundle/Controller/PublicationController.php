<?php

namespace AwardMe\AwardMeBundle\Controller;

use AwardMe\AwardMeBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AwardMe\AwardMeBundle\Form\PublicationType;

use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller
{
    public function addAction(Request $request)
    {
        $securityContext = $this->container->get('security.context'); // Le controleur de sécurité
        if(!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->render('AwardMeBundle:Welcome:welcome.html.twig');
        }
        $user = $securityContext->getToken()->getUser(); // L'utilisateur courant

        $publication = new Publication;
        $form  = $this->createForm(new PublicationType(), $publication);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $publication->setUser($user);
            $em->persist($publication);
            $em->flush();

            return $this->redirect($this->generateUrl('award_me_homepage'));
        }

        return $this->render('AwardMeBundle:Formulaires:Publication.html.twig', array('form' => $form->createView()));
    }

    public function removeAction($id){

        $securityContext = $this->container->get('security.context'); // Le controleur de sécurité
        if(!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->render('AwardMeBundle:Welcome:welcome.html.twig');
        }
        $user = $securityContext->getToken()->getUser(); // L'utilisateur courant

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AwardMeBundle:Publication')->findOneBy(array('id' => $id, 'user' => $user));

        if(!$product){
             throw $this->createNotFoundException('Cette publication n\'existe pas ou vous ne pouvez pas la supprimé');
        }
        else{
            $em->remove($product);
            $em->flush();

            return $this->redirect($this->generateUrl('award_me_homepage'));
        }

    }

}
