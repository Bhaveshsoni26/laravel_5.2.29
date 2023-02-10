<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostsCreateRequest;
use App\Http\Requests\PostsUpdate;
use App\Photo;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Whossun\Toastr\Facades\Toastr;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        if(!Auth::check()){
            // dd(!Auth::check());
            Auth::logout();
            return redirect('/login');
        }
    }
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $posts = Post::all();
        // dd('hello');
        $categories = Category::lists('name','id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();

        $user = Auth::user();
        $name = '';
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        
        $newPost = $user->posts()->create($input);
        if($file = $request->file('photo_id')){
            Photo::where('file',$name)->update(['post_id'=>$newPost->id]);
        }

        return redirect('/admin/posts');
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
        $posts = Post::findOrFail($id);

        $categories = Category::lists('name','id')->all();

        return view('admin.posts.edit', compact('posts', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsUpdate $request, $id)
    {
        $posts = Post::findOrFail($id);
        $input = $request->all();
        $file = $request->file('photo_id');
        if($file){
            $posts = Post::where('id', $id)->first();
            // dd($posts);
            $docs = Photo::find($posts->photo_id);
            // dd($docs);
            if($docs){
                $oldFileName = $docs->file;
                $file_path = public_path() . $oldFileName;
                if(file_exists($file_path)){
                    unlink($file_path);
                }
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $docs->update(['file'=>$name]);
                $input['photo_id'] = $docs->id;
            }
            else{
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $photo = Photo::create(['file'=>$name]);
                $input['photo_id'] = $photo->id;
            }
        }

        $posts->update($input);

        Toastr::success('Post Updated Successfully', $title = null, $options = []);

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        $docs = Photo::findOrFail($posts->photo_id);
        if($docs){
            $oldFileName = $docs->file;
            $file_path = public_path() . $oldFileName;
            if(file_exists($file_path)){
                unlink($file_path);
            }
            $docs->delete();
        }
        $posts->delete();

        Toastr::error('Post Deleted Successfully', $title = null, $options = []);

        return back();
    }

    public function post($id){
        $post = Post::findOrFail($id);
        // dd($post);
        // $comments = $post->comments()->whereIsActive(1)->get();
        return view('blog', compact('post'));
    }
}
