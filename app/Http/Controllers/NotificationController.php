<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        return response()->json([
            'notifications' => auth()->user()->appNotifications()->latest()->take(15)->get(),
            'non_lues' => auth()->user()->appNotifications()->where('lu', false)->count(),
        ]);
    }

    public function marquerLu(Notification $notification)
    {
        abort_if($notification->user_id !== auth()->id(), 403);
        $notification->update(['lu' => true]);
        return response()->json(['success' => true]);
    }

    public function marquerToutLu()
    {
        auth()->user()->appNotifications()->update(['lu' => true]);
        return response()->json(['success' => true]);
    }
    public function destroy(\App\Models\Notification $notification)
    {
        abort_if($notification->user_id !== auth()->id(), 403);
        $notification->delete();
        return response()->json(['success' => true]);
    }
    
    public function destroyToutLu()
    {
        auth()->user()->appNotifications()->where('lu', true)->delete();
        return response()->json(['success' => true]);
    }
}