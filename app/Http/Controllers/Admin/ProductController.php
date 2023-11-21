<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Instantiate a new ProductController instance.
     */
    // public function __construct()
    // {
    //    $this->middleware('auth');
    //    $this->middleware('permission:create-product|edit-product|delete-product', ['only' => ['index','show']]);
    //    $this->middleware('permission:create-product', ['only' => ['create','store']]);
    //    $this->middleware('permission:edit-product', ['only' => ['edit','update']]);
    //    $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::latest()->paginate(10),
            'userInfo' => Auth::guard('admin')->user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        if($request->isMethod(('post'))){
            Product::create($request->all());
            return view('admin.products.create',[
                'userInfo' => Auth::guard('admin')->user(),
                'success' => 'New product is added successfully.'
            ]);
        }
        return view('admin.products.create',[
            'userInfo' => Auth::guard('admin')->user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        Product::create($request->all());
        return redirect()->route('admin.products.create')
                ->withSuccess('New product is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $product = Product::where(['id' => $id])->first();
        return view('admin.products.show', [
            'product' => $product,
            'userInfo' => Auth::guard('admin')->user()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $product = Product::where(['id' => $id])->first();
        return view('admin.products.edit', [
            'product' => $product,
            'userInfo' => Auth::guard('admin')->user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id, Product $product): RedirectResponse
    {
        $data = $request->all();
        $product->where('id',$id)->update(['name'=>$data['name'], 'description' => $data['description']]);
        return redirect()->back()
                ->withSuccess('Product is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Product::where('id', $id)->delete();
        return redirect()->route('admin.products.index')
                ->withSuccess('Product is deleted successfully.');
    }
}