<?php

namespace App\Http\Controllers\Admin;
use Session;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with(['post'])->orderBy('id', 'DESC')->get();
        return view('admin.comments.list')->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function reply($id)
    {

        return view('admin.comments.reply', compact('id'));
    }
    public function reply_store(Request $request)
    {
        $this->validate($request, [
            'comment'=>'required',
            'post_id'=>'required'
        ]);
        $comment = new Comment();
        $comment->name = Auth::user()->name;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->status = 1;
        $comment->save();

        Session::flash('success','Comment Successfully Replyed');
        return redirect()->route('comments', ['id'=>$request->post_id]);
    }
    public function status($id)
    {
        $comment = Comment::find($id);
        if($comment->status === 1){
            $comment->status =0;
        }else{
            $comment->status = 1;
        }
        $comment->save();
        Session::flash('success','Comment Status Successfully Changed');
        return redirect()->route('comments');
    }
}
