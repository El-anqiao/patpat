<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->product = Product::find()->toArray();
        //var_dump($this->view->product);die;
    }

}

