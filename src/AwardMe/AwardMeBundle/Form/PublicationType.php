<?php

namespace AwardMe\AwardMeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PublicationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content','textarea', array('label' => FALSE ,'attr' => array('class' => 'publication')))
            ->remove('date')
            ->remove('user')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AwardMe\AwardMeBundle\Entity\Publication'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'awardme_awardmebundle_publication';
    }
}
