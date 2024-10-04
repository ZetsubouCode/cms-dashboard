<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public $menuName = "Payment";
    public function view(){
        $data = Payment::with(['paymentMethod' => function ($query) {
            $query->select('id', 'name as payment_method_name'); // Alias the 'name' column
        },'order.user'])
        ->get();
        
        $breadcrumbs = [
            ['url' => route('payment.view'), 'label' => 'Payment'],
            ['url' => route('payment.view', ['id' => 1]), 'label' => 'View']
        ];
        return view('dashboard.payment.payment-view', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }
}
