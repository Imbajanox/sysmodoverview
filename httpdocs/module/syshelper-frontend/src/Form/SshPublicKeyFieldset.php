<?php

namespace WirklichDigital\SyshelperFrontend\Form;

use WirklichDigital\SyshelperBase\Entity\SshPublicKey;
use Laminas\Form\Fieldset;
use Laminas\InputFilter\InputFilterProviderInterface;
use WirklichDigital\DynamicEntityModule\Form\UseDoctrineHydrator;
use WirklichDigital\DynamicEntityModule\Form\LazyAddInterface;
use WirklichDigital\DynamicEntityModule\Form\LazyAddTrait;
use Laminas\I18n\Validator\IsInt;
use Laminas\I18n\Filter\NumberParse;
use XelaxHTMLPurifier\Filter\HTMLPurifier;
use WirklichDigital\ObjectSelect\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;
use WirklichDigital\StdLib\ColorUtils\ColorCalculator;

class SshPublicKeyFieldset extends Fieldset implements InputFilterProviderInterface, UseDoctrineHydrator, LazyAddInterface, ObjectManagerAwareInterface
{

    use LazyAddTrait, \DoctrineModule\Persistence\ProvidesObjectManager;

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->setObject(new SshPublicKey());

        $this->add([
            'name'       => 'title',
            'type'       => 'text',
            'options'    => [
                'label' => gettext_noop('Title'),
            ],
        ]);

        $this->add([
            'name'       => 'keyType',
            'type'       => 'select',
            'options'    => [
                'label' => gettext_noop('Key Type'),
                'value_options' => [
                    'ssh-ecdsa' => 'ssh-ecdsa',
                    'ssh-ed25519' => 'ssh-ed25519',
                    'ssh-rsa' => 'ssh-rsa',
                    'ssh-dsa' => 'ssh-dsa',
                    'ssh-sha2-nistp256' => 'ssh-sha2-nistp256',
                    'ssh-sha2-nistp384' => 'ssh-sha2-nistp384',
                    'ssh-sha2-nistp521' => 'ssh-sha2-nistp521'
                ],
            ],
        ]);

        $this->add([
            'name'       => 'usergroup',
            'type'       => 'select',
            'options'    => [
                'label' => gettext_noop('Usergroup'),
                'value_options' => [
                    '' => gettext_noop('No group (e.g. use for customer keys)'),
                    'employee' => gettext_noop('Employee'),
                ],
            ],
        ]);

        $this->add([
            'name'       => 'fingerprint',
            'type'       => 'hidden',
            'options'    => [
                'label' => gettext_noop('Fingerprint'),
            ],
        ]);

        $this->add([
            'name'       => 'keyData',
            'type'       => 'text',
            'options'    => [
                'label' => gettext_noop('Key Data'),
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        $filters = [
            "title" => [
                "required" => true,
                "filters" => [
                    ["name" => "StringTrim"],
                    ["name" => "StripTags"],
                    ["name" => HTMLPurifier::class],
                ],
                "validators" => [
                ],
            ],
            "keyType" => [
                "required" => true,
                "filters" => [
                    ["name" => "StringTrim"],
                ],
                "validators" => [
                ],
            ],
            "usergroup" => [
                "required" => false,
                "filters" => [
                    ["name" => "StringTrim"],
                ],
                "validators" => [
                ],
            ],
            "keyData" => [
                "required" => true,
                "filters" => [
                    ["name" => "StringTrim"],
                ],
                "validators" => [
                ],
            ],
        ];
        return $filters;
    }
}
