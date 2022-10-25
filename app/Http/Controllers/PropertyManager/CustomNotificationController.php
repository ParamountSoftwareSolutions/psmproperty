<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $notification = Notification::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'type' => 'custom_notification'])->get();
        return view('property_manager.custom_notification.index', compact('notification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $notification = Notification::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'type' => 'custom_notification'])->get();
        return view('property_manager.custom_notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $notification = Notification::create([
            'user_id' => Auth::id(),
            'user_type' => Auth::user()->roles[0]->name,
            'type' => 'custom_notification',
            'title' => $request->title,
            'description' => $request->description,
        ]);
        if ($notification) {
            (new NotificationHelper)->send_notification_all_user('custom_notification');
            return redirect()->route('property_manager.custom_notification.index')->with($this->message('Notification Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Lead Receipt Create Error', 'danger'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $notification = Notification::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'type' => 'custom_notification'])->findOrFail($id);
        return view('property_manager.custom_notification.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::where('id', $id)->update([
            'user_id' => Auth::id(),
            'user_type' => Auth::user()->roles[0]->name,
            'type' => 'custom_notification',
            'title' => $request->title,
            'description' => $request->description,
        ]);
        if ($notification) {
            (new NotificationHelper)->send_notification_all_user('custom_notification');
            return redirect()->route('property_manager.custom_notification.index')->with($this->message('Notification Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Notification Update Error', 'danger'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $notification = Notification::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'type' => 'custom_notification'])->findOrFail($id);
        $notification->delete();
        if ($notification) {
            return redirect()->route('property_manager.custom_notification.index')->with($this->message('Notification Delete Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('notification Delete Error', 'danger'));
        }
    }
}
