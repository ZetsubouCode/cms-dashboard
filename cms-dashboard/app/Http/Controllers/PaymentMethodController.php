<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentMethodController extends Controller
{
    public $menuName = "Payment Method";
    public function view(){
        $data = PaymentMethod::all();
        $breadcrumbs = [
            ['url' => route('paymentmethod.view'), 'label' => 'Payment Method'],
            ['url' => route('paymentmethod.view', ['id' => 1]), 'label' => 'View']
        ];
        return view('dashboard.paymentmethod.paymentmethod-view', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function add(){
        $data = PaymentMethod::all();
        $breadcrumbs = [
            ['url' => route('paymentmethod.view'), 'label' => 'Payment Method'],
            ['url' => route('paymentmethod.add', ['id' => 1]), 'label' => 'Add']
        ];
        return view('dashboard.paymentmethod.paymentmethod-add', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function create(Request $request)
    {
        // Example validation
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:AVAILABLE,NOT AVAILABLE',
        ]);

        // Example of adding data to the database
        PaymentMethod::create($validated);
        // Pass the message back to the view (using session flash data)
        return redirect()->route('paymentmethod.add')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data payment method added successfully!'
            ]);
    }

    public function edit($id)
    {
        $data = PaymentMethod::findOrFail($id);
        $breadcrumbs = [
            ['url' => route('paymentmethod.view'), 'label' => 'Payment Method'],
            ['url' => route('paymentmethod.edit', ['id' => $id]), 'label' => 'Edit']
        ];
        return view('dashboard.paymentmethod.paymentmethod-edit', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:AVAILABLE,NOT AVAILABLE',
        ]);

        $paymentMethod->update($validated);

        return redirect()->route('paymentmethod.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Payment method updated successfully!'
            ]);
    }

    public function delete($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        
        // Optionally check for constraints, relationships, etc.
        $paymentMethod->delete();
        
        return redirect()->route('paymentmethod.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Payment method deleted successfully!'
            ]);
    }


}

