<?php
/**
 * Created by PhpStorm.
 * User: Gaucks
 * Date: 15/08/2014
 * Time: 14:00
 */

namespace AwardMe\AwardMeBundle\EventListener;
use Symfony\Component\HttpFoundation\Session\Session;


class PublicationEvents {

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function failed(){
        $this->session->getFlashBag()->add('error','Un probleme est survenu, la publication ne s\'est pas faite.');
    }

    public function success(){
        $this->session->getFlashBag()->add('success','Publication ajoutée !');
    }

    public function updated(){
        $this->session->getFlashBag()->add('success','Publication mise à jour !');
    }
} 