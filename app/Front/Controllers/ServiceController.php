<?php
/**
 * Created by PhpStorm.
 * User: el_an
 * Date: 2017/5/19 0019
 * Time: 18:18
 */

namespace Phasty\Front\Controllers;


use Phalcon\Mvc\Controller;

class ServiceController extends Controller {

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
                    'first_name'=>$user_info['first_name'],
                    'last_name'=>$user_info['last_name'],
                    'registered'=>1,
                    'user_id'=>$user_info['id'],
                ];
            }else{

            }

            die(json_encode($ret));
        }
    }

    public function TrackAction()
    {
        if ($this->request->isAjax()) {
            $this->view->disable();
            $ret=[
                'status'=>'200',
                'global_setting'=>null,
                'content'=>'',
                'msg'=>'track done'
            ];
            die(json_encode($ret));
        }

    }
} 