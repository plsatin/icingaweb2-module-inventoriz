<?php

namespace Icinga\Module\Inventoriz\Controllers;

use Icinga\Module\Inventoriz\Forms\Config\GeneralConfigForm;
use Icinga\Web\Controller;


class ConfigController extends Controller
{
    public function init()
    {
        $this->assertPermission('config/modules');
        parent::init();
    }


    public function indexAction()
    {
        $form = new GeneralConfigForm();
        $form->setIniConfig($this->Config());
        $form->handleRequest();

        $this->view->form = $form;
        $this->view->tabs = $this->Module()->getConfigTabs()->activate('Configuration');
    }
}
