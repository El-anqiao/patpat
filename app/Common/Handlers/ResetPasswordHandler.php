<?php namespace Phasty\Common\Handlers;

use Phalcon\Commander\CommandHandler;
use Phalcon\Mvc\User\Plugin;
use Phasty\Common\Models\ResetPasswords;
use Phasty\Common\Models\PasswordChanges;
use Phasty\Common\Models\Users;

class ResetPasswordHandler extends Plugin implements CommandHandler
{
    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    protected $profile;
    public function handle($command)
    {
        $resetPassword = ResetPasswords::findFirstByCode($command->code);

        if (!$resetPassword) {
            return $this->response->redirect('index');
        }

        if ($resetPassword->reset <> 'N') {
            return $this->dispatcher->forward(array(
                'controller' => 'session',
                'action' => 'login'
            ));
        }

        $resetPassword->reset = 'Y';

        /**
         * Change the confirmation to 'reset'
         */
        if (!$resetPassword->save()) {

            foreach ($resetPassword->getMessages() as $message) {
                $this->flashSession->error($message);
            }

            return $this->response->redirect('index');
        }else{

            $passwordChange = new PasswordChanges();
            $passwordChange->usersId = $resetPassword->usersId;
            $passwordChange->ipAddress = $this->request->getClientAddress();
            $passwordChange->userAgent = $this->request->getUserAgent();
            $passwordChange->save();


            $user=  Users::findFirstById($resetPassword->usersId);
            $user->password = $this->security->hash($command->password);
            $user->mustChangePassword = 'N';
            $user->update();
        }

        /**
         * Identity the user in the application
         */
        $this->auth->authUserById($resetPassword->usersId);

        //$this->flash->success('Please set new password');
    }

}