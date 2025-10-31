<?php

namespace WirklichDigital\SyshelperFrontend\Form;

use Laminas\Form\Form;
use Laminas\Form\Element\Csrf;
use Laminas\InputFilter\InputFilter;
use WirklichDigital\EntityTranslation\Form\TranslationInfoAwareInterface;
use WirklichDigital\EntityTranslation\Form\TranslationInfoAwareTrait;

class SshPublicKeyHostAccessForm extends Form implements TranslationInfoAwareInterface
{

    use TranslationInfoAwareTrait;

    public function __construct($name = "", $options = [])
    {
        if ($name == "") {
            $name = "SshPublicKeyHostAccessForm";
        }
        parent::__construct($name, $options);
        $this->setAttribute("method", "post");
    }

    public function init()
    {
        parent::init();
        $this->setInputFilter(new InputFilter());

        $this->add([
            'name' => 'SshPublicKeyHostAccess',
            'type' => SshPublicKeyHostAccessFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true,
            ],
        ]);

        $this->add([
            'name' => 'SshPublicKeyHostAccess_csrf',
            'type' => Csrf::class,
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => gettext_noop('Save'),
                'class' => 'btn-success',
            ],
            'options' => [
                'as-group' => true,
            ]
        ]);
    }
}
