<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function getProfileImageUrl($user)
    {
        if (!$user) {
            return asset('images/defaults/default-admin-male.jpg');
        }

        // Check if user has a profile image and it exists
        if ($user->profile_image && \Storage::disk('public')->exists($user->profile_image)) {
            $url = \Storage::disk('public')->url($user->profile_image);
            $url = str_replace('http://localhost/', 'http://localhost:8000/', $url);
            return $url;
        }

        // Return default avatar based on user role and gender
        $role = $user->role ?? 'admin';
        $gender = strtolower($user->gender ?? 'male');
        if ($role === 'admin') {
            return asset($gender === 'female' ? 'images/defaults/default-admin-female.jpg' : 'images/defaults/default-admin-male.jpg');
        } elseif ($role === 'teacher') {
            return asset($gender === 'female' ? 'images/defaults/default-teacher-female.jpg' : 'images/defaults/default-teacher-male.jpg');
        } elseif ($role === 'student') {
            return asset($gender === 'female' ? 'images/defaults/default-student-female.jpg' : 'images/defaults/default-student-male.jpg');
        }
        // fallback
        return asset('images/defaults/default-admin-male.jpg');
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

    public static function getCourseImageUrl($course)
    {
        if ($course && $course->image && \Storage::disk('public')->exists($course->image)) {
            $url = \Storage::disk('public')->url($course->image);
            $url = str_replace('http://localhost/', 'http://localhost:8000/', $url);
            return $url;
        }
        return asset('images/defaults/default-course.jpg');
    }

    public static function getPackageImageUrl($package)
    {
        if ($package && $package->image && \Storage::disk('public')->exists($package->image)) {
            $url = \Storage::disk('public')->url($package->image);
            $url = str_replace('http://localhost/', 'http://localhost:8000/', $url);
            return $url;
        }
        return asset('images/defaults/default-package.jpg');
    }
} 