<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class MChartController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function getRevenueInYear()
    {
        $currentYear = '20' . date('y');
        $timestamp = strtotime(date('Y-m-d'));
        $maxMonth = idate('m', $timestamp);
        $revenue = array();

        for ($i = 1; $i <= $maxMonth; $i++) {
            array_push($revenue, [
                'month' => $i,
                'revenue' => Order::whereMonth('order_delivered_date', $i)
                    ->where(function ($query) use ($currentYear) {
                        return $query->whereYear('order_delivered_date', $currentYear);
                    })
                    ->sum('order_total_price')
            ]);
        }

        return response()->json($revenue);
    }

    public function getNewAccountsInYear()
    {
        $currentYear = '20' . date('y');
        $timestamp = strtotime(date('Y-m-d'));
        $maxMonth = idate('m', $timestamp);
        $new_users = array();

        for ($i = 1; $i <= $maxMonth; $i++) {
            array_push($new_users, [
                'month' => $i,
                'new_account' => User::whereMonth('created_at', $i)
                    ->where(function ($query) use ($currentYear) {
                        return $query->whereYear('created_at', $currentYear);
                    })
                    ->count()
            ]);
        }

        return response()->json($new_users);
    }

    public function getOrdersInYear()
    {
        $currentYear = '20' . date('y');
        $timestamp = strtotime(date('Y-m-d'));
        $maxMonth = idate('m', $timestamp);
        $counts = array();

        for ($i = 1; $i <= $maxMonth; $i++) {
            array_push($counts, [
                'month' => $i,
                'count' => Order::whereMonth('order_delivered_date', $i)
                    ->where(function ($query) use ($currentYear) {
                        return $query->whereYear('order_delivered_date', $currentYear);
                    })
                    ->count()
            ]);
        }
        return response()->json($counts);
    }

    public function getOrderReturnedRatioInYear()
    {
        $currentYear = '20' . date('y');
        $timestamp = strtotime(date('Y-m-d'));
        $maxMonth = idate('m', $timestamp);
        $counts = array();

        for ($i = 1; $i <= $maxMonth; $i++) {
            $countm = Order::whereMonth('order_delivering_date', $i)
                ->where(function ($query) use ($currentYear) {
                    return $query->whereYear('order_delivering_date', $currentYear);
                })
                ->count();
            if ($countm == 0)
                $countm = 1;
            array_push($counts, [
                'month' => $i,
                'count' => (float) Order::whereMonth('order_delivering_date', $i)
                    ->where(function ($query) use ($currentYear) {
                        return $query->whereYear('order_delivering_date', $currentYear);
                    })
                    ->where(function ($query) {
                        return $query->where('status_id', '=', 5);
                    })
                    ->count() / $countm * 100
            ]);
        }

        return response()->json($counts);
    }
}
