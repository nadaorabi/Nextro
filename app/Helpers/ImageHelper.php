<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function getProfileImageUrl($user)
    {
        if (!$user) {
            return self::getDefaultAvatarUrl('Admin');
        }

        // Check if user has a profile image and it exists
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            $url = Storage::disk('public')->url($user->profile_image);
            // Fix the URL to use the correct port
            $url = str_replace('http://localhost/', 'http://localhost:8000/', $url);
            return $url;
        }

        // Return default avatar based on user name
        return self::getDefaultAvatarUrl($user->name ?? 'Admin');
    }

    public static function getDefaultAvatarUrl($name)
    {
        $encodedName = urlencode($name ?? 'Admin');
        return "https://ui-avatars.com/api/?name={$encodedName}&background=667eea&color=fff&size=120";
    }

    public static function hasProfileImage($user)
    {
        return $user && $user->profile_image && Storage::disk('public')->exists($user->profile_image);
    }
} 