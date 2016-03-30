<div align="center">
    <img src="info/logo.png" height="40%" width="40%">
</div>

> A route for the places you'll go

## Dependencies

- php 7
- Laravel
- Composer
- GNU make
- Vagrant
- VirtualBox
- MySQL
- Homestead

## Usage

```
# Mac/Linux:
user:hooked php vendor/bin/homestead make
# Windows
user:hooked vendor\\bin\\homestead make

user:hooked vagrant up 
```

Vagrant will launch and boot a virtual machine and automatically configure it for you.

To destroy the machine, you may use the `vagrant destroy --force` command.


Homestead requires the "domains" for Nginx sites to be added to the `host` file on your machine. The location of the `host` file depending on your choice of OS. On Mac and Linux, this file is located at `/etc/hosts`. On Windows, it is located at `C:\Windows\System32\drivers\etc\hosts`. The lines you add to this file will look like the following (with the domain of your choice):

```
192.168.10.10 homestead.app
```

Make sure the IP address listed is the one set in your `location/to/hooked/.homestead/Homestead.yaml` file. Once you have added the domain to your `hosts` file, you can access the site via your web browser:

```
http://homestead.app
```


