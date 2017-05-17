<?php namespace Phasty\Admin\Controllers;

use Phasty\Common\Repo\Currency\PhalconCurrency;
use Phasty\Common\Service\Form\CurrencyForm;

class CurrenciesController extends ControllerBase {

	protected $repo;
	protected $form;

    public function initialize() {
		$this->repo = new PhalconCurrency();
		$this->form = new CurrencyForm();
	}
}
