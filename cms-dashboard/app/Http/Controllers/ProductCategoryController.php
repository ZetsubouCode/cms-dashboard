<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public $menuName = "Product Category";
    public function view(){
        $data = Category::all();
        $breadcrumbs = [
            ['url' => route('productcategory.view'), 'label' => 'Product Category'],
            ['url' => route('productcategory.view', ['id' => 1]), 'label' => 'View']
        ];
        return view('dashboard.productcategory.productcategory-view', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function add(){
        $data = Category::all();
        $breadcrumbs = [
            ['url' => route('productcategory.view'), 'label' => 'Product Category'],
            ['url' => route('productcategory.add', ['id' => 1]), 'label' => 'Add']
        ];
        return view('dashboard.productcategory.productcategory-add', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function create(Request $request)
    {
        // Example validation
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:400',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        // Example of adding data to the database
        Category::create($validated);
        // Pass the message back to the view (using session flash data)
        return redirect()->route('productcategory.add')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data product category added successfully!'
            ]);
    }

    public function edit($id)
    {
        $data = Category::findOrFail($id);
        $breadcrumbs = [
            ['url' => route('productcategory.view'), 'label' => 'Product Category'],
            ['url' => route('productcategory.edit', ['id' => $id]), 'label' => 'Edit']
        ];
        return view('dashboard.productcategory.productcategory-edit', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function update(Request $request, $id)
    {
        $paymentMethod = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:400',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        $paymentMethod->update($validated);

        return redirect()->route('productcategory.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data product category updated successfully!'
            ]);
    }

    public function delete($id)
    {
        $paymentMethod = Category::findOrFail($id);
        
        // Optionally check for constraints, relationships, etc.
        $paymentMethod->delete();
        
        return redirect()->route('productcategory.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data product category deleted successfully!'
            ]);
    }

}
