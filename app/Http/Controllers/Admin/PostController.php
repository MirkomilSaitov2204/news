<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Image;
use Illuminate\Support\Facades\Auth;
use Session;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->type == 1 || Auth::user()->hasRole('Editor')){
            $posts = Post::with(['creator'])->orderBy('id', 'DESC')->get();
       }else{
          $posts = Post::with(['creator'])->where('created_by', Auth::user()->id)->orderBy('id', 'DESC')->get();
       }
       return view('admin.posts.list')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all()->where('status', 1);
        return view('admin.posts.create')->with('category' ,$category);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $this->validate($request, [
         'title'=>'required|unique:posts',
         'short_description'=>'required',
         'description'=>'required',
         'category_id' =>'required',
         'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
     ]);
     $post = new Post();
     $post->title = $request->title;
     $post->slug = str_slug($request->title);
     $post->short_description = $request->short_description;
     $post->description = $request->description;
     $post->category_id = $request->category_id;
     $post->status = 1;
     $post->hot_news = 0;
     $post->view_count = 0;
     $post->main_image = '';
     $post->thumb_image = '';
     $post->list_image = '';
     $post->created_by = Auth::id();
     $post->save();

     $file = $request->file('img');
     $extension = $file->getClientOriginalName();
    $main_image = 'post_main'.$post->id. '.' .$extension;
    $list_image = 'post_list'.$post->id. '.' .$extension;
    $thumb_image = 'post_thumb'.$post->id. '.' .$extension;




    Image::make($file)->resize(630, 539)->save(public_path('/post/image'.$main_image));
    Image::make($file)->resize(630, 539)->save(public_path('/post/image'.$list_image));
    Image::make($file)->resize(630, 539)->save(public_path('/post/image'.$thumb_image));

    $post->main_image = $main_image;
    $post->thumb_image = $thumb_image;
    $post->list_image = $list_image;
        $post->save();

        Session::flash('success','Post Successfully Created');
        return redirect()->route('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $category = Category::all()->where('status', 1);
        return view('admin.posts.edit')->with('category' ,$category)->with('post', $post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post =Post::find($id);
        if($request->file('img')){
            @unlink(public_path('/post/image'.$post->main_image));
            @unlink(public_path('/post/image'.$post->thumb_image));
            @unlink(public_path('/post/image'.$post->list_image));

            $file = $request->file('img');
            $extension = $file->getClientOriginalName();
           $main_image = 'post_main'.$post->id. '.' .$extension;
           $list_image = 'post_list'.$post->id. '.' .$extension;
           $thumb_image = 'post_thumb'.$post->id. '.' .$extension;




           Image::make($file)->resize(630, 539)->save(public_path('/post/image'.$main_image));
           Image::make($file)->resize(630, 539)->save(public_path('/post/image'.$list_image));
           Image::make($file)->resize(630, 539)->save(public_path('/post/image'.$thumb_image));

           $post->main_image = $main_image;
           $post->thumb_image = $thumb_image;
           $post->list_image = $list_image;

        }
        $post->title = $request->title;
     $post->slug = str_slug($request->title);
     $post->short_description = $request->short_description;
     $post->description = $request->description;
     $post->category_id = $request->category_id;
     $post->save();

        Session::flash('success','Post Successfully Updated');
        return redirect()->route('posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        Session::flash('success','Post Successfully Deleted');
        return redirect()->route('posts');

    }

    public function status($id)
    {
        $post = Post::find($id);
        if($post->status === 1){
            $post->status =0;
        }else{
            $post->status = 1;
        }
        $post->save();
        Session::flash('success','Post Status Successfully Changed');
        return redirect()->route('posts');
    }
    public function hot_news($id)
    {
        $post = Post::find($id);
        if($post->hot_news === 1){
            $post->hot_news =0;
        }else{
            $post->hot_news = 1;
        }
        $post->save();
        Session::flash('success','Post Hot News Successfully Changed');
        return redirect()->route('posts');
    }
}
