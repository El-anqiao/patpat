<?php namespace Phasty\Front\Controllers;


class CheckoutController extends ControllerBase
{

    public function initialize()
    {
        if(!$this->cart->total()){
            $this->flash->notice('You have nothing in your basket');
            $this->dispatcher->forward([
                'controller' => 'catalog',
                'action' => 'index'
            ]);
        }
        parent::initialize();
        $this->tag->setTitle('Check out | Phasty');
    }


    public function indexAction()
    {

    }
}