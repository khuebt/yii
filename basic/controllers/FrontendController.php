<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;


class FrontendController extends Controller {

    public function actionIndex() {
        $query1 = Product::find();

//        dd($query1->count());
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query1->count(),
        ]);

//        dd($pagination->offset);
        
        $products = $query1->orderBy('product_name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        $category = Category::showCategory();


        return $this->render('index', [
                    'product' => $products,
                    'category' => $category,
                    'pagination' => $pagination,
        ]);
    }

    public function actionDetail($product_id) {
        $model = Product::findModel($product_id);
        return $this->render('detail', [
                    'model' => $model,
        ]);
    }

    public function actionViewCategory() {
        $page = Yii::$app->getRequest()->getQueryParam('page');
        $cateQueryArr = Product::getCategoryArr();
//        dd($cateQueryArr);
        $products = Product::getProductsInCate([
            'listCategories' => $cateQueryArr,
            'limit' => 4,
            'page' => $page,
            
            ]);  
        //dd($products);
        $count =  Product::countProduct();
        $categories = Category::showCategory();
//         dd(count($products));
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $count,
        ]);
//        dd(count($products));
        return $this->render('view-category',[
                    //'cate'=>$model,
                    'categories' => $categories,                    
                    //'parents' => $parents,
                   // 'cateQueryArr' => $cateQueryArr,
                    'products'=>$products,
                    'pagination' => $pagination,
                     
        ]);
    }
}
