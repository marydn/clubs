<?php
/**
 * Created by PhpStorm.
 * User: mary
 * Date: 1/11/17
 * Time: 11:59
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('club', TextType::class, array(
                'label' => 'Club:',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Club:'
                ),
            ))
            ->add('phone', TextType::class, array(
                'label' => 'Teléfono',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Teléfono:'
                ),
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_search';
    }
}