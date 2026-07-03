<?php

class CI_Loader
{
    private $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function database()
    {
        $this->controller->db = CI_DB::connect();
        return $this->controller->db;
    }

    public function model($model, $alias = null)
    {
        require_once APPPATH . 'models/' . $model . '.php';
        $name = $alias ?: $model;
        $this->controller->{$name} = new $model();
    }

    public function helper($helpers)
    {
        foreach ((array) $helpers as $helper) {
            $path = BASEPATH . 'helpers/' . $helper . '_helper.php';
            if (is_file($path)) {
                require_once $path;
            }
        }
    }

    public function view($view, $data = [], $return = false)
    {
        $file = VIEWPATH . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
        if (!is_file($file)) {
            throw new RuntimeException('View not found: ' . $view);
        }

        ob_start();
        $renderer = function () use ($file, $data) {
            extract($data, EXTR_SKIP);
            require $file;
        };
        $renderer->call($this->controller);
        $output = ob_get_clean();
        $output = $this->inject_csrf_fields($output);

        if ($return) {
            return $output;
        }

        echo $output;
    }

    private function inject_csrf_fields($output)
    {
        if (stripos($output, '<form') === false) {
            return $output;
        }

        $token = html_escape($this->controller->session->csrf_token());
        return preg_replace_callback(
            '/<form\b[^>]*\bmethod\s*=\s*(["\'])post\1[^>]*>(?!\s*<input[^>]+name\s*=\s*(["\'])_csrf\2)/i',
            function ($match) use ($token) {
                return $match[0] . '<input type="hidden" name="_csrf" value="' . $token . '">';
            },
            $output
        );
    }
}
