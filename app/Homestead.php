<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homestead extends Model
{
    protected $fillable = ['box_name', 'ip_address', 'yaml_location', 'vagrant_file_location', 'homestead_alias'];


    public function sites()
    {
        return $this->hasMany('\App\Site');
    }

    public function powerStatus()
    {
        $host = $this->ip_address;
        $port = 80;
        $timeout = 1;
        try {
            $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
            if (!$fP) {
                return false;
            }
            return true;
        } catch (\Exception $e) {}

        return false;
    }
}
