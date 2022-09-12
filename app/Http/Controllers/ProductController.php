<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function datatable()
    {
        $product = Product::with('category')->get();

        $dt = DataTables::of($product);

        $dt->addColumn('name', function ($record) {
            return $record->name;
        });

        $dt->addColumn('category', function ($record) {
            return optional($record->category)->name;
        });

        $dt->addColumn('description', function ($record) {
            return $record->description;
        });

        $dt->rawColumns(['name', 'category', 'description']);
        $dt->addIndexColumn();
        
        return $dt->make(true);

    }
}
