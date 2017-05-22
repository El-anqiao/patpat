<?php
/**
 * Created by PhpStorm.
 * User: el_an
 * Date: 2017/5/22 0022
 * Time: 11:43
 */

namespace Phasty\Front\Controllers;


class TermsController extends ControllerBase {

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $this->tag->setTitle("Term of Service");

    }

    public function privacyAction()
    {
     $this->tag->setTitle("Privacy Policy");
    }

} 