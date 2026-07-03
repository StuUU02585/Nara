<?php

class CI_Controller
{
    public static $instance;
    public $load;
    public $input;
    public $session;
    public $db;

    public function __construct()
    {
        self::$instance = $this;
        $this->load = new CI_Loader($this);
        $this->input = new CI_Input();
        $this->session = new CI_Session();
    }
}
