<?php

class CI_Input
{
    public function post($key = null, $xss_clean = false)
    {
        if ($key === null) {
            return $_POST;
        }

        return $_POST[$key] ?? null;
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD'] ?? 'get');
    }
}
