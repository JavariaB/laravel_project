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
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'nullable',
            'description_ar' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        Category::create([
            'name_en' => $request->input('name_en'),
            'name_ar' => $request->input('name_ar'),
            'description_en' => $request->input('description_en'),
            'description_ar' => $request->input('description_ar'),
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
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'nullable',
            'description_ar' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        $category = Category::whereId($id)->first();
        if (empty($category)) abort(404);

        $category->update([
            'name_en' => $request->input('name_en'),
            'name_ar' => $request->input('name_ar'),
            'description_en' => $request->input('description_en'),
            'description_ar' => $request->input('description_ar'),
        ]);

        return redirect()->intended(route('categories.index'))->with('success', 'Category has been updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::whereId($id)->first();
        if (empty($category)) abort(404);

        $category->delete();

        return response()->json(['message' => 'Record deleted successfully.'], 200);
    }

    public function datatable()
    {
        $category = Category::get();
        $dt = DataTables::of($category);

        $dt->addColumn('name_en', function ($record) {
            return '<a href="' . route('categories.edit', $record->id) . '">' . $record->name_en . '</a>';
        });

        $dt->addColumn('name_ar', function ($record) {
            return '<a href="' . route('categories.edit', $record->id) . '">' . $record->name_ar . '</a>';
        });
        
        $dt->addColumn('description_en', function ($record) {
            return $record->description_en;
        });

        $dt->addColumn('description_ar', function ($record) {
            return $record->description_ar;
        });

        $dt->addColumn('actions', function ($record) {
            return '<a href="' . route('categories.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#categories-dt">
                        <span class="ni ni-trash"></span>
                    </a>

                    <a href="' . route('categories.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
        });

        $dt->rawColumns(['name_en', 'name_ar', 'description_en', 'description_ar', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
