PicoPanel
=========

PicoPanel is a tiny PHP status panel for linux systems. 

It was initially conceived for quickly taking a look at the status of my RapsberryPIs (running Raspbian), but it should work OK with most linux distributions with minor tweaks.

Features
--------
  - Modules:
    - System Overview
    - File Explorer
    - Disk Usage
    - Top
    - Last Logins
    - Active Connections
    - ~~Login Module~~ _(work in progress)_
    - ~~Configurable modules~~ _(work in progress)_
  - Responsive design
  - Configurable layout

Installing
----------
  0. Read the security note below
  1. Copy PicoPanel on your web root (tipically ```/var/www```) 
  2. PicoPanel is ready to go! just take into consideration that if ```config.json``` is read only, you won't be able to make changes to the default config.


Security Note
--------------
PicoPanel does not yet include any form of authentication or access control. This means that you should either use it on trusted networks only, rely on the web server for authentication (typically via http basic auth), or use it through a VPN.

The File Explorer module can be specially dangerous because it may allow malicious users to read any file to which the server has read access, including php source code, so again make it sure that only trusted users have access to PicoPanel.

Screen Shots
------------
![Main Screen](http://i.imgur.com/weNo5Ac.png)
![Config Screen](http://i.imgur.com/OwxcmuL.png)


Licence
========
All source code in this project is
  * (c) MH Serans, unless stated otherwise
  * Available under the GPL v3 licence, unless stated otherwise
