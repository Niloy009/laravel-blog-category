<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::with('category')
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
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        //validation
        $this->validate($request, [
            'title' => 'required',
//            'img' => 'required|mimes:png|max:300'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        if ($request->has('img')) {
            $file = $request->file('img');

            $extension = $file->getClientOriginalExtension();//getting file extension

            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $data['img'] = $filename;


//            //second method to upload image
//            $filename = Str::slug($data['title'])  . '-'. time() .  '.' . $file->getClientOriginalExtension();
//
////            dd($data);
//            $file->storePubliclyAs(
//                'public/posts',  $filename
//            );
//
//            $data['img'] = $filename;
        }


        // dd($data);
        $post = Post::create($data);

        //multiple tags insert tag_id array
        if(!empty($request->tag_id)){
            $post->tags()->sync($request->tag_id);
        }


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
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories','tags'));

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
            //dd($post->img);
            if (file_exists($file_path) && !empty($post->img)) {
                unlink($file_path);
            }

            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); //getting file extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $data['img'] = $filename;

        }


        $post->update($data);

        //multiple tags insert
        if(!empty($request->tag_id)){
            $post->tags()->sync($request->tag_id);
        }

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
