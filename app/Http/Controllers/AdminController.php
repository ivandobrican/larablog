<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin','auth'])->only(['blogs']);
    }

    public function index(){
        return view('admin.dashboard');
    }

    public function blogs(){
        $publishedBlogs = Blog::where('status',1)->latest()->get();
        $draftedBlogs = Blog::where('status',0)->latest()->get();
        return view('admin.blogs',compact(['publishedBlogs','draftedBlogs']));
    }
}
