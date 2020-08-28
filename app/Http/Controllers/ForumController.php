<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::with('category')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();
//        $posts = Post::with('category:id,name')->orderBy('id', 'desc')->get();
//        $posts = Post::with(array('category'=>function($query){
//            $query->select('id', 'name');
//        }))->orderBy('id', 'desc')->get();
//        $posts = Post::orderBy('id', 'desc')->get();
        //dd($posts);
//        $user = auth()->user();
//        $user->load('posts');
//        $posts =$user->posts;
//        $posts = auth()->user()->posts;

        return view('admin.forum.index', compact('forums'));
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
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        //
    }

    public function statusUpdate(Forum $forum)
    {
        $forum->update([
            'status' => !$forum->status
        ]);
        return redirect('/forums')->with('status', "Status Updated Successfully");

    }
}
