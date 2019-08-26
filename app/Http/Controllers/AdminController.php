<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){

        return view('admin.dashboard');
    }

    public function blogsadd(){

        return view('admin.blogs.add');
    }

    public function users(){

        return view('admin.users');
    }

    public function admins(){

        return view('admin.admins');
    }

    public function articles(){

        return view('admin.articles');
    }

    public function tags(){

        return view('admin.tags');
    }

    public function settings(){

        return view('admin.settings');
    }
}
