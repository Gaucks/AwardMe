<?php

namespace AwardMe\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AwardMe\UserBundle\Entity\Avatar;
use Symfony\Component\HttpFoundation\Request;

class AvatarController extends Controller
{
    public function changeAction(Request $request)
    {
        $securityContext = $this->container->get('security.context'); // Le controleur de sécurité
        if(!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->render('AwardMeBundle:Welcome:welcome.html.twig');
        }
        $user = $securityContext->getToken()->getUser(); // L'utilisateur courant

        $avatar = new Avatar();

        $form = $this->createFormBuilder($avatar)
            ->add('file')
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $em->persist($avatar);
                $user->setAvatar($avatar);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success','Avatar mis à jour !');

                return $this->redirect($this->generateUrl('fos_user_profile_show'));
            }
            return $this->redirect($this->generateUrl('fos_user_profile_edit'));
        }
        return $this->render('UserBundle:Perso:change_avatar.html.twig', array('form' => $form->createView()));
    }

}