<?php

// $this->registerHook('Monitoring\\HostActions', '\\Icinga\\Module\\Inventoriz\\HostActions');
// $this->registerHook('Monitoring\\ServiceActions', '\\Icinga\\Module\\Inventoriz\\ServiceActions');
// $this->provideHook('Monitoring\\DetailviewExtension', '\\Icinga\\Module\\Inventoriz\\DetailviewExtension');


//// Для версии - Icinga Web 2 Version 2.11.2
$this->provideHook('Monitoring\\HostActions', '\\Icinga\\Module\\Inventoriz\\HostActions');
$this->provideHook('Monitoring\\ServiceActions', '\\Icinga\\Module\\Inventoriz\\ServiceActions');


