<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Infopost;
use App\Comment;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        if(! empty($post)){
            abort(404);
        }

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $tags = Tag::all();

        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate($this->SetValidation());

        $data['slug'] = Str::slug($data['title'], '-');

        if(!empty($data['path_img'])){
            $data['path_img'] = Storage::disk('public')->put('images' , $data['path_img']);
        }

        $NewPost = new Post();
        $NewPost->fill($data);
        $saved = $NewPost->save();

        $data['post_id'] = $NewPost->id;
        $NewInfo = new InfoPost();
        $NewInfo->fill($data);
        $infoSaved = $NewInfo->save();

        if($saved && $infoSaved ){
            if(! empty($data['tags'])){
              $NewPost->tags()->attach($data['tags']);
            }
            return redirect()->route('posts.index');
        }else{
            return redirect()->route('homepage');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        /* dd($post); */
        if(empty($post)){
            abort(404);
        }

        

        

        
       

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        
        if(empty($post)){
            abort(404);
        }
        

        return view('posts.edit' , compact('post', 'tags'));
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
        $data = $request->all();
        $request->validate($this->SetValidation());

        $post = Post::find($id);

        $data['slug'] = Str::slug($data['title'], '-');

        if(! empty($data['path_img'])){
            if(! empty($post->path_img)){
                Storage::disk('public')->delete($post->path_img);
            }
            $data['path_img'] = Storage::disk('public')->put('images' , $data['path_img']);
        }
        
        $updated = $post->update($data);
        $data['post_id'] = $post->id;
        $info = InfoPost::where('post_id', $post->id)->first();
        $infoUpdate = $info->update($data);


        if ($updated && $infoUpdate) {
            return redirect()->route('posts.show', $post->slug);
        }else{
            return redirect()->route('homepage');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $title = $post->title;
        $image = $post->path_img;
        $deleted = $post->delete();

        if($deleted){
            if(!empty($image)){
                Storage::disk('public')->delete($image);
            }
            return redirect()->route('posts.index')->with('post-deleted', $title);
        }else{
            return redirect()->route('homepage');
        }
    }

    private function SetValidation(){
        return [
            'title' => 'required',
            'body' => 'required',
            'path_img' => 'mimes:jpg,bmp,png'
        ];
    }
}
