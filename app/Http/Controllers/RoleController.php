<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index');
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('role.create', compact('permissions'));
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
        $roles = Role::get();

        $dt = DataTables::of($roles);

        $dt->addColumn('name', function ($record) {
            return '<a href="' . route('roles.edit', $record->id) . '">' . $record->name . '</a>';
        });

        $dt->addColumn('created_at', function ($record) {
            return $record->created_at;
        });

        $dt->addColumn('actions', function ($record) {
            return '<a href="' . route('roles.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#roles-dt">
                        <span class="ni ni-trash"></span>
                    </a>

                    <a href="' . route('roles.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
        });

        $dt->rawColumns(['name', 'created_at', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
