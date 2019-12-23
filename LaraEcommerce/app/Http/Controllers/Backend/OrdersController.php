<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Order;
use PDF;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // display all orders
    public function index()
    {
    	$orders = Order::orderBy('id','desc')->get();
    	return view('Backend.pages.order.index',compact('orders'));
    }
    // display orders by their id
    public function show($id){
        $order = Order::find($id);
        $order->is_seen_by_admin = 1;
        $order->save();  
        return view('Backend.pages.order.show',compact('order'));
    }
    // action for complete order
    public function completed($id){
        $order = Order::find($id);

        if($order->is_completed){
            $order->is_completed = 0;
        }else{
            $order->is_completed = 1;
        }
        $order->save(); 
        session()->flash('success','Order complete status changed !!');
        return back();
    }
    // action for paid order
    public function paid($id){
        $order = Order::find($id);

        if($order->is_paid){
            $order->is_paid = 0;
        }else{
            $order->is_paid = 1;
        }
        $order->save();
        session()->flash('success','Order complete status changed !!');
        return back();

    }

        // action for charge
        public function chargeUpdate(Request $request,$id){
            $order = Order::find($id);
            
            $order->shipping_charge = $request->shipping_charge;
            $order->customer_discount = $request->customer_discount;

            $order->save(); 
            session()->flash('success','Order charge and discount has changed !!');
            return back();
        }

        // action for pdf generate
        public function generateInvoice($id){
            $order = Order::find($id);
           // return view('Backend.pages.order.invoice',compact('order'));
            $pdf = PDF::loadView('Backend.pages.order.invoice', compact('order'));

            return $pdf->stream('invoice.pdf');
            //return $pdf->download('invoice.pdf');

        }
}
