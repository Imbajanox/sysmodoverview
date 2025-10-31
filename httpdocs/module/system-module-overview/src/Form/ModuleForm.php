<?php

namespace WirklichDigital\SystemModuleOverview\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterProviderInterface;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemServerModule;

use function explode;
use function gettext_noop;
use function implode;

class ModuleForm extends Form implements InputFilterProviderInterface, ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    public function __construct($name = "", array $option = [])
    {
        if ($name == "") {
            $name = "ModuleForm";
        }
        if (! empty($option["name"])) {
            $name = $option["name"];
        }
        parent::__construct($name, $option);
        $this->setAttribute("method", "post");
    }

    private function getModuleNamesAndVersions()
    {
        /** @var LaminasSystemServerModule $module */
        $module         = $this->getObjectManager()->getRepository(LaminasSystemServerModule::class)->findAll();
        $moduleNames    = [];
        $moduleVersions = [];
        foreach ($module as $mod) {
            $name                                     = explode("/", $mod->getModuleName(), 2);
            $moduleNames[$mod->getModuleName()]       = implode(" / ", $name);
            $moduleVersions[$mod->getModuleVersion()] = $mod->getModuleVersion();
        }
        return ["moduleNames" => $moduleNames, "moduleVersions" => $moduleVersions];
    }

    public function init()
    {
        $this->getModuleNamesAndVersions();

        parent::init();
        $this->setInputFilter(new InputFilter());

        $this->add([
            'name'       => 'modulename',
            'type'       => 'select',
            'attributes' => [
                'id'       => 'modulename',
                'onchange' => 'getSelectedModuleName()',
            ],
            'options'    => [
                'label'         => "Module Name",
                'empty_option'  => gettext_noop('Please choose a Module'),
                'value_options' => $this->getModuleNamesAndVersions()["moduleNames"],
            ],
        ]);
        $this->add([
            'name'       => 'moduleversion',
            'type'       => 'select',
            'attributes' => [
                'id' => 'moduleversion',
            ],
            'options'    => [
                'label'         => 'Module Version',
                'empty_option'  => gettext_noop('Please choose a Module Version'),
                'value_options' => $this->getModuleNamesAndVersions()["moduleVersions"],
            ],
        ]);
         $this->add([
             'name'       => 'submit',
             'type'       => 'Submit',
             'attributes' => [
                 'value' => gettext_noop('Save'),
                 'class' => 'btn-success',
             ],
             'options'    => [
                 'label' => gettext_noop('Apply'),
             ],
         ]);
    }

    public function getInputFilterSpecification()
    {
        return [];
    }
}
