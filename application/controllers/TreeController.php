<?php

namespace Icinga\Module\Inventoriz\Controllers;


use Icinga\Module\Inventoriz\Web\Controller\MonitoringAwareController;
use Icinga\Module\Monitoring\DataView\DataView;
use Icinga\Web\Url;


class TreeController extends MonitoringAwareController
{
    public function init()
    {
        // $this->view->hostBaseUrl = $hostBaseUrl = $this->_request->getBaseUrl();
        // $this->view->baseUrl = $baseUrl = Url::fromPath('hatdwareinfo/tree');
        // $this->view->paramUrl = $paramUrl = $this->getRequest()->getUrl()->getParams();
        
    }

    public function indexAction()
    {

        $this->view->treehost = $treehost = $this->getRequest()->getUrl()->getParam('host');

    }



    protected function tabs()
    {
        $auth = Auth::getInstance();
        
        if ($auth->hasPermission('inventoriz/hosts'))
        {


            return Widget::create('tabs')->add(
                'index',
                array(
                    'label' => $this->translate('Hosts'),
                    'url'   => 'inventoriz'
                )
            )->add(
                'tree',
                array(
                    'label' => $this->translate('Information'),
                    'title' => $this->translate('Hardware Information'),
                    'url'   => 'inventoriz/tree'
                )
            );


        } else {

            return Widget::create('tabs')->add(
                'tree',
                array(
                    'label' => $this->translate('Information'),
                    'title' => $this->translate('Hardware Information'),
                    'url'   => 'inventoriz/tree'
                )
            );


        }
    }



}