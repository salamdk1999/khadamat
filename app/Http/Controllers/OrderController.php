<?php

namespace App\Http\Controllers;

use App\Attachments_order;
use App\orders;
use App\sections;
use Illuminate\Http\Request;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Exports\ordersExport;
use App\Notifications\CustomerDeleteOrder;
use App\services;
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\CustomerOrder;
use App\Notifications\CustomerOrderUpdate;
use App\Notifications\ProviderOrder;
use App\Notifications\ProviderRejectOrder;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
           ///////Admin orders///////////
    public function Fullfilled_Orders()
    {
    $orders=orders::with('service')->where('Value_OrderStatus',1)->get();
    return view('orders.Fullfilled_Orders',compact('orders'));
    }
        public function All_Orders()
        {
            $orders = orders::all();
            $sections = sections::all();
            return view('orders.orders', compact('orders','sections'));
        }
        public function Partially_Fullfilled_Orders()
        {
        $orders=orders::where('Value_OrderStatus',3)->get();
        return view('orders.Partially_Fullfilled_Orders',compact('orders'));
        }

        public function UnFullfilled_Orders()
        {
        $orders=orders::where('Value_OrderStatus',2)->get();
        return view('orders.UnFullfilled_Orders',compact('orders'));
        }

        public function show($id)
        {
        $order = orders::where('id',$id)->first();
        $attachments  = Attachments_order::where('order_id',$id)->get();
        return view('orders.details_order',compact('attachments','order'));
        }



        public function export()
        {
            return Excel::download(new OrdersExport, 'orders.xlsx');
        }

