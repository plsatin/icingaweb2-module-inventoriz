# How to collect data

## Manual collect data


## Collect data with the icinga2 service on Windows systems

```conf
object CheckCommand "powershell" {
    import "plugin-check-command"
    timeout = 5m

    command = [ "powershell.exe" ]
    arguments = {
        "-command" = {
            skip_key = true
            value = "$ps_command$"
            order = 0
        }
        "-args" = {
            skip_key = true
            value = "$ps_args$"
            order = 1
        }
    }
}

```

```conf
apply Service "inventory-cycle" {
    ; enable_active_checks = false
    max_check_attempts = 2
    check_interval = 420h
    retry_interval = 10m
    enable_perfdata = false

    check_command = "powershell"
    vars.ps_command = "c:\\ProgramData\\icinga2\\Scripts\\icinga2\\Invoke-InventoryCycleps1"
    vars.ps_args = "."
    command_endpoint = host.vars.client_endpoint

    assign where host.name == host.vars.client_endpoint && host.vars.os_family == "Windows"
    ignore where host.vars.os_family == "Linux" || host.vars.os_type == "Linux"
}

```

