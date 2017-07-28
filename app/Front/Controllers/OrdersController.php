<?php namespace Phasty\Front\Controllers;

use Omnipay\Omnipay;
use Omnipay\PaypalRest\Gateway;
use Omnipay\PaypalRest\Message\TokenResponse;
use Omnipay\PaypalRest\Message\TokenRequest;
use Braintree;
use Braintree\Configuration;

class OrdersController extends ControllerBase
{
    public function checkoutAction()
    {

       // $gateway->setClientId('AXF5VbHwAqW-F2_DDTDp0AOfbZgc5a7YIbaCWkRR3baaLBrJBRs27rCc8OiiD4GUyTZ4vXHMPmQ8jhAp');
        //$gateway->setSecret('EI5hzWDn4QGmMVfT2r17TS5VjtXAx-jh3tHnY8PCkSFPYRgac4Co5uIcgKWUjpCwZyzxhYHE14REwau_');
        Configuration::reset();
        Configuration::environment('sandbox');
        Configuration::merchantId('f5ns3r3rhb7dz6mq');
        Configuration::publicKey('2v4rqfcftzd74bv4');
        Configuration::privateKey('d444c58e773a99773a8fe8e3a955d865');

        $nonce = Braintree\Test\Nonces::$gatewayRejectedFraud;
        $cargs = array(
            'firstName' =>'aa',
            'lastName' => 'bb',
            'company' => 'cc',
            'email' => 'an@qq.com',);
//$cargs['paymentMethodNonce'] = $nonce;

     //   $cresult = Braintree\Customer::create($cargs);
      // $a= Braintree\CustomerGateway::create($cargs);

$this->view->setVars(['clientToken'=>Braintree\ClientToken::generate()
]);

    }

    public function t1Action()
    {
        Configuration::reset();
        Configuration::environment('sandbox');
        Configuration::merchantId('f5ns3r3rhb7dz6mq');
        Configuration::publicKey('2v4rqfcftzd74bv4');
        Configuration::privateKey('d444c58e773a99773a8fe8e3a955d865');

        $nonce = $_GET["nounce"];
        $result = Braintree\Transaction::sale(array(
            'amount' => '1.10',
            'paymentMethodNonce' => $nonce,
            'options' => array(
                'submitForSettlement' => True
            )
        ));

        echo 't1';
        die;
    }

    public function t2Action()
    {
        echo 't2';
        die;
    }

}