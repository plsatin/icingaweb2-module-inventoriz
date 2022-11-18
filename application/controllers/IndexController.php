<?php

namespace Icinga\Module\Inventoriz\Controllers;

use Icinga\Module\Inventoriz\Web\Controller\MonitoringAwareController;
use Icinga\Module\Monitoring\DataView\DataView;
use Icinga\Data\Filter\Filter;
use Icinga\Web\Url;
use Icinga\Web\Controller\ModuleActionController;
use Icinga\Application\Icinga;
use Icinga\Web\Controller;
use Icinga\Web\Widget;
use Icinga\Authentication\Auth;


class IndexController extends MonitoringAwareController
{
    public function init()
    {
        // $this->view->hostBaseUrl = $hostBaseUrl = $this->_request->getBaseUrl();
        
    }

    public function indexAction()
    {


        // $this->view->hosts = $hosts = $this->applyMonitoringRestriction(
        // $this->backend->select()->from('hoststatus', [
        //         'host_name',
        //         'host_display_name',
        //         'host_icon_image',
        //         'host_state',
        //         'os' => '_host_os',
        //         'cpu' => '_host_cpu',
        //         'ram' => '_host_ram',
        //         'manufacturer' => '_host_manufacturer',
        //         'model' => '_host_model',

        //     ])
        //     ->applyFilter(Filter::fromQueryString('_host_os_type >'))
        // );

        // $this->filterQuery($hosts);
        // $this->setupPaginationControl($hosts);
        // $this->setupLimitControl();
        // $this->setupSortControl([
        //     'host_display_name' => mt('monitoring', 'Hostname'),
        //     '_host_os'          => mt('monitoring', 'Host OS'),
        //     'host_state'        => mt('monitoring', 'Current State'),
        // ], $hosts);



        $this->view->tabs = $this->tabs()->activate('index');


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




    /**
     * Apply filters on a DataView
     *
     * @param DataView  $dataView       The DataView to apply filters on
     */
    protected function filterQuery(DataView $dataView)
    {
        $this->setupFilterControl(
            $dataView,
            null,
            null,
            array_merge(['format', 'stateType', 'addColumns', 'problems']
        ));
        $this->handleFormatRequest($dataView);
    }

}