<?php namespace Phasty\Admin\Controllers;

use Phasty\Common\Repo\Products\ProductsRepo;
use Phalcon\Http\Response;
use Phasty\Common\Service\Form\ProductsForm;

class ProductsController extends ControllerBase
{

    protected $repo;
    protected $form;

    public function initialize()
    {
        $this->repo = new ProductsRepo();
        $this->form = new ProductsForm();
    }
}
