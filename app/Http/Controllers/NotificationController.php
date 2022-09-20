<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notification.index');
    }

    public function create()
    {
        return view('notification.create');
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

        Notification::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->intended(route('notifications.index'))->with('success', 'Notification has been added successfully.');
    }

    public function edit($id)
    {
        $notification = Notification::whereId($id)->first();
        if (empty($notification)) abort(404);

        return view('notification.create', compact('notification'));
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

        $notification = Notification::whereId($id)->first();
        if (empty($notification)) abort(404);

        $notification->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->intended(route('notifications.index'))->with('success', 'Notification has been updated successfully.');
    }

    public function destroy($id)
    {
        $notification = Notification::whereId($id)->first();
        if (empty($notification)) abort(404);

        $notification->delete();

        return response()->json(['message' => 'Record deleted successfully.'], 200);
    }

    public function datatable()
    {
        $notification = Notification::get();
        $dt = DataTables::of($notification);

        $dt->addColumn('name', function ($record) {
            return '<a href="' . route('notifications.edit', $record->id) . '">' . $record->name . '</a>';
        });

        $dt->addColumn('description', function ($record) {
            return $record->description;
        });

        $dt->addColumn('actions', function ($record) {
            return '<a href="' . route('notifications.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#notifications-dt">
                        <span class="ni ni-trash"></span>
                    </a>

                    <a href="' . route('notifications.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
        });

        $dt->rawColumns(['name', 'description', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
