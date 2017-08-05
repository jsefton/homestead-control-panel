<?php

namespace App\Console\Commands;

trait PrependsOutput
{
    public function line($string, $style = null, $verbosity = null)
    {
        parent::line($this->prepend($string), $style, $verbosity);
    }

    public function comment($string, $style = null, $verbosity = null)
    {
        parent::comment($this->prepend($string), $style, $verbosity);
    }

    public function error($string, $style = "error", $verbosity = null)
    {
        parent::line("[error] " . $this->prepend($string), $style, $verbosity);
    }

    public function info($string, $style = "info", $verbosity = null)
    {
        parent::line("[info] " . $this->prepend($string), $style, $verbosity);
    }

    public function warn($string, $style = null, $verbosity = null)
    {
        parent::warn("[warn] " . $this->prepend($string), $style, $verbosity);
    }

    protected function prepend($string)
    {
        if (method_exists($this, 'getPrependString')) {
            return $this->getPrependString($string).$string;
        }
       
        return $string;
    }
}