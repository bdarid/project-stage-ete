<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('users_id', Auth::id())
            ->latest()
            ->paginate(15);

        // Marquer toutes comme lues
        Notification::where('users_id', Auth::id())
            ->where('lu', false)
            ->update([
                'lu' => true
            ]);

        return view('notifications.index', compact('notifications'));
    }
}