///////////////////////customer///////////////////

    public function index()
    {
        return view('orders.user_create_orders');
    }

    public function index2()
    {
        $orders1=orders::with(array('service' => function($query) {
            $query->withTrashed();
        }))->where(['Value_OrderStatus'=>1,
        'user'=>Auth::user()->name])
        ->get();

        $orders2=orders::with(array('service' => function($query) {
            $query->withTrashed();
        }))->where(['Value_OrderStatus'=>3,
        'user'=>Auth::user()->name])
        ->get();

        $orders3=orders::with(array('service' => function($query) {
            $query->withTrashed();
        }))->where(['Value_OrderStatus'=>2,
        'user'=>Auth::user()->name])
        ->get();

        return view('orders.customer_order',compact('orders1','orders2','orders3'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $services=services::where('id',$id)->first();
        return view('orders.user_create_orders',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    if($request->provider_id == (Auth::user()->id)){
            session()->flash('eror', 'لا يمكنك شراء خدمة تقدمها أنت ');
            return back();
    }else{

        $uuid = Str::uuid()->toString();
        orders::create([
            'order_number' => $uuid,
            'order_Date' => $request->order_Date,
            'Due_Date' => $request->Due_Date,
            'service_id' => $request->service_id,
            'section_id' => $request->section_id,
            'Amount_collection' => $request->service_price,
            'OrderStatus' => 'غير منفذ',
            'Value_OrderStatus' => 2,
            'PaymentStatus' => 'غير مدفوع',
            'Value_PaymentStatus' => 2,
            'user' => (Auth::user()->name),
            'note' => $request->note,
            'user_id'=>(Auth::user()->id),
        ]);

        if ($request->hasFile('file_name')) {
            $this->validate($request, [

                'file_name' => 'mimes:pdf,jpeg,png,jpg',

                ], [
                    'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
                ]);
            $custmer_files= $request->file_name;
            $file_names = $custmer_files->getClientOriginalName();
            $order_id = orders::latest()->first()->id;
            $order_number = orders::latest()->first()->order_number;
            Attachments_order::create([
            'file_name'=> $file_names,
            'order_number' =>  $order_number,
            'Created_by' => (Auth::user()->name),
            'order_id' => $order_id,
            ]);

            // move pic
            $custmer_files->move(public_path('Attachments/' . $order_number),$file_names);
        }
        $user = User::where('id',$request->provider_id)->first(); //اليوزر يلي رح يصلو الاشعار بانو في زبون طلب خدمتو
        $orders=orders::latest()->first();
        $user->notify(new CustomerOrder($orders));
        session()->flash('Add', 'تم اضافة الطلب بنجاح');
        return redirect('/customer_order');

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $orders=orders::findOrFail($request->order_id);
        if ($request->hasFile('file_name')) {
            $this->validate($request, [

                'file_name' => 'mimes:pdf,jpeg,png,jpg',

                ], [
                    'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
                ]);
            $custmer_files= $request->file_name;
            $file_names = $custmer_files->getClientOriginalName();
            $order_id =$request->order_id;
            $order_number = $request->order_number;
            Attachments_order::create([
            'file_name'=> $file_names,
            'order_number' =>  $order_number,
            'Created_by' => (Auth::user()->name),
            'order_id' => $order_id,
            ]);


            // move pic
            $custmer_files->move(public_path('Attachments/' . $order_number),$file_names);
        }

        if($request->valu_PaymentStatus ==1) {
            $PaymentStatus ="مدفوع";
        }elseif($request->valu_PaymentStatus ==3){
            $PaymentStatus ="مدفوع جزئيا";
        }
        $orders->update([
            'Value_PaymentStatus'=>$request->valu_PaymentStatus,
            'note'=>$request->note,
            'PaymentStatus'=>$PaymentStatus,
            'Payment_Date'=>$request->Payment_Date,
        ]);
        $service_id=$orders->service_id;
        $service=services::where('id',$service_id)->first();
        $userProvider=$service->service_provider_id;
        $user= User::where('id',$userProvider)->first();
        $user->notify(new CustomerOrderUpdate($orders));
        session()->flash('update', 'تم تعديل طلبك بنجاح ');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $order=orders::withTrashed()->findOrFail($request->order_id);
        $attachments=Attachments_order::where('order_id',$request->order_id)->first();
        $id_page =$request->id_page;
        if (!$id_page==2) {
            if (!empty($attachments->order_number)) {
                Storage::disk('public_uploads')->deleteDirectory($attachments->order_number);
            }
            if(Auth::user()->roles_name == ["provider"]){
                $user= User::where('id',$order->user_id)->first();
                $user->notify(new ProviderRejectOrder($order));
            }else{
                $service_id=$order->service_id;
                $service=services::where('id',$service_id)->first();
                $userProvider=$service->service_provider_id;
                $user= User::where('id',$userProvider)->first();
                $user->notify(new CustomerDeleteOrder($order));
            }
            $order->delete();
            session()->flash('delete', 'تم إلغاء الطلب بنجاح');
            return back();
        }else{
            $order->delete();
            session()->flash('archive_order');
            return back();
        }
    }

    public function viewFile($id){
        $attachments=Attachments_order::where(['order_id'=>$id])->get();
        return view ('orders.customer_attachment',compact('attachments'));
    }

    public function open_file($order_number,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($order_number.'/'.$file_name);
        return response()->file($files);
    }
    public function download_file($order_number,$file_name)
    {
        $down = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($order_number.'/'.$file_name);
        return response()->download($down);
    }

    /////////////////////////////provider orders////////////////

    public function index_provider()
    {
        $user=Auth::user();
        $id = $user -> id;
        $orders = orders::with(array('service' => function($query) {
            $query->withTrashed();
        })) ->whereHas('service', function ($q) use ($id) { $q->where('service_provider_id',$id); })->get();
        $sections = sections::all();
        return view('orders.provider_orders', compact('orders','sections'));
    }

    public function status_show($id)
    {
        $orders=orders::where('id',$id)->first();
        return view('orders.provider_update_status',compact('orders'));
    }

    public function status_update($id ,Request $request)
    {
        $orders = orders::findOrFail($id);
        if ($request->OrderStatus === 'منفذ') {
            $orders->update([
                'Value_OrderStatus' => 1,
                'OrderStatus' => $request->OrderStatus,
            ]);
        }
        else {
            $orders->update([
                'Value_OrderStatus' => 3,
                'OrderStatus' => $request->OrderStatus,
            ]);
        }
        $user = User::where('id',$orders->user_id)->first(); //الزبون يلي رح يصلو الاشعار بانو مقدم الخدمة عدل الطلب
        $user->notify(new ProviderOrder($orders));
        return redirect('/providerOrders')->with(['status_update'=>'تم تحديث حالة الطلب بنجاح']);;
    }

    public function show_provider($id)
    {
        $order = orders::where('id',$id)->withTrashed()->first(); //مشان الاشعارات بس حدا من الطرفين يرفض الطلب يعني انحذف اقدر جيب معلومات الطلب
        $attachments  = Attachments_order::where('order_id',$id)->get();
        $notification_id = DB::table('notifications')->where('data->id',$id)->pluck('id'); //جبت ايدي الاشعار
        DB::table('notifications')->where('id',$notification_id)->update(['read_at'=>now()]);
        return view('orders.provider_details_order',compact('attachments','order'));
    }


    public function destroyfile(Request $request)
    {
        $order = Attachments_order::findOrFail($request->id_file);
        $order->delete();
        Storage::disk('public_uploads')->delete($request->order_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }


}
