<?php

namespace AwardMe\AwardMeBundle\Services;

class PublicationService {

    protected $em;

    public function __construct($doctrine)
    {
        $this->em = $doctrine->getEntityManager();
    }

    // Enregistrement
    public function addPublication($publication , $user)
    {
        $this->saveBDD($publication->setUser($user));
        return TRUE;
    }

    // Enregistrement quand c'est une image
    public function addPublicationImage($publication , $user)
    {
        $this->saveBDD($publication->setUser($user));
        return TRUE;
    }

    // Modification
    public function  updatePublication($publication , $user){
        $this->em->flush();
        return TRUE;
    }

    // Supprime
    public function removePublication($publication, $user){

        $product = $this->em->getRepository('AwardMeBundle:Publication')->findOneBy(array('id' => $publication, 'user' => $user));

        if(!$product){
            return false;
        }
        else{
            $this->updateBDD($product);
            return TRUE;
        }
    }

    // Sauvegarde de la BDD
    private function saveBDD($publication){
        $this->em->persist($publication);
        $this->em->flush();
    }

    // Mise à jour de la BDD
    private function updateBDD($publication){
        $this->em->remove($publication);
        $this->em->flush();
    }

} 