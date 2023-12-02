<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ServeCommand;

class ____ extends ServeCommand
{

    protected $name = 'run';

    /**
     * @return int|mixed|string
     */
    protected function port()
    {
        $port = $this->input->getOption('port');

        if (is_null($port)) {
            [, $port] = $this->getHostAndPort();
        }

        $port = $port ?: $this->getEnvPort();;

        return $port + $this->portOffset;
    }

    protected function getEnvPort(): ? int
    {
        return parse_url(config('app.url'), PHP_URL_PORT) ?: 8000;
    }
}
