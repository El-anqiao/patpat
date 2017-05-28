<?php namespace Phasty\Common\Commands;

class RegisterUserCommand {

    public $first_name;

    public $last_name;

    public $email;

    public $password;

    public $name;

    function __construct($first_name,$last_name, $email, $password)
    {
        $this->name = $first_name;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
    }

} 