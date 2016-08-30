<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'comment',
            TextareaType::class,
            [
                'label' => 'create_comment.label.comment',
                'property_path' => 'comment',
                'attr' => [
                    'maxlength' => 2000,
                ],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'comment';
    }
}
