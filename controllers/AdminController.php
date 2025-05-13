<?php

namespace app\controllers;
use Yii;
class AdminController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) {
            $this->redirect(['site/login']);
            return false;
        }
        return true;
 } 

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionOrder()
    {
        return $this->render('order');
    }
    public function actionStats()
    {
        // Получаем текущую дату
        $currentYear = date('Y');
        $currentMonth = date('m');
        
        // Данные за год
        $yearlyData = Order::find()
            ->select([
                'COUNT(*) as count',
                'MONTH(created_at) as month'
            ])
            ->where(['YEAR(created_at)' => $currentYear])
            ->groupBy('MONTH(created_at)')
            ->indexBy('month')
            ->asArray()
            ->all();
        
        // Подготавливаем данные для годового графика
        $yearlyLabels = [];
        $yearlyValues = [];
        $yearlyTotal = 0;
        
        for ($month = 1; $month <= 12; $month++) {
            $yearlyLabels[] = DateTime::createFromFormat('!m', $month)->format('F');
            $count = $yearlyData[$month]['count'] ?? 0;
            $yearlyValues[] = $count;
            $yearlyTotal += $count;
        }
        
        // Данные за текущий месяц
        $monthlyData = Order::find()
            ->select([
                'COUNT(*) as count',
                'DAY(created_at) as day'
            ])
            ->where([
                'YEAR(created_at)' => $currentYear,
                'MONTH(created_at)' => $currentMonth
            ])
            ->groupBy('DAY(created_at)')
            ->indexBy('day')
            ->asArray()
            ->all();
        
        // Подготавливаем данные для месячного графика
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $monthlyLabels = [];
        $monthlyValues = [];
        $monthlyTotal = 0;
        $monthlyRevenue = 0;
        
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $monthlyLabels[] = $day;
            $count = $monthlyData[$day]['count'] ?? 0;
            $monthlyValues[] = $count;
            $monthlyTotal += $count;
        }
        
        // Доход за месяц
        $monthlyRevenue = Order::find()
            ->where([
                'YEAR(created_at)' => $currentYear,
                'MONTH(created_at)' => $currentMonth,
                'status' => Order::STATUS_COMPLETED
            ])
            ->sum('total_amount') ?? 0;
        
        // Рост по сравнению с предыдущим месяцем
        $prevMonthTotal = Order::find()
            ->where([
                'YEAR(created_at)' => ($currentMonth == 1 ? $currentYear - 1 : $currentYear),
                'MONTH(created_at)' => ($currentMonth == 1 ? 12 : $currentMonth - 1)
            ])
            ->count();
        
        $growth = $prevMonthTotal > 0 
            ? ($monthlyTotal - $prevMonthTotal) / $prevMonthTotal 
            : ($monthlyTotal > 0 ? 1 : 0);
        
        return $this->render('stats', [
            'monthlyData' => [
                'labels' => $monthlyLabels,
                'values' => $monthlyValues,
                'total' => $monthlyTotal,
                'revenue' => $monthlyRevenue,
                'growth' => $growth
            ],
            'yearlyData' => [
                'labels' => $yearlyLabels,
                'values' => $yearlyValues,
                'total' => $yearlyTotal
            ]
        ]);
    }
}
