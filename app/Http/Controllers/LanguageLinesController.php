<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Spatie\TranslationLoader\LanguageLine;

class LanguageLinesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:translation.read', ['only' => ['index', 'datatable']]);
        $this->middleware('permission:translation.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:translation.update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:translation.delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('language-lines.index');
    }

    public function edit($id)
    {
        $languageLine = LanguageLine::whereId($id)->first();
        if (empty($languageLine)) abort(404);

        return view('language-lines.update', compact('languageLine'));
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

        $translation = LanguageLine::whereId($id)->first();
        if (empty($translation)) abort(404);

        $translation->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->intended(route('language-lines.index'))->with('success', 'Translation has been updated successfully.');
    }

    public function datatable()
    {
        $translation = LanguageLine::get();
        $dt = DataTables::of($translation);

        $dt->addColumn('text_en', function ($record) {
            return $record->text['en'];
        });

        $dt->addColumn('text_ar', function ($record) {
            return $record->text['ar'];
        });

        $dt->addColumn('actions', function ($record) {
            $updateBtn = '';

            if (auth()->user()->can('translation.update')) {
                $updateBtn = '<a href="' . route('language-lines.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
            }

            return $updateBtn;
        });

        $dt->rawColumns(['text_en', 'text_ar', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
