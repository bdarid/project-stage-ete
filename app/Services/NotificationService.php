<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Users;

class NotificationService
{
    public static function send($userId, $titre, $message, $type = 'info')
    {
        Notification::create([
            'users_id' => $userId,
            'titre' => $titre,
            'message' => $message,
            'type' => $type,
        ]);
    }

    public static function sendToAdmins($titre, $message, $type = 'info')
    {
        $admins = Users::role('Admin')->get();

        foreach ($admins as $admin) {
            self::send(
                $admin->id,
                $titre,
                $message,
                $type
            );
        }
    }
}