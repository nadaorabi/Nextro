<?php

namespace App\Http\Controllers;

// from ali
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function ShowHomePage()
    {
        return view('User/index');
    }
    public function ShowAboutPage()
    {
        return view('User/about');
    }
    public function ShowGalleryPage()
    {
        return view('User/gallery');
    }
    public function ShowNewsPage()
    {
        return view('User/news');
      
    }
    public function ShowStaffPage()
    {
        return view('User/staff');
    }
    public function ShowElementsPage()
    {
        return view('User/elements');
    }
    public function ShowContactPage()
    {
        return view('User/contact');
    }
    public function ShowProfilePage()
    {
        return view('User/profile');
    }
    public function ShowCoursesPage()
    {
        return view('User/Courses');
    }
    
}


