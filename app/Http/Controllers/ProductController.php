<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function create()
    {
        $categories = Category::get();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        Product::create([
            'category_id' => $request->input('category'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->intended(route('products.index'))->with('success', 'Product has been added successfully.');
    }

    public function edit($id)
    {
        $product = Product::whereId($id)->first();
        if (empty($product)) abort(404);

        $categories = Category::get();

        return view('product.create', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'category' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        $product = Product::whereId($id)->first();
        if (empty($product)) abort(404);

        $product->update([
            'category_id' => $request->input('category'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->intended(route('products.index'))->with('success', 'Prodcut has been updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::whereId($id)->first();
        if (empty($product)) abort(404);

        $product->delete();

        return response()->json(['message' => 'Record deleted successfully.'], 200);
    }

    public function datatable()
    {
        $product = Product::with('category')->get();

        $dt = DataTables::of($product);

        $dt->addColumn('name', function ($record) {
            return '<a href="' . route('products.edit', $record->id) . '">' . $record->name . '</a>';
        });

        $dt->addColumn('category', function ($record) {
            return optional($record->category)->name;
        });

        $dt->addColumn('description', function ($record) {
            return $record->description;
        });

        $dt->addColumn('actions', function ($record) {
            return '<a href="' . route('products.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#products-dt">
                        <span class="ni ni-trash"></span>
                    </a>

                    <a href="' . route('products.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
        });

        $dt->rawColumns(['name', 'category', 'description', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
