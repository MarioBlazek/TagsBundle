<?php

namespace Netgen\TagsBundle\Form\Type;

use Netgen\TagsBundle\API\Repository\Values\Tags\Tag;
use Netgen\TagsBundle\API\Repository\Values\Tags\TagUpdateStruct;
use Netgen\TagsBundle\Form\DataMapper\TagUpdateStructDataMapper;
use Netgen\TagsBundle\Validator\Constraints\Structs\TagUpdateStruct as TagUpdateStructConstraint;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagUpdateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
            ->setRequired(['tag', 'languageCode'])
            ->setAllowedTypes('tag', Tag::class)
            ->setAllowedTypes('languageCode', 'string')
            ->setDefaults(
                [
                    'data_class' => TagUpdateStruct::class,
                    'constraints' => function (Options $options) {
                        return [
                            new TagUpdateStructConstraint(
                                [
                                    'payload' => $options['tag'],
                                    'languageCode' => $options['languageCode'],
                                ]
                            ),
                        ];
                    },
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setDataMapper(new TagUpdateStructDataMapper($options['languageCode']));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TagType::class;
    }
}
