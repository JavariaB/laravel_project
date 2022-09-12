<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index');
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
        $category = Category::get();
        $dt = DataTables::of($category);

        $dt->addColumn('name', function ($record) {
            return $record->name;
        });

        $dt->addColumn('description', function ($record) {
            return $record->description;
        });

        $dt->rawColumns(['name', 'description']);
        $dt->addIndexColumn();
        
        return $dt->make(true);
    }
}
