<?php


use Symfony\Component\VarDumper\VarDumper;
use Tightenco\Collect\Support\Collection;

if (!function_exists('dump')) {
    function dump($var, ...$moreVars)
    {
        VarDumper::dump($var);

        foreach ($moreVars as $v) {
            VarDumper::dump($v);
        }

        if (1 < func_num_args()) {
            return func_get_args();
        }

        return $var;
    }
}

if (!function_exists('dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }

        die(1);
    }
}


if (!function_exists('output_buffer_contents')) {
    function output_buffer_contents($function, $args = array())
    {
        ob_start();
        $function($args);
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
}

if (!function_exists('collection')) {
    function collection($var)
    {
        return new Collection($var);
    }
}
