<?php

namespace User\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Core\CoreBundle\Form\ImageType;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name', 'text', array('required' => true))
				->add('firstName', 'text', array('required' => true))
				->add('phone', 'text', array('required' => true))
				->add('address', 'text', array('required' => true))
				->add('areaCode', 'text', array('required' => true))
				->add('city', 'text', array('required' => true))
				->add('country', 'text', array('required' => true));


	}

	public function getParent()
	{
		return 'fos_user_registration';
	}

	public function getName()
	{
		return 'app_user_registration';
	}
}