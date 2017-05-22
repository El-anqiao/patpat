<?php namespace Phasty\Common\Commands;

class RegisterUserCommand {

    public $first_name;

    public $last_name;

    public $email;

    public $password;

    function __construct($name, $email, $password)
    {
        $this->first_name = $name;
        $this->last_name = $name;
        $this->email = $email;
        $this->password = $password;
    }

} 