<?php

namespace WirklichDigital\SyshelperFrontend\Form;

use WirklichDigital\SyshelperBase\Entity\SyshelperTag;
use Laminas\Form\Fieldset;
use Laminas\InputFilter\InputFilterProviderInterface;
use WirklichDigital\DynamicEntityModule\Form\UseDoctrineHydrator;
use WirklichDigital\DynamicEntityModule\Form\LazyAddInterface;
use WirklichDigital\DynamicEntityModule\Form\LazyAddTrait;
use XelaxHTMLPurifier\Filter\HTMLPurifier;
use WirklichDigital\ObjectSelect\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;

class SyshelperTagFieldset extends Fieldset implements InputFilterProviderInterface, UseDoctrineHydrator, LazyAddInterface, ObjectManagerAwareInterface
{

    use LazyAddTrait, \DoctrineModule\Persistence\ProvidesObjectManager;

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->setObject(new SyshelperTag());

        $this->add([
            'name'       => 'name',
            'type'       => 'text',
            'options'    => [
                'label' => gettext_noop('Name'),
            ],
        ]);
        $this->add([
            'name'       => 'color',
            'type'       => 'text',
            'options'    => [
                'label' => gettext_noop('Color'),
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        $filters = [
            "name" => [
                "required" => false,
                "filters" => [
                    ["name" => "StringTrim"],
                    ["name" => "StripTags"],
                    ["name" => HTMLPurifier::class],
                ],
                "validators" => [
                ],
            ],
            "color" => [
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
