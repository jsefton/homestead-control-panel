<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Jsefton\DotEnv\Parser;
use Symfony\Component\Yaml\Yaml;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homestead:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup own Homestead box for tool if not using Valet';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Configuring Homestead.yaml');
        $yaml = Yaml::parse(file_get_contents(base_path() . '/Homestead.yaml'));

        // Configure IP address
        $ip = $this->ask('Please set an IP address to use for this box', $yaml['ip']);
        $yaml['ip'] = $ip;

        // Set site domain
        $domain = $this->ask('Please enter a domain you want to use for this control panel', 'homestead.control');
        $yaml['sites'][0]['map'] = $domain;

        $this->line('Updating Homestead.yaml');
        // Put update Yaml in site directory
        $yamlContents = Yaml::dump($yaml, 3);
        file_put_contents(base_path() . '/Homestead.yaml', $yamlContents);

        $this->line('Updating database details in .env');
        // Get .env contents
        $env = Parser::envToArray(base_path() . '/.env');

        // Update database details in site .env
        $env['DB_HOST'] = $ip;
        $env['DB_USERNAME'] = "homestead";
        $env['DB_PASSWORD'] = "secret";

        // Update contents in .env
        Parser::arrayToEnv($env, base_path() . '/.env');

        if (strpos(file_get_contents("/etc/hosts"), $domain) !== false) {
            $this->error('Domain already exists in hosts file.');
        } else {
            $password = $this->secret('Please enter your password');
            $this->line('Adding site to /etc/hosts');
            $command = 'echo \'' . $password . '\' | sudo -S echo "' . $ip . '   ' . $domain . '" >> /etc/hosts';
            shell_exec($command);
        }

        // Bring up the box and provision
        $this->line('Creating homestead box and bringing up...');
        exec('cd ' . base_path() . ' && vagrant up && vagrant provision');
        $this->info('Box created!');

        $this->line('Running migrations');
        exec('cd ' . base_path() . ' && php artisan migrate');

        $this->info('Your control panel is ready at: http://' . $domain);
    }
}
