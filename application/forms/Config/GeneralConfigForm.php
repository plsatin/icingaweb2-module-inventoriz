<?php


namespace Icinga\Module\Inventoriz\Forms\Config;

use Exception;
use Icinga\Data\ResourceFactory;
use Icinga\Forms\ConfigForm;

class GeneralConfigForm extends ConfigForm
{

    public function init()
    {
        $this->setName('form_config_inventoriz_general');
        $this->setSubmitLabel($this->translate('Save Changes'));
    }

    public function createElements(array $formData)
    {

        $this->addElement(
            'text',
            'inventoriz_url',
            array(
                'value'         => 'http://itdesk.inventoriz.local:8400',
                'label'         => 'Server URL',
                'description'   => '',
                'requirement'   => 'Example: http://itdesk.inventoriz.local:8400'
            )
        );

        $this->addElement(
            'text',
            'inventoriz_user',
            array(
                'value'         => 'inventoriz_user',
                'label'         => 'User name',
                'description'   => '',
                'requirement'   => ''
            )
        );

        $this->addElement(
            'text',
            'inventoriz_password',
            array(
                'value'         => 'inventoriz_password',
                'label'         => 'User password',
                'description'   => '',
                'requirement'   => ''
            )
        );

    }
}
