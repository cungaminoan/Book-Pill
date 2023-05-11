<?php

namespace App\Service\Repository\Eloquent;

use App\Models\Order;
use App\Service\Repository\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{

    private Order $order;

    /**
     */
    public function __construct()
    {
        $this->order = new Order();
    }


    public function createOrder($idUser, $orderInfo, $address, $priceOrder)
    {
        try {
            return $this->order->insert(array(
                array(
                    'id_user' => $idUser,
                    'order_info' => $orderInfo,
                    'price_order' => $priceOrder,
                    'address' => $address,
                    'status_order' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                )
            ));
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getOrderByIDUser($idUser)
    {
        try {
            return $this->order->where(function ($query) use ($idUser) {
                $query->where('id_user', $idUser)
                    ->where('status_order', 1);
            })->orderBy('created_at', 'DESC')->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getOrderList($searchKey)
    {
        try {
            if($searchKey == '%%') {
                return $this->order->orderBy('status_order')->orderBy('created_at', 'DESC')->paginate(10);
            }
            return $this->order->join('users', 'users.id' , '=', 'order.id_user')
                ->where('users.username', 'LIKE', $searchKey)
                ->orderBy('order.status_order')->orderBy('order.created_at', 'DESC')->paginate(10);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getOrderByID($idOrder)
    {
        try {
            return $this->order->where('id', $idOrder)->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateStatusOrder($idOrder, $statusOrder)
    {
        try {
            $this->order->where('id', $idOrder)->update(array(
                 'status_order' => $statusOrder
            ));

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getPurchaserUser($idUser)
    {
        try {
            return $this->order->where(function ($query) use ($idUser) {
                $query->where('id_user', $idUser)
                    ->where('status_order', '<>' ,1);
            })->orderBy('updated_at', 'DESC')->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateOrder($idOrder, $orderInfo)
    {
        try {
            $this->order->where('id', $idOrder)->update(array(
                'order_info' => $orderInfo
            ));

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function statisticalProduct($month, $year)
    {
        try {
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
            return DB::select('
                SELECT SUM(price_order) as price, DAY(updated_at) as statistical_day FROM `order`
                WHERE status_order = 2 AND MONTH(updated_at) = ' . $month .  ' AND YEAR(updated_at) = ' . $year . '
                GROUP BY cast(updated_at as date)');
        } catch (\Exception $e) {
            return false;
        }
    }

    public function statisticalOrderInfo($month, $year)
    {
        try {
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
            return DB::select('
                SELECT order_info FROM `order`
                WHERE status_order = 2 AND MONTH(updated_at) = ' . $month .  ' AND YEAR(updated_at) = ' . $year);
        } catch (\Exception $e) {
            return false;
        }
    }
}
