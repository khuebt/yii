<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
class MyAuthenticationController extends Controller
{
    public function actionLogin()
    {  
        $error = null;
        
        $username = Yii::$app->request->post('username', null);
        $password = Yii::$app->request->post('password', null);
        
        $user = User::findOne(['username' => $username]);
        
        if(($username!=null)&&($password!=null))
        {
            if($user != null)
            {
                if($user->validatePassword($password))
                {
                    Yii::$app->user->login($user);
                }
                else {
                    $error = 'Password validation failed!';
                }
            }
            else
            {
                $error = 'User not found';
            }
        }
        
        return $this->render('login', ['error' => $error]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }
    
}