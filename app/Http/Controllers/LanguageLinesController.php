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

    public function create()
    {
        return view('language-lines.create');
    }

    public function edit($id)
    {
        $languageLine = LanguageLine::whereId($id)->first();
        if (empty($languageLine)) abort(404);

        return view('language-lines.update', compact('languageLine'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_en' => 'required',
            'title_ar' => 'required',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        LanguageLine::create([
            'group' => 'languagelines',
            'key' => $request->input('title_en') . $request->input('title_ar'),
            'text' => [
                'title_en' => $request->input('title_en'),
                'title_ar' => $request->input('title_ar'),
                'description_en' => $request->input('description_en'),
                'description_ar' => $request->input('description_ar'),
            ],
        ]);

        return redirect()->intended(route('language-lines.index'))->with('success', 'Translation has been added successfully.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title_en' => 'required',
            'title_ar' => 'required',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        $translation = LanguageLine::whereId($id)->first();
        if (empty($translation)) abort(404);

        $translation->update([
            'group' => 'languagelines',
            'key' => $request->input('title_en') . $request->input('title_ar'),
            'text' => [
                'title_en' => $request->input('title_en'),
                'title_ar' => $request->input('title_ar'),
                'description_en' => $request->input('description_en'),
                'description_ar' => $request->input('description_ar'),
            ],
        ]);

        return redirect()->intended(route('language-lines.index'))->with('success', 'Translation has been updated successfully.');
    }

    public function destroy($id)
    {
        $notification = LanguageLine::whereId($id)->first();
        if (empty($notification)) abort(404);

        $notification->delete();

        return response()->json(['message' => 'Record deleted successfully.'], 200);
    }

    public function datatable()
    {
        $translation = LanguageLine::get();
        $dt = DataTables::of($translation);

        $dt->addColumn('title_en', function ($record) {
            return $record->text['title_en'];
        });

        $dt->addColumn('title_ar', function ($record) {
            return $record->text['title_ar'];
        });

        $dt->addColumn('description_en', function ($record) {
            return $record->text['description_en'];
        });

        $dt->addColumn('description_ar', function ($record) {
            return $record->text['description_ar'];
        });

        $dt->addColumn('actions', function ($record) {
            $updateBtn = $deleteBtn = '';

            if (auth()->user()->can('translation.update')) {
                $updateBtn = '<a href="' . route('language-lines.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
            }

            if (auth()->user()->can('translation.delete')) {
                $deleteBtn = '<a href="' . route('language-lines.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#language-lines-dt">
                        <span class="ni ni-trash"></span>
                    </a>';
            }

            return $updateBtn . $deleteBtn;
        });

        $dt->rawColumns(['title_en', 'title_ar', 'description_ar', 'description_ar', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
