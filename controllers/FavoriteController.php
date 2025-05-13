<?php 
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class FavoriteController extends Controller
{
    public function actionToggle()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $productId = Yii::$app->request->post('productId');
        if (!$productId) {
            return ['success' => false, 'message' => 'Product ID is required'];
        }
        
        $user = Yii::$app->user->identity;
        
        if ($user && $user->isFavorite($productId)) {
            $user->removeFavorite($productId);
            return ['success' => true, 'status' => 'removed'];
        } elseif ($user) {
            $user->addFavorite($productId);
            return ['success' => true, 'status' => 'added'];
        } elseif (Yii::$app->user->isGuest) {
            $favorites = Yii::$app->session->get('favorites', []);
            if (in_array($productId, $favorites)) {
                $key = array_search($productId, $favorites);
                unset($favorites[$key]);
                Yii::$app->session->set('favorites', array_values($favorites));
                return ['success' => true, 'status' => 'removed'];
            } else {
                $favorites[] = $productId;
                Yii::$app->session->set('favorites', $favorites);
                return ['success' => true, 'status' => 'added'];
            }
        }
        
        return ['success' => false, 'message' => 'Ошибка'];
    }
}