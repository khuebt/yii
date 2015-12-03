<?php 
namespace app\controllers;
use Yii;
use yii\web\Controller;

class NewsController extends Controller
{
    public function actionIndex()
    {
        echo "Đây là trang tin tức- được tạo bới Controller có id là News, tức NewsController, với action Index";
    }
    public function actionDanhsach()
    {
        return $this->render('Danhsach');
    }
            
}
?>