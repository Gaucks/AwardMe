<?php

namespace AwardMe\UserBundle\Form\Type;

use Doctrine\ORM\Query\Expr\Base;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        // add your custom field
        $builder->add('name')
                ->add('firstname');
    }

    public function getName()
    {
        return 'awardme_user_profile';
    }
} 