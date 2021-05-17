<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BlogsController extends Controller
{

    public function __construct()
    {
        $this->middleware('author')->only(['create', 'store','edit','update']);
        $this->middleware('admin')->only(['destroy', 'trash','restore','permanentDelete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('status',1)->latest()->get();
        return view('blogs.index',['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('blogs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'title' => ['required','min:10','max:50'],
            'body' => ['required','min:100'],
        ];
        $this->validate($request,$rules);

        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        $input['meta_title'] = Str::limit($request->title,55);
        $input['meta_description'] = Str::limit($request->body,155);

        if ($file = $request->file('featured_image')){
            $name = uniqid() . $file->getClientOriginalName();
            $name = strtolower(str_replace(' ','-',$name));
            $input['featured_image'] = $name;
            $file->move(public_path('images/featured_image/'),$name);
        }
        $blogByUser = $request->user()->blogs()->create($input);
        if($request->category_id){
            $blogByUser->categories()->sync($request->category_id);
        }

        Session::flash('create_blog_success','You have successfully created a new blog!');
        return redirect('/blogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        return view('blogs.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::all();

        $bc = [];
        foreach ($blog->categories as $c){
            $bc[] = $c->id - 1;
        }

        $filtered = Arr::except($categories,$bc);

        return view('blogs.edit',['blog'=>$blog,'categories' =>$categories,'filtered' => $filtered]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $blog = Blog::findOrFail($id);
        if($file = $request->file('featured_image')){
            if($blog->featured_image){
                unlink('images/featured_image/'.$blog->featured_image);
            }
            $name = uniqid() . $file->getClientOriginalName();
            $name = strtolower(str_replace(' ','-',$name));

            $input['featured_image'] = $name;
            $file->move(public_path('images/featured_image/'),$name);
        }
        if($request->category_id){
            $blog->categories()->sync($request->category_id);
        }
        $blog->update($input);
        return redirect(route('blogs.show',$blog->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect('blogs');
    }

    public function trash(){
        $blogs = Blog::onlyTrashed()->get();
        return view('blogs.trash',['blogs'=>$blogs]);
    }

    public function restore($id){
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore($blog);
        return redirect('blogs');
    }

    public function permanentDelete($id){
        $permanentDeleteBlog = Blog::onlyTrashed()->findOrFail($id);
        $permanentDeleteBlog->forceDelete($permanentDeleteBlog);
        return back();
    }
}
