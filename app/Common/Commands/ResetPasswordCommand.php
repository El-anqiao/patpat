<?php namespace Phasty\Common\Commands;

class ResetPasswordCommand {

    public $email;
    public $code;
    public $password;

    function __construct($email,$code,$password)
    {
        $this->email = $email;
        $this->code = $code;
        $this->password = $password;
    }

}