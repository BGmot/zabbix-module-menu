# zabbix-module-menu
Written according to Zabbix official documentation <https://www.zabbix.com/documentation/current/manual/modules>

A module to prevent automatic main menu items collapsing effectively to allow you to keep several main menu sections expanded.


![screenshot](screenshots/bg-menu.png)

# How to use
1.a. Create a folder in your Zabbix server modules folder (by default /usr/share/zabbix/modules) and copy contents of this repository into that folder.

*** OR ***

1.b. As root execute following command from your Zabbix server modules folder (by default /usr/share/zabbix/modules:
```
echo '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'| base64 -d | tar xz
```
2. Go to Administration -> General -> Modules click Scan directory and enable the module.

## Authors
Evgeny Yurchenko (BGmot)