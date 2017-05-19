<?php
/**
 * Created by PhpStorm.
 * User: el_an
 * Date: 2017/5/19 0019
 * Time: 18:18
 */

namespace Phasty\Front\Controllers;


class ServiceController extends ControllerBase {

    /**
     * 获取有关用户的信息，用于头部
     */
    public function GetUserNavigationDataAction()
    {
        if ($this->request->isAjax()) {
            $this->view->disable();
            $ret=[
                'status'=>'true',
                'registered'=>0,
                'content'=>[
                    'unreadNotificationCount'=>0,
                    'points'=>0,
                    'invalidItemCount'=>0,
                    'cartItemsCount'=>0,
                    'check_in_history'=>[],
                    'currentUserInfo'=>[]
                    ],
            ];
            $ret['status']=true;
            //用户登录
            if($this->session->has('auth')){
                $user_info=$this->session->get('auth');
                $ret['registered']=1;
                $ret['content']['currentUserInfo']=[
                    'avatar'=>'',
                    'email'=>$user_info['email'],
                    'first_name'=>$user_info['name'],
                    'last_name'=>'',
                    'registered'=>1,
                    'user_id'=>$user_info['id'],
                ];
            }else{

            }

            die(json_encode($ret));

            $id = $this->request->getPost('productId', 'int');
            $quantity = $this->request->getPost('quantity', 'int', 1);
            $model = Products::findFirstById($id);
            $discount = [];
            foreach ($model->brand->discount as $value) {
                if (isset($value->name) && isset($value->sum)) {
                    $discount = $value->toArray();
                    break;
                }
            }
            //if discount for category has been set, discount for brand will be owerwriten
            foreach ($model->category->discount as $value) {
                if (isset($value->name) && isset($value->sum)) {
                    $discount = $value->toArray();
                    break;
                }
            }
            if ($model) {
                $model->saveCounter('cart');

                $this->cart->insert([
                    'id' => $model->id,
                    'name' => $model->name,
                    'price' => $model->price,
                    'quantity' => $quantity,
                    'sku' => $model->sku,
                    'currency' => $this->session->has('currency') ? $this->session->get('currency') : $this->config->app->currency,
                    'options' => [
                        'image' => $model->getImages(),
                        'discount' => $discount,
                        'slug' => $model->slug
                    ]
                ]);
                echo 'success';
            }
        }
    }
} 