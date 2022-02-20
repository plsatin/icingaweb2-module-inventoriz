<?php
namespace Icinga\Module\Inventoriz;

use Icinga\Module\Monitoring\Object\Host;
use Icinga\Module\Monitoring\Object\Service;
use Icinga\Module\Monitoring\Web\Hook\ServiceActionsHook;
use Icinga\Web\Url;

class ServiceActions extends ServiceActionsHook
{
    public function getActionsForService(Service $service)
    {
        $elements = array();
        
        if ($service->getName() == "inventory-cycle") {
            $elements = array();
            $elements[mt('inventoriz', 'Hardware Information')] = array('url' => Url::fromPath('inventoriz/tree',
                array('host' => $service->getHost()->getName())),
                'icon' => 'host',
            );
            // $elements[mt('softwareinfo', 'Software Report')] = array('url' => Url::fromPath('/icingaweb2/iframe?url=/reports/SoftwareByHost.php?host='.$service->getHost()->getName()),
            //     'icon' => 'doc-text', );
            // $elements[mt('updatesinfo', 'Updates Report')] = array('url' => Url::fromPath('/icingaweb2/iframe?url=/reports/UpdatesByHost.php?host='.$service->getHost()->getName()),
            //     'icon' => 'doc-text', );
        }



        return $this->createNavigation($elements);

    }
}