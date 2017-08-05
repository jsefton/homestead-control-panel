# Homestead Control Panel

This is a simple interface for using Homestead for local development. It allows you to view specific site logs along with add features such as:

- Adding a new site
- Remove a site
- View PHP & NGIX logs of a specific site
- Re-provision box
- Restart PHP
- Reboot box
- View all current sites
- Import and Export all Homestead Databases

<img src="https://pbs.twimg.com/media/DGcH7ZLXsAA4Xkl.jpg:large" width="100%">

## Installation

To power this tool it requires the use of Valet. Please follow the installation guide on Laravel docs: https://laravel.com/docs/5.4/valet

First clone down this repository and move inside it:

```bash
git clone git@github.com:jsefton/homestead-control-panel.git && cd homestead-control-panel
```

Next link up Valet for the specific site:
```bash
valet link homestead-control
```
Copy the environment example file. You should not need to change anything inside this
```bash
cp .env.example .env
```

Then just visit: http://homestead-control.dev

### TO DO
- Make an interface to add a new site
- Make console command for adding a new site, used by interface and available to users
- Add ability to export and then import all databases from an entire box