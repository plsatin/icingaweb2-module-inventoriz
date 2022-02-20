<?php

/** @var \Icinga\Application\Modules\Module $this */

use Icinga\Application\Config;


use Icinga\Authentication\Auth;
$auth = Auth::getInstance();

$this->providePermission(
    'inventoriz/hosts',
    $this->translate('Allow unrestricted access to query data in Hardware Information')
);



if ($auth->hasPermission('inventoriz/hosts'))
{

    $section = $this->menuSection($this->translate('Hardware inventory'), array(
        'url' => 'inventoriz',
        'title' => $this->translate('Hardware Information'),
        'icon' => 'host'
    ));

}



$this->provideConfigTab('Configuration', array(
    'title' => $this->translate('Adjust the general configuration of the inventoriz module'),
    'label' => $this->translate('Configuration'),
    'url' => 'config'
));


$this->provideCssFile('fancytree/ui.fancytree.css');

$this->provideJsFile('fancytree/jquery-ui-dependencies/jquery.fancytree.ui-deps.js');
$this->provideJsFile('fancytree/jquery.fancytree.js');
