<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\FileProcessController;

class ProductController extends Controller
{
    public $menuName = "Product";
    public function view(){
        $data = Product::with(['category' => function ($query) {
            $query->select('id', 'name as product_category'); // Alias the 'name' column
        }])
        ->get();
        $breadcrumbs = [
            ['url' => route('product.view'), 'label' => 'Product'],
            ['url' => route('product.view', ['id' => 1]), 'label' => 'View']
        ];
        return view('dashboard.product.product-view', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function add(){
        $data = Product::all();
        $category = Category::all();
        $breadcrumbs = [
            ['url' => route('product.view'), 'label' => 'Product'],
            ['url' => route('product.add', ['id' => 1]), 'label' => 'Add']
        ];
        return view('dashboard.product.product-add', ['data'=>$data,'category'=>$category,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function create(Request $request)
    {
        // Example validation
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:400',
            'category_id' => 'required|integer',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:AVAILABLE,NOT AVAILABLE',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $file = $request->file('product_image');
        if (isset($file)){
            // Step 2: Check if the file is readable/not corrupt
            if (!$file->isValid()) {
                throw ValidationException::withMessages([
                    'product_image' => ['Uploaded file is not valid.']
                ]);
            }

            // Step 3: Check file size and dimensions
            $imageSize = getimagesize($file);
            if ($imageSize === false) {
                throw ValidationException::withMessages([
                    'product_image' => ['Uploaded file is not an image.']
                ]);
            }

            // Example: Check dimensions (max 1920x1080)
            if ($imageSize[0] > 1920 || $imageSize[1] > 1080) {
                throw ValidationException::withMessages([
                    'product_image' => ['Image dimensions exceed limit (1920x1080).']
                ]);
            }
            // Step 6: Update the $validated variable with the base filename
            $validated['image_url'] = FileProcessController::upload_photo($file); // Store just the filename
        }
        // Example of adding data to the database
        Product::create($validated);
        // Pass the message back to the view (using session flash data)
        return redirect()->route('product.add')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data product added successfully!'
            ]);
    }

    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $breadcrumbs = [
            ['url' => route('product.view'), 'label' => 'Product'],
            ['url' => route('product.edit', ['id' => $id]), 'label' => 'Edit']
        ];
        return view('dashboard.product.product-edit', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function update(Request $request, $id)
    {
        $paymentMethod = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:400',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        $paymentMethod->update($validated);

        return redirect()->route('product.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data product updated successfully!'
            ]);
    }

    public function delete($id)
    {
        $paymentMethod = Product::findOrFail($id);
        
        // Optionally check for constraints, relationships, etc.
        $paymentMethod->delete();
        
        return redirect()->route('product.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data product deleted successfully!'
            ]);
    }
}
