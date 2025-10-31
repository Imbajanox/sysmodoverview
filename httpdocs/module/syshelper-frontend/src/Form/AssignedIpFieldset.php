<?php

namespace WirklichDigital\SyshelperFrontend\Form;

use WirklichDigital\SyshelperBase\Entity\AssignedIp;
use Laminas\Form\Fieldset;
use Laminas\InputFilter\InputFilterProviderInterface;
use WirklichDigital\DynamicEntityModule\Form\UseDoctrineHydrator;
use WirklichDigital\DynamicEntityModule\Form\LazyAddInterface;
use WirklichDigital\DynamicEntityModule\Form\LazyAddTrait;
use XelaxHTMLPurifier\Filter\HTMLPurifier;
use WirklichDigital\ObjectSelect\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;

class AssignedIpFieldset extends Fieldset implements InputFilterProviderInterface, UseDoctrineHydrator, LazyAddInterface, ObjectManagerAwareInterface
{

    use LazyAddTrait, \DoctrineModule\Persistence\ProvidesObjectManager;

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->setObject(new AssignedIp());

        $this->add([
            'name'       => 'syshelperDescription',
            'type'       => 'textarea',
            'options'    => [
                'label' => gettext_noop('Syshelper Description'),
            ],
        ]);

        $this->add([
            'name'       => 'tags',
            'type'       => ObjectSelect::class,
            'attributes' => [
                'multiple' => true,
            ],
            'options'    => [
                'object_manager'    => $this->getObjectManager(),
                'use_hidden_element' => true,
                'target_class'      => \WirklichDigital\SyshelperBase\Entity\SyshelperTag::class,
                'label_generator'   => function ($entity) {
                    return $entity->getName();
                },
                'label'             => gettext_noop('Syshelper Tag'),
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        $filters = [
            "syshelperDescription" => [
                "required" => false,
                "filters" => [
                    ["name" => "StringTrim"],
                    ["name" => "StripTags"],
                    ["name" => HTMLPurifier::class],
                ],
                "validators" => [
                ],
            ],
        ];
        return $filters;
    }
}
