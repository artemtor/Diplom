<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\CartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use Yii;
use yii\web\Response;
/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cart models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Получаем только товары текущего пользователя
         // Создаем запрос и сохраняем его в переменную
    $query = Cart::find()->where(['user_id' => Yii::$app->user->id, 'order_id' => null]);
    
    // Создаем dataProvider с этим запросом
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);
        // Вычисляем общую стоимость
        $totalPrice = 0;
        foreach ($query->all() as $item) {
            $totalPrice += $item->product->price * $item->count;
        }
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'totalPrice' => $totalPrice,
        ]);
    }
    public function actionAdd($product_id, $value = 1) {
        $product = Product::findOne($product_id);
        if ($product === null) {
            Yii::$app->session->setFlash('error', 'Товар не найден.');
            return $this->redirect(['/product/catalog']);
        }
    
        $query = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['product_id' => $product_id])->andWhere(['order_id' => null]);
        if ($query->count() > 0) {
            $item = $query->one();
        } else {
            $item = new Cart();
            $item->user_id = Yii::$app->user->identity->id;
            $item->product_id = $product_id;
        }
        $item->count += $value;
    
        if ($item->save()) {
            Yii::$app->session->setFlash('success', 'Товар добавлен в корзину.');
        } else {
            Yii::$app->session->setFlash('error', 'Не удалось добавить товар в корзину.');
        }
    
        return $this->redirect(['/product/catalog']);
    }

    
    public function actionAddd($productId)
    {
        $product = Product::findOne($productId);
        $cart = Cart::find()->where(['product_id' => $productId, 'user_id' => Yii::$app->user->id])->one();
        if ($cart) {
            $cart->count += 1;
        } else {
            $cart = new Cart();
            $cart->product_id = $productId;
            $cart->user_id = Yii::$app->user->id;
            $cart->count = 1;
        }
 
        if ($cart->save()) {
            Yii::$app->session->setFlash('success', 'Товар добавлен в корзину.');
        } else {
            Yii::$app->session->setFlash('error', 'Не удалось добавить товар в корзину.');
        }
        return $this->redirect(['cart/index']);
    }



    public function actionRemove($productId)
    {
        $cart = Cart::find()->where(['product_id' => $productId, 'user_id' => Yii::$app->user->id])->one();
        if ($cart) {
            if ($cart->count > 1) {
                $cart->count -= 1;
                $cart->save();
            } else {
                $cart->delete();
            }
            Yii::$app->session->setFlash('success', 'Товар удален из корзины.');
        } else {
            Yii::$app->session->setFlash('error', 'Товар не найден в корзине.');
        }

        return $this->redirect(['cart/index']);
    }
    public function beforeAction($action)
    {
    if ((Yii::$app->user->isGuest) || (Yii::$app->user->identity->isAdmin())){
    $this->redirect(['site/login']);
    return false;
    } else return true;
    } 
    /**
     * Displays a single Cart model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cart();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $id = Yii::$app->request->post('id');
        $count = Yii::$app->request->post('count');
        
        $model = Cart::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        
        if ($model) {
            $model->count = $count;
            if ($model->save()) {
                return ['success' => true];
            }
        }
        
        return ['success' => false, 'message' => 'Товар не найден'];
    }
    /**
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $id = Yii::$app->request->post('id');
        $model = Cart::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        
        if ($model && $model->delete()) {
            return ['success' => true];
        }
        
        return ['success' => false, 'message' => 'Ошибка удаления'];
    }
    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
