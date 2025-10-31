<?php

namespace WirklichDigital\SyshelperFrontend\Form;

use Doctrine\Common\Collections\Criteria;
use WirklichDigital\SyshelperBase\Entity\SshPublicKeyHostAccess;
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
use WirklichDigital\SyshelperBase\Entity\SshPublicKey;

class SshPublicKeyHostAccessFieldset extends Fieldset implements InputFilterProviderInterface, UseDoctrineHydrator, LazyAddInterface, ObjectManagerAwareInterface
{

    use LazyAddTrait, \DoctrineModule\Persistence\ProvidesObjectManager;

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->setObject(new SshPublicKeyHostAccess());

        $criteria = new Criteria();
        $criteria
            ->andWhere($criteria->expr()->notIn('usergroup', ["admin","high"]))
            ->orderBy(['title' => 'ASC']);

        $this->add([
            'name'       => 'sshPublicKey',
            'type'       => ObjectSelect::class,
            'options'    => [
                'object_manager'    => $this->getObjectManager(),
                'use_hidden_element' => true,
                'find_method'    => [
                    'name'   => 'matching',
                    'params' => [
                        'criteria' => $criteria
                    ],
                ],
                'target_class'      => \WirklichDigital\SyshelperBase\Entity\SshPublicKey::class,
                'label_generator'   => function (SshPublicKey $entity) {
                    return $entity->getTitle().' | '.$entity->getKeyType().' | '.count($entity->getHostMappings()).' host(s)';
                },
                'label'             => gettext_noop('SSH Public Key'),
            ],
        ]);

        $this->add([
            'name'       => 'host',
            'type'       => ObjectSelect::class,
            'options'    => [
                'object_manager'    => $this->getObjectManager(),
                'use_hidden_element' => true,
                'find_method'    => [
                    'name'   => 'findBy',
                    'params' => [
                        'criteria' => [],
                        'orderBy' => ['fqdn' => 'ASC'],
                    ],
                ],
                'target_class'      => \WirklichDigital\SyshelperBase\Entity\Host::class,
                'label_generator'   => function ($entity) {
                    return $entity->getFqdn();
                },
                'label'             => gettext_noop('Host'),
            ],
        ]);

        $this->add([
            'name'       => 'userOnHost',
            'type'       => 'text',
            'options'    => [
                'label' => gettext_noop('User on host'),
            ],
        ]);

        $this->add([
            'name'       => 'doNotBlockIfUnused',
            'type'       => 'select',
            'options'    => [
                'label' => gettext_noop('Do not delete if unused'),
                'value_options' => [
                    '0' => gettext_noop('No'),
                    '1' => gettext_noop('Yes'),
                ],
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        $filters = [
        ];
        return $filters;
    }
}
