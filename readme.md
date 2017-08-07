# Homestead Control Panel

This is a simple interface for using Homestead for local development. It allows you to view specific site logs along with add features such as:

- Adding & removing of a site
- Add new database automatically with new site
- View PHP & NGIX logs of a specific site
- Re-provision box
- Restart PHP
- Reboot box
- Import and Export all Homestead Databases

<img src="https://pbs.twimg.com/media/DGcH7ZLXsAA4Xkl.jpg:large">

## Installation

First clone down this repository and move inside it:

```bash
git clone git@github.com:jsefton/homestead-control-panel.git && cd homestead-control-panel
```

Run the `make` command to install the needed features:

```bash
make
```

### Local Setup: Using Valet

You can use Valet to help host this within your local setup. Please follow the installation guide on Laravel docs: https://laravel.com/docs/5.4/valet

Connect to your Valet MySQL and create a database called `homestead-control`

Then run migrations:

```bash
php artisan migrate
```

### Local Setup: Using Homestead Box 

**THIS IS CURRENTLY IN DEVELOPMENT, PLEASE DO NOT USE YET**

You can host the control panel within its own separate Homestead Box. This package comes with an easy to install set of commands to run through this process:

```bash
php artisan homestead:install
```

This will ask for a few questions to decide the IP address and domain, which will then get added to your `/etc/hosts` automatically as well as bring the box up. After it is up it will auto run migrations.

### Final Steps

The final step is to start a queue worker, this is essential for any of the background long processes to be done:
```bash
php artisan queue:work
```

Then just visit: http://homestead-control.dev

### TO DO
- Make an interface to add a new site
- Make console command for adding a new site, used by interface and available to users
- Add ability to export and then import all databases from an entire box