<?php
/**
 * Created by PhpStorm.
 * User: Gaucks
 * Date: 15/08/2014
 * Time: 13:12
 */

namespace AwardMe\AwardMeBundle\Listener;


final class BigBrotherEvents {

    const onPublicationPost = 'award_me.bigbrother.publication_post';

    /**
     * Renvoi la route du RATÉ
     */
    const PUBLICATION_FAILED = 'award_me.publication_events_failed';

    /**
     * Renvoi la route quand la publication à réussie
     */
    const PUBLICATION_SUCCESS = 'award_me.publication_events_success';

    /**
     * Renvoi la route quand la publication à réussie
     */
    const PUBLICATION_UPDATED = 'award_me.publication_events_updated';

    /**
     * Mise à jour de l'activité
     */
    const ACTIVITY_UPDATE     = 'award_me.activity_listener';

} 