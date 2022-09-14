<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->intended(route('categories.index'))->with('success', 'Category has been added successfully.');
    }

    public function edit($id)
    {
        $category = Category::whereId($id)->first();
        if (empty($category)) abort(404);

        return view('category.create', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        $category = Category::whereId($id)->first();
        if (empty($category)) abort(404);

        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->intended(route('categories.index'))->with('success', 'Category has been updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::whereId($id)->first();
        if (empty($category)) abort(404);

        return redirect()->intended(route('categories.index'))->with('success', 'Category has been deleted successfully.');
    }

    public function datatable()
    {
        $category = Category::get();
        $dt = DataTables::of($category);

        $dt->addColumn('name', function ($record) {
            return '<a href="' . route('categories.edit', $record->id) . '">' . $record->name . '</a>';
        });

        $dt->addColumn('description', function ($record) {
            return $record->description;
        });

        $dt->addColumn('actions', function ($record) {
            return '<a href="' . route('categories.destroy', $record->id) . '" class="btn btn-danger btn-xs">
                        <span class="ni ni-trash">
                    </a>';
        });

        $dt->rawColumns(['name', 'description', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
