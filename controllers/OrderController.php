<?php

namespace app\controllers;
use app\models\Order;
use app\models\Cart;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->isAdmin()) {
            $this->markNotificationsAsRead();
        }
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->identity->isAdmin()) {
            $this->markNotificationAsRead($id);
        }

        $carts=Cart::find()->where(['order_id'=>$id])->all();
        if (count($carts)==0||(!Yii::$app->user->identity->isAdmin() && $carts[0]->user_id != Yii::$app->user->identity->id)) return $this->goHome();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user = Yii::$app->user->identity;
        $model = new Order();
        
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->load(Yii::$app->request->post());
                $model->user_id = $user->id;
                $model->date = date('Y-m-d H:i:s');
                
                if (!$model->save()) {
                    throw new \Exception(json_encode($model->errors));
                }
                
                // Привязка товаров из корзины к заказу
                $cartItems = Cart::find()->where(['user_id' => $user->id, 'order_id' => null])->all();
                foreach ($cartItems as $cartItem) {
                    $cartItem->order_id = $model->id;
                    if (!$cartItem->save()) {
                        throw new \Exception(json_encode($cartItem->errors));
                    }
                }
                
                $this->createAdminNotification($model->id);
                $transaction->commit();

                
                Yii::$app->session->setFlash('success', 'Заказ успешно оформлен.');
                return $this->redirect(['order/view', 'id' => $model->id]);
                
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error($e->getMessage());
                Yii::$app->session->setFlash('error', 'Ошибка при оформлении заказа: ' . $e->getMessage());
                return $this->redirect(['cart/index']);
            }
        }
    
        return $this->redirect(['cart/index']);
    }
    
    protected function createAdminNotification($orderId)
    {
        $notification = new \app\models\Notification();
        $notification->type = 'new_order';
        $notification->key = 'order_' . $orderId;
        $notification->message = 'Новый заказ #' . $orderId;
        $notification->read = 0;
        
        if (!$notification->save()) {
            Yii::error('Ошибка создания уведомления: ' . print_r($notification->errors, true));
        }
    }
    protected function markNotificationsAsRead()
    {
        \app\models\Notification::updateAll(
            ['read' => 1],
            ['type' => 'new_order', 'read' => 0]
        );
    }
    protected function markNotificationAsRead($orderId)
    {
        \app\models\Notification::updateAll(
            ['read' => 1],
            ['type' => 'new_order', 'key' => 'order_' . $orderId]
        );
    }
    private function prepareChartData($diagnostics)
    {
        // Если есть данные за 2025 год
        if ($diagnostics['orders_2025_count'] > 0) {
            return Order::getMonthlyStats();
        }
        
        // Иначе возвращаем тестовые данные
        return [
            'labels' => ['Январь','Февраль','Март','Апрель','Май','Июнь',
                        'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            'values' => [0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        ];
    }
    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionOrder()
    {
        
        return $this->render('order');
    }
    public function actionStats()
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) {
            throw new \yii\web\ForbiddenHttpException('Доступ только для администраторов');
        }
    
        $orderStats = Order::getMonthlyStats();
        $revenueStats = Order::getMonthlyRevenueStats();
        
        return $this->render('stats', [
            'labels' => $orderStats['labels'],
            'values' => $orderStats['values'],
            'netRevenue' => $revenueStats['netValues']
        ]);
    }
    

}
