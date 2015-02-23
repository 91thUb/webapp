<?php

class UserController extends Controller
{
    public $functionName = 'User';
    
    public function actionTest()
    {
        if(isset($this->module)) 
            echo $this->module->getName();
        
//                echo $this->id;
//
//        // Action
//        echo $this->action->id;

        die;
    }
    
    public function actionIndex()
    {
         $this->redirect(array('user/login'));
    }

    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest)
        {
            $this->redirect(array('moduleManagement/index'));
        }

        $this->layout = 'login';
        $loginForm = new LoginForm();

        if (isset($_POST['LoginForm']))
        {
            $loginForm->attributes = $_POST['LoginForm'];
            if ($loginForm->validate() & $loginForm->login())
            {
                $this->redirect(array('moduleManagement/index'));
            }
        }

        $this->render('login', array(
            'model' => $loginForm,
        ));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(array('user/login'));
    }
}

?>
