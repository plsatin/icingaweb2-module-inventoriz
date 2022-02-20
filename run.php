<?php

$this->registerHook('Monitoring\\HostActions', '\\Icinga\\Module\\Inventoriz\\HostActions');
$this->registerHook('Monitoring\\ServiceActions', '\\Icinga\\Module\\Inventoriz\\ServiceActions');

// $this->provideHook('Monitoring\\DetailviewExtension', '\\Icinga\\Module\\Inventoriz\\DetailviewExtension');