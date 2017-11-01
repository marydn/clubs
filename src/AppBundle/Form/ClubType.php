<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nombre:',
            ))
            ->add('phone', TextType::class, array(
                'label' => 'Teléfono',
            ))
            ->add('players', EntityType::class, array(
                'label' => 'Jugadores',
                'class' => 'AppBundle:Player',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) use ($builder) {
                    return $er->createQueryBuilder('p')
                        ->where('p.club IS NULL or p.club = :club')
                        ->orderBy('p.name', 'ASC')
                        ->setParameter('club', $builder->getData());
                },
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Club'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_club';
    }
}
