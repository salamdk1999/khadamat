<?php

namespace App\Http\Controllers;
use App\orders;
use App\services;
use App\User;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index()
    {
        return view('reports.orders_report');
    }

    public function index1()
    {
        $percent = 0.1;
        $query = orders::where([
            ['Value_PaymentStatus', '=', 1]
        ])->select(
            DB::raw("$percent* Amount_collection as amount"),
            "order_number",
            "order_Date",
            "Due_Date",
            "service_id",
            "section_id",
            "Amount_collection",
            "Amount_collection",
            "OrderStatus",
            "Value_OrderStatus",
            "PaymentStatus",
            "Value_PaymentStatus",
            "user",
            "note",
            "Payment_Date"
        );
        $allOrders = $query->get();
        $allOrdersArr = $allOrders->toArray();
        $total = 0;

        foreach ($allOrdersArr as $item) {
            $total += $item['amount'];
        }

        return view('reports.profits_report', compact('allOrders','total'));

    }


    public function index2()
    {
        $providers = User::select('*')->where('roles_name', '["provider"]')->get();
        return view('reports.customers_report', compact('providers'));
    }

    public function search_orders(Request $request)
    {

        $rdio = $request->rdio;

     // في حالة البحث بنوع حالة الدفع

        if ($rdio == 1) {

     // في حالة عدم تحديد تاريخ
            if ($request->type && $request->start_at =='' && $request->end_at =='') {

               $orders = orders::select('*')->where('OrderStatus','=',$request->type)->get();
               $type = $request->type;
               return view('reports.orders_report',compact('type'))->withDetails($orders);
            }

            // في حالة تحديد تاريخ تسليم
            else {

              $start_at = date($request->start_at);
              $end_at = date($request->end_at);
              $type = $request->type;
              $orders = orders::whereBetween('order_Date',[$start_at,$end_at])->where('OrderStatus','=',$request->type)->get();
              return view('reports.orders_report',compact('type','start_at','end_at'))->withDetails($orders);

            }



        }

        //====================================================================

        // في البحث برقم الفاتورة
        else {

        $orders = orders::select('*')->where('order_number','=',$request->order_number)->get();
        return view('reports.orders_report')->withDetails($orders);

        }

    }

    public function search_profits(Request $request)
    {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $percent = 0.1;
                $query = orders::where([
                    ['Value_PaymentStatus', '=', 1]
                ])
                ->whereBetween('order_Date',[$start_at,$end_at])
                ->select(
                    DB::raw("$percent* Amount_collection as amount"),
                    "order_number",
                    "order_Date",
                    "Due_Date",
                    "service_id",
                    "section_id",
                    "Amount_collection",
                    "Amount_collection",
                    "OrderStatus",
                    "Value_OrderStatus",
                    "PaymentStatus",
                    "Value_PaymentStatus",
                    "user",
                    "note",
                    "Payment_Date"
                );
                $allOrders = $query->get();
                $allOrdersArr = $allOrders->toArray();
                $total = 0;

                foreach ($allOrdersArr as $item) {
                    $total += $item['amount'];
                }
                return view('reports.profits_report', compact('allOrders','total'));
                return view('home', compact('total'));
    }


    public function search_customers(Request $request)
    {

        $id = $request->provider_id;
        $user = User::find($id);
        $percent = 0.9;
        $query = orders::with('service')
        ->whereHas('service', function ($q) use ($id) {
            $q->where('service_provider_id',$id);
        })
        ->where([
            ['Value_PaymentStatus', '=', 1]
        ])->select(
            DB::raw("$percent* Amount_collection as amount"),
            "order_number",
            "order_Date",
            "Due_Date",
            "service_id",
            "section_id",
            "Amount_collection",
            "OrderStatus",
            "Value_OrderStatus",
            "PaymentStatus",
            "Value_PaymentStatus",
            "note",
            "Payment_Date"
        );
        $allOrders = $query->get();
        $allOrdersArr = $allOrders->toArray();
        $total = 0;

        foreach ($allOrdersArr as $item) {
        $total += $item['amount'];
        }
        return view('reports.customers',compact('allOrders','total','user'));



    }
}




