<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
use illuminate\Support\Str;


class HomeController extends Controller
{
//todo ====================================================================
    public function index()
    {                 // $name= null to evode error if we not get var from link
        $posts = Post::latest()->paginate(6);
        return view('home')->with([
            'posts' => $posts,
        ]);
    }
//todo ====================================================================
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();            //find post with $id reseved from web.php
        return view('show')->with([         //go to show page, with sending var  post
            'post' => $post
        ]);
    }
//todo ====================================================================
    public function create()
    {
        return view('create');
    }
//todo ====================================================================
    // send data from form to DB, there is 2 methods
    public function store(Request $request) //$request is where we have data from form
    {
        /*dd($request->all()); //to dump and die , we can use here $request -> body or title ...*/
        //todo method 1
        // $post = new Post();
        // $post->title = $request->title;
        // $post->slug = Str::slug($request->title);
        // $post->body = $request->body;
        // $post->image = "https://via.placeholder.com/640x480.png/0044dd?text=walid";
        // $post->save();

        //for image apload
        if($request->has('image')){
         $file =$request->image;
         $image_name = time().'_'.$file->getClientOriginalName();      //concatinate time_ and the file name
         $file->move(public_path('uploads'),$image_name);   // move the file to uploads folder and name it, using move function
        }

        //todo method 2
        //for validation we use validate() faction and give it $reques & other vars that want to validate
        $this->validate($request,[
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:10|max:100',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:4048'
        ]);
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
            'image' => $image_name
        ]);
        // echo"added";

        //send to home after create success
        return redirect()->route('home')->with([
            'success' => 'Article Added'
        ]);
    }
//todo ====================================================================
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('edit')->with([
            'post' => $post
        ]);
    }
//todo ====================================================================
    public function update(Request $request, $slug)
    {
        //for validation we use validate() faction and give it $reques & other vars that want to validate, for validation msg you can edit it from Validation.php
        $this->validate($request, [
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:10|max:100',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:4048'        // $this->route('slug')?  'image|mimes:png,jpg,jpeg|max:4048' :'required|image|mimes:png,jpg,jpeg|max:4048' ep 28 
        ]);

        $post = Post::where('slug', $slug)->first();
        //for image apload
        if($request->has('image')){
            $file =$request->image;
            $image_name = time().'_'.$file->getClientOriginalName();      //concatinate time_ and the file name
            $file->move(public_path('uploads'),$image_name);   // move the file to uploads folder and name it, using move function
            unlink(public_path('uploads/') . $post->image); //to delete the old image from folder uploads after update it
            $post->image = $image_name;
            
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
            'image' => $image_name
        ]);
        return redirect()->route('home')->with([
            'success' => 'Article Modified'
        ]);
    }
//todo ====================================================================
    public function delete($slug){
        $post = Post::where('slug', $slug)->first();
        unlink(public_path('uploads/') . $post->image); //to delete the old image from folder uploads after update it, using unlink function
        $post->delete();
        return redirect()->route('home')->with([
            'success' => 'Article deleted'
        ]);

    }
}
