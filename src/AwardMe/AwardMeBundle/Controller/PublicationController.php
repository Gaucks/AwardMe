<?php

namespace AwardMe\AwardMeBundle\Controller;

use AwardMe\AwardMeBundle\Entity\Publication;
use AwardMe\AwardMeBundle\Entity\PublicationImage;
use AwardMe\AwardMeBundle\Form\PublicationType;
use AwardMe\AwardMeBundle\Form\PublicationImageType;
use AwardMe\AwardMeBundle\Listener\BigBrotherEvents;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller
{
    public function addAction()
    {
        return $this->render('AwardMeBundle:Formulaires:Publication.html.twig');
    }

    public function removeAction($id){

        $publicationService = $this->container->get('award_me.publicationService');

        if(!$publicationService->removePublication($id, $this->getUser())){
            throw $this->createNotFoundException('Cette publication n\'existe pas ou vous ne pouvez pas la supprimé');
        }

        return $this->redirect($this->generateUrl('award_me_homepage'));

    }

    public function updateAction(Request $request, $id){

        $publication = $this->getDoctrine()->getManager()->getRepository('AwardMeBundle:Publication')->find($id);

            if(!$publication)
            {
                $this->redirect($this->generateUrl('award_me_homepage'));
            }

        $form = $this->createForm(new PublicationType(), $publication);

        $form->handleRequest($request);

        if($form->isValid()){
            $publicationService = $this->container->get('award_me.publicationService');

            if(!$publicationService->updatePublication($publication, $this->getUser()))
            {
                // On déclenche l'évènement du raté
                $this->get('event_dispatcher')->dispatch(BigbrotherEvents::PUBLICATION_FAILED);
                return $this->redirect($this->generateUrl('award_me_homepage'));
            }

            // On déclenche l'évènement du success
            $this->get('event_dispatcher')->dispatch(BigbrotherEvents::PUBLICATION_UPDATED);
            return $this->redirect($this->generateUrl('award_me_homepage'));

        }


        return $this->render('AwardMeBundle:Formulaires:PublicationUpdate.html.twig', array('form' => $form->createView(), 'publication' => $id));
    }

    public function addPublicationImageAction(Request $request){

        $publicationImage = new PublicationImage;
        $form  = $this->createForm(new PublicationImageType(), $publicationImage);

        if ($request->isMethod('POST')) {

                $form->handleRequest($request);

                if ($form->isValid()) {

                    $publicationService = $this->container->get('award_me.publicationService');

                    // Teste de l'existance de la publication
                    if(!$publicationService->addPublicationImage($publicationImage, $this->getUser()))
                    {
                        // On déclenche l'évènement du raté
                        $this->get('event_dispatcher')->dispatch(BigbrotherEvents::PUBLICATION_FAILED);
                        return $this->redirect($this->generateUrl('award_me_homepage'));
                    }

                    // On déclenche l'évènement du success
                    $this->get('event_dispatcher')->dispatch(BigbrotherEvents::PUBLICATION_SUCCESS);
                    return $this->redirect($this->generateUrl('award_me_homepage'));
                }
        }

        return $this->render('AwardMeBundle:Formulaires/Form:PublicationImageForm.html.twig', array('form' => $form->createView()));
    }

    public function addPublicationAction(Request $request){

        $publication = new Publication;
        $form  = $this->createForm(new PublicationType(), $publication);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $publicationService = $this->container->get('award_me.publicationService');

            // Teste de l'existance de la publication
            if(!$publicationService->addPublication($publication, $this->getUser()))
            {
                // On déclenche l'évènement du raté
                $this->get('event_dispatcher')->dispatch(BigbrotherEvents::PUBLICATION_FAILED);
                return $this->redirect($this->generateUrl('award_me_homepage'));
            }

            // On déclenche l'évènement du success
            $this->get('event_dispatcher')->dispatch(BigbrotherEvents::PUBLICATION_SUCCESS);
            return $this->redirect($this->generateUrl('award_me_homepage'));
        }

        return $this->render('AwardMeBundle:Formulaires/Form:PublicationForm.html.twig', array('form' => $form->createView()));
    }

}
