<?php
namespace Phasty\Front\Controllers;

use Phalcon\Commander\CommanderTrait;
use Phasty\Common\Commands\RegisterUserCommand;
use Phasty\Common\Commands\ConfirmUserEmailCommand;
use Phasty\Common\Commands\ForgotPasswordCommand;
use Phasty\Common\Commands\ResetPasswordCommand;
use Phasty\Front\Forms\LoginForm,
    Phasty\Front\Forms\SignUpForm,
    Phasty\Front\Forms\ForgotPasswordForm;

class SessionController extends ControllerBase
{
    use CommanderTrait;
    protected $loginForm;
    protected $signUpForm;
    protected $forgotPasswordForm;

    public function initialize()
    {
        $this->loginForm = new LoginForm();
        $this->signUpForm = new SignUpForm();
        $this->forgotPasswordForm = new ForgotPasswordForm();
        parent::initialize();
    }

    public function indexAction()
    {
        return $this->dispatcher->forward(['action' => 'login']);
    }

    public function signUpAction()
    {
        $this->assets->addCss('/assets/css/auth.min-355872eb0c.css');
        if ($this->session->has('auth')) {
            return $this->response->redirect('index');
        }

        $this->tag->appendTitle(" - Sign Up");

        if ($this->request->isPost() && $this->signUpForm->isValid($this->request->getPost())) {
            $this->execute(RegisterUserCommand::class, $this->request->getPost());
            header('Content-Type: application/json');
            $re=array('status'=>true);
            die(json_encode($re));
            //$this->response->redirect('/login');
        }
        $this->view->form = $this->signUpForm;
        $this->view->breadcrumbs = array('Signing Up');
    }

    /**
     * Confirms an e-mail, if the user must change its password then changes it
     * @param $code
     * @param $email
     * @return mixed
     */
    public function confirmEmailAction($code, $email)
    {
        $this->execute(ConfirmUserEmailCommand::class, ['code' => $code, 'email' => $email]);

        return $this->response->redirect("index");

    }

    /**
     * Starts a session in the admin backend
     */
    public function loginAction()
    {
        $this->assets->addCss('/assets/css/auth.min-355872eb0c.css');
        if ($this->session->has('auth')) {
            return $this->response->redirect('index');
        }

        if ($this->auth->hasRememberMe()) {
            return $this->auth->loginWithRememberMe();
        }

        $this->tag->appendTitle(" - Login page");

        if ($this->request->isPost() && $this->loginForm->isValid($this->request->getPost())) {
            $this->auth->check([
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'remember' => $this->request->getPost('remember')
            ]);
        }

        $this->view->form = $this->loginForm;
        $this->view->breadcrumbs = ["login"];
    }

    /**
     * Shows the forgot password form
     */
    public function forgotPasswordAction()
    {
        $this->tag->appendTitle(" - Remind password");

        if ($this->request->isPost() && $this->forgotPasswordForm->isValid($this->request->getPost())) {
            $this->execute(ForgotPasswordCommand::class, $this->request->getPost());
            header('Content-Type: application/json');
            $re=array('status'=>true);
            die(json_encode($re));
            //$this->response->redirect('session/login');
        }

        $this->view->form = $this->forgotPasswordForm;
        //$this->view->breadcrumbs = array('Password recovery');
    }

    public function resetPasswordAction()
    {
        if ($this->request->isPost()){
        $this->execute(ResetPasswordCommand::class, ['code' =>$this->request->getPost('verify_code') , 'email' => $this->request->getPost('email'),
            'password'=>$this->request->getPost('password')]);
            // 将流转发到index动作
           /* $this->profile->user->password = $this->security->hash($this->request->getPost('password'));
            $this->profile->user->mustChangePassword = 'N';

            $passwordChange = new PasswordChanges();
            $passwordChange->usersId = $this->profile->user_id;
            $passwordChange->ipAddress = $this->request->getClientAddress();
            $passwordChange->userAgent = $this->request->getUserAgent();
*/
            header('Content-Type: application/json');
            $re=array('status'=>true);
            die(json_encode($re));
            // return $this->response->redirect("profile/index/changePassword");

        }
    }

    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();

        return $this->response->redirect('login');
    }

    /**
     * 注册成功给客户发送邮件
     */
    public function ecommerceStoresCustomersAction()
    {
        if ($this->request->isPost() && $this->signUpForm->isValid($this->request->getPost()) && $this->request->isAjax()) {
           // $this->execute(RegisterUserCommand::class, $this->request->getPost());
            //$this->execute(ConfirmUserEmailCommand::class, ['code' => $code, 'email' => $email]);
            header('Content-Type: application/json');
            die(json_encode(array('status'=>200)));
            //$this->response->redirect('/login');
        }
    }

}