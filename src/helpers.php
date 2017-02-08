<?php

if (! function_exists('env_prod')) {
    /**
     * Returns the values in production or local env.
     *
     * @param  mixed  $true
     * @param  mixed  $false
     * @return mixed
     */
    function env_prod($true = true, $false = false)
    {
        return (config('app.env') === 'production')
            ? $true : $false;
    }
}

if (! function_exists('trunc')) {
    /**
     * Truncates the string to set length
     *
     * @param  string|null  $string
     * @param  int|null     $length
     * @return string
     */
    function trunc($string = null, $length = null)
    {
        if (is_numeric($length)) {
            $length = $length > 6 ? $length - 3 : $length;
        }

        if (!$string) {
            return '';
        }

        return substr($string, 0, $length) . ((strlen($string) > $length) ? '...' : '');
    }
}

if (! function_exists('event_if')) {
    /**
     * Fire an event and call the listeners if the given data condition is true.
     *
     * @param  boolean  $boolean
     * @param  string|object  $event
     * @param  mixed  $payload
     * @param  bool  $halt
     * @return array|null
     */
    function event_if($boolean, $event, $payload = [], $halt = false)
    {
        if ($boolean) {
            return app('events')->fire($event, $payload, $halt);
        }
    }
}

if (! function_exists('d')) {
    /**
     * Dump the passed variables and continue the script.
     *
     * @param  mixed
     * @return void
     */
    function d()
    {
        array_map(function ($x) {
            (new Dumper)->dump($x);
        }, func_get_args());
    }
}

