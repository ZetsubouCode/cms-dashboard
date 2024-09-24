<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public $menuName = "Supply";
    public function view(){
        $data = Supply::all();
        $breadcrumbs = [
            ['url' => route('supply.view'), 'label' => 'Supply'],
            ['url' => route('supply.view', ['id' => 1]), 'label' => 'View']
        ];
        return view('dashboard.supply.supply-view', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function add(){
        $data = Supply::all();
        $breadcrumbs = [
            ['url' => route('supply.view'), 'label' => 'Supply'],
            ['url' => route('supply.add', ['id' => 1]), 'label' => 'Add']
        ];
        return view('dashboard.supply.supply-add', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function create(Request $request)
    {
        // Example validation
        $validated = $request->validate([
            'name' => 'required|string|max:1000',
            'price_per_unit' => 'required|integer|min:0',
            'date_aquired' => 'required|date',
            'description' => 'nullable|string',
            'unit_of_measurement' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:100',
            'supplier_name' => 'nullable|string|max:200',
            'status' => 'required|in:IN STOCK,PRE-ORDER',
            'low_stock_percentage' => 'required|numeric|min:0|max:100',
        ]);
        
        // Example of adding data to the database
        Supply::create($validated);
        // Pass the message back to the view (using session flash data)
        return redirect()->route('supply.add')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data payment method added successfully!'
            ]);
    }

    public function edit($id)
    {
        $data = Supply::findOrFail($id);
        $breadcrumbs = [
            ['url' => route('supply.view'), 'label' => 'Supply'],
            ['url' => route('supply.edit', ['id' => $id]), 'label' => 'Edit']
        ];
        return view('dashboard.supply.supply-edit', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function update(Request $request, $id)
    {
        $paymentMethod = Supply::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:1000',
            'price_per_unit' => 'required|integer|min:0',
            'date_aquired' => 'required|date',
            'description' => 'nullable|string',
            'unit_of_measurement' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:100',
            'supplier_name' => 'nullable|string|max:200',
            'status' => 'required|in:IN STOCK,LOW STOCK,OUT OF STOCK,PRE-ORDER,DISCONTINUED',
            'low_stock_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $paymentMethod->update($validated);

        return redirect()->route('supply.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Supply updated successfully!'
            ]);
    }

    public function delete($id)
    {
        $paymentMethod = Supply::findOrFail($id);
        
        // Optionally check for constraints, relationships, etc.
        $paymentMethod->delete();
        
        return redirect()->route('supply.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Supply deleted successfully!'
            ]);
    }
}
