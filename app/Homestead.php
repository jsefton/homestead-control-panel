<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Homestead extends Model
{
    protected $fillable = ['box_name', 'ip_address', 'yaml_location', 'vagrant_file_location', 'homestead_alias'];

    protected $power = null;

    public function sites()
    {
        return $this->hasMany('\App\Site');
    }

    public function powerStatus()
    {
        $host = $this->ip_address;
        $port = 80;
        $timeout = 1;

        if($this->power === null) {
            try {
                $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
                if (!$fP) {
                    $this->power = false;
                    return false;
                }
                $this->power = true;
                return true;
            } catch (\Exception $e) {
            }

            return false;
        } else {
            return $this->power;
        }
    }
}
