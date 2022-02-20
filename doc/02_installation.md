# Installation

## Requirements

* [Icinga Web 2](https://www.icinga.com/products/icinga-web-2/) (>= 2.4.1)

## Installation the Inventoriz module


Extract this module to your Icinga Web 2 modules directory as `inventoriz` directory.

Git clone:

```bash
cd /usr/share/icingaweb2/modules
git clone https://github.com/plsatin/icingaweb2-module-inventoriz.git inventoriz
```

Enable the module in the Icinga Web 2 frontend in `Configuration -> Modules -> inventoriz -> enable`.
You can also enable the module by using the `icingacli` command:

```bash
icingacli module enable inventoriz
```
