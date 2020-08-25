<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation
        $this->validate($request, ['title' => 'required']);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        if ($request->has('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); //getting file extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $data['img'] = $filename;
        }
        // dd($data);
        Post::create($data);
        return redirect('/posts')->with('status', "Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)

    {
        $categories = Category::all();
        return view('admin.post.edit', compact('post', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validation
        $this->validate($request, ['title' => 'required']);
        $data = $request->all();




        if ($request->has('img')) {

            $file_path = public_path('/uploads/' . $post->img);

            unlink($file_path);

            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); //getting file extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $data['img'] = $filename;
        }


        $post->update($data);
        return redirect('/posts')->with('status', "Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $file_path = public_path('/uploads/' . $post->img);

        unlink($file_path);
        $post->delete();
        return redirect('/posts')->with('status', "Deleted Successfully");
    }

    public function statusUpdate(Post $post)
    {
        $post->update([
            'status' => !$post->status
        ]);
        return redirect('/posts')->with('status', "Status Updated Successfully");

    }
}
