<?php

namespace AwardMe\AwardMeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\False;

class PublicationImageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('date')
            //->add('path')
            ->add('content', null, array('label' => false, 'attr' => array('class' => 'add-pic')))
            ->add('file', null, array('required' => true  ,'label' => false  , 'attr' => array('class' => 'add-pic-file')));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AwardMe\AwardMeBundle\Entity\PublicationImage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'awardme_awardmebundle_publicationimage';
    }
}
