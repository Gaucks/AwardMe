<?php

namespace AwardMe\AwardMeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\False;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
            $publicationImage = $event->getData();
            $form = $event->getForm();

            // vérifie si l'objet Product est "nouveau"
            // Si aucune donnée n'est passée au formulaire, la donnée est "null".
            // Ce doit être considéré comme un nouveau "Product"
            if (!$publicationImage || null === $publicationImage->getId()) {
                $form->add('file', null, array('required' => true  ,'label' => false  , 'attr' => array('class' => 'add-pic-file')));;
            }
        });
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
