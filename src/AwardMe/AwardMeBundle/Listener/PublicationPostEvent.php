<?php
/**
 * Created by PhpStorm.
 * User: Gaucks
 * Date: 15/08/2014
 * Time: 13:15
 */

namespace AwardMe\AwardMeBundle\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\User\UserInterface;

class PublicationPostEvent extends Event {

    protected $user;
    protected $publication;
    protected $autorise;

    public function __construct(UserInterface $user, $publication)
    {
        $this->publication = $publication;
        $this->user        = $user;
    }

    // Le listener doit avoir accès a la publication
    public function getPublication()
    {
        return $this->publication;
    }

    // Le listener doit pouvoir modifier la publication
    public function setPublication($publication)
    {
        return $this->publication = $publication;
    }

    public function getUser($user)
    {
        return $this->user;
    }
} 