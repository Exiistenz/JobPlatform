<?php

namespace Core\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\OptionsResolver\OptionsResolver;


class FolderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', 'file')
                ->add('typeFile', ChoiceType::class, array(
                    'choices'  => array(
                        Null => 'Choose',
                        'Cv' => "Cv",
                        'LettreMotiv' => "Lettre de motivation",
                        'Salaire' => "Salaire"
                    ),
                    'required' => true));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\CoreBundle\Entity\Folder'
        ));
    }

    public function getName()
    {
        return 'core_corebundle_folder';
    }
}
