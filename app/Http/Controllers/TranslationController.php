<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TranslationController extends Controller
{
    public function index()
    {
        return view('translation.index');
    }

    public function create()
    {
        return view('translation.create');
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

        Translation::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->intended(route('translations.index'))->with('success', 'Translation has been added successfully.');
    }

    public function edit($id)
    {
        $translation = Translation::whereId($id)->first();
        if (empty($translation)) abort(404);

        return view('translation.create', compact('translation'));
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

        $translation = Translation::whereId($id)->first();
        if (empty($translation)) abort(404);

        $translation->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->intended(route('translations.index'))->with('success', 'Translation has been updated successfully.');
    }

    public function destroy($id)
    {
        $translation = Translation::whereId($id)->first();
        if (empty($translation)) abort(404);

        $translation->delete();

        return response()->json(['message' => 'Record deleted successfully.'], 200);
    }

    public function datatable()
    {
        $translation = Translation::get();
        $dt = DataTables::of($translation);

        $dt->addColumn('name', function ($record) {
            return '<a href="' . route('translations.edit', $record->id) . '">' . $record->name . '</a>';
        });

        $dt->addColumn('description', function ($record) {
            return $record->description;
        });

        $dt->addColumn('actions', function ($record) {
            return '<a href="' . route('translations.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#translations-dt">
                        <span class="ni ni-trash"></span>
                    </a>

                    <a href="' . route('translations.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
        });

        $dt->rawColumns(['name', 'description', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
