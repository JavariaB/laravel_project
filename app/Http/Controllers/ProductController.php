<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product.read', ['only' => ['index', 'datatable']]);
        $this->middleware('permission:product.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product.update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product.delete', ['only' => ['destroy']]);
    }

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
            'name_en' => 'required|unique:products,name_en',
            'name_ar' => 'required|unique:products,name_ar',
            'description_en' => 'required',
            'description_ar' => 'required',
        ], [
            'name_en.required' => 'The name (English) is required.',
            'name_ar.required' => 'The name (Arabic) is required.',
            'name_en.unique' => 'The name (English) has already been taken.',
            'name_ar.unique' => 'The name (Arabic) has already been taken.',
            'description_en.required' => 'The description (English) is required.',
            'description_ar.required' => 'The description (Arabic) is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        Product::create([
            'category_id' => $request->input('category'),
            'name_en' => $request->input('name_en'),
            'name_ar' => $request->input('name_ar'),
            'description_en' => $request->input('description_en'),
            'description_ar' => $request->input('description_ar'),
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
            'name_en' => 'required|unique:products,name_en,' . $id,
            'name_ar' => 'required|unique:products,name_ar,' . $id,
            'description_en' => 'required',
            'description_ar' => 'required',
            'category' => 'required|exists:categories,id'
        ], [
            'name_en.required' => 'The name (English) is required.',
            'name_ar.required' => 'The name (Arabic) is required.',
            'name_en.unique' => 'The name (English) has already been taken.',
            'name_ar.unique' => 'The name (Arabic) has already been taken.',
            'description_en.required' => 'The description (English) is required.',
            'description_ar.required' => 'The description (Arabic) is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        $product = Product::whereId($id)->first();
        if (empty($product)) abort(404);

        $product->update([
            'category_id' => $request->input('category'),
            'name_en' => $request->input('name_en'),
            'name_ar' => $request->input('name_ar'),
            'description_en' => $request->input('description_en'),
            'description_ar' => $request->input('description_ar'),
        ]);

        return redirect()->intended(route('products.index'))->with('success', 'Product has been updated successfully.');
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

        $dt->addColumn('category', function ($record) {
            return optional($record->category)->name_en;
        });

        $dt->addColumn('name_en', function ($record) {
            if (auth()->user()->can('product.update')) {
                return '<a href="' . route('products.edit', $record->id) . '">' . $record->name_en . '</a>';
            }

            return $record->name_en;
        });

        $dt->addColumn('name_ar', function ($record) {
            if (auth()->user()->can('product.update')) {
            return '<a href="' . route('products.edit', $record->id) . '">' . $record->name_ar . '</a>';
            }

            return $record->name_ar;
        });

        $dt->addColumn('description_en', function ($record) {
            return $record->description_en;
        });

        $dt->addColumn('description_ar', function ($record) {
            return $record->description_ar;
        });

        $dt->addColumn('actions', function ($record) {
        $deleteBtn = $updateBtn = '';

        if (auth()->user()->can('product.update')) {
            $updateBtn = '<a href="' . route('products.edit', $record->id) . '" class="btn btn-sm btn-primary mr-1">
                    <span class="ni ni-edit"></span>
                </a>';
        }

        if (auth()->user()->can('product.delete')) {
            $deleteBtn = '<a href="' . route('products.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#categories-dt">
                    <span class="ni ni-trash"></span>
                </a>';
            }

            return $updateBtn . $deleteBtn;
            
        });

        $dt->rawColumns(['category', 'name_en', 'name_ar', 'description_en', 'description_ar', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
