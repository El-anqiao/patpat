<?php namespace Phasty\Front\Forms;

use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;

class SignUpForm extends Form {

	public function initialize() {


		$first_name = new Text('first_name', ['class' => 'form-control', 'placeholder' => 'Name']);

        $first_name->addValidators(array(new PresenceOf(array('message' =>
			'<div class="alert alert-danger">First Name is required</div>'))));

		$this->add($first_name);
        //var_dump($first_name);die;
        $last_name = new Text('last_name', ['class' => 'form-control', 'placeholder' => 'Name']);

        $last_name->addValidators(array(new PresenceOf(array('message' =>
            '<div class="alert alert-danger">Last Name is required</div>'))));

        $this->add($last_name);

		//Email
		$email = new Text('email', ['class' => 'form-control', 'placeholder' => 'Email']);

		$email->addValidators(array(new PresenceOf(array('message' =>
			'<div class="alert alert-danger">Email address is required</div>')),
			new Email(['message' =>
				'<div class="alert alert-danger">Incorrect E-Mail Address</div>']),

		));

		$this->add($email);

		//Password
		$password = new Password('password', ['placeholder' => 'Password at least 6 simbols', 'class' => 'form-control']);

		$password->addValidators(array(
			new PresenceOf(array('message' => '<div class="alert alert-danger">Password field is required</div>'))
			//new StringLength(array('min' => 6, 'messageMinimum' =>'<div class="alert alert-danger">The password is too short. Minimum 6 characters</div>'))
			//new Confirmation(array('message' => '<div class="alert alert-danger">No match in the password fields</div>', 'with' =>
			//	'confirmPassword'))
            ));

		$this->add($password);

               //Confirm Password
               //$confirmPassword = new Password('confirmPassword', ['class' => 'form-control', 'placeholder' => 'Confirm Password']);

               //$confirmPassword->addValidators(array(new PresenceOf(array('message' =>
               //	'<div class="alert alert-danger">Поле подтверждения пароля обязательно</div>'))));

               //$this->add($confirmPassword);

               //Remember
               //$terms = new Check('terms', array('value' => 'yes', 'class' => 'checkbox'));

               //$terms->setLabel('You accept <a href="/pages/show/rules">rules?</a>');

               //$terms->addValidator(new Identical(array('value' => 'yes', 'message' =>
               //	'<div class="alert alert-danger">The terms of the agreement must be accepted</div>')));

               //$this->add($terms);

               //CSRF
               $csrf = new Hidden('csrf');

               $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' =>
                   '<div class="alert alert-danger">Please reload the page</div>')));

               $this->add($csrf);

               //Sign Up
               $this->add(new Submit('Join Now', array('class' => 'btn btn-success','id'=>'register_btn')));

	}

	/**
	 * @param string
	 * Prints messages for a specific element
	 */
	public function messages($name) {
		if ($this->hasMessagesFor($name)) {
			foreach ($this->getMessagesFor($name) as $message) {
				$this->flash->error($message);
			}
		}
	}

}
