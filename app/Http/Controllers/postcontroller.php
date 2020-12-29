<?php

namespace App\Http\Controllers;

use App\Models\pepe;
use Illuminate\Http\Request;

class postcontroller extends Controller
{
    /** 
    * @return void
    */
   public function __construct()
   {
       $this->middleware('auth');
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts=pepe::get();
        
        return view('admin.post.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //call the view admin.post.create
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);//para mostrarme que esta jalando y como
        $data=request()->validate([
            'title'=>'required|max:255',
            'image'=>'required|image',
            'post_content'=>'required',
            'pipodinero'=>'required',
            'numeropipo'=>'required'

        ]);

$fileNameWithTheExtension=request('image')->getClientOriginalName();
$fileName=pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
$extension=request('image')->getClientOriginalExtension();

$newFileName=$fileName . '_' . time() . '.' . $extension;
$path=request('image')->storeAs('public/images/posts_images',$newFileName);

$post=new pepe();
            $post->pipo=request('title');
            $post->contenido=request('post_content');
            $post->numerodepipo=request('numeropipo');
            $post->dinerodepipo=request('pipodinero');
            $post->image_url=$newFileName;
            $post->save();
            return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pepe  $pepe
     * @return \Illuminate\Http\Response
     */
    public function show(pepe $pepe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pepe  $pepe
     * @return \Illuminate\Http\Response
     */
    public function edit(pepe $post)
    {
        $post= pepe::find($post->id);

        return view('admin/post/edit', ['post'=>$post]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pepe  $pepe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pepe $post)
    {
        $data=request()->validate([
            'title'=>'required|max:255',
            'image'=>'required|image',
            'post_content'=>'required',
            'pipodinero'=>'required',
            'numeropipo'=>'required'

        ]);

$fileNameWithTheExtension=request('image')->getClientOriginalName();
$fileName=pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
$extension=request('image')->getClientOriginalExtension();

$newFileName=$fileName . '_' . time() . '.' . $extension;
$path=request('image')->storeAs('public/images/posts_images',$newFileName);

$post= pepe::findOrFail($post->id);
            $post->pipo=request('title');
            $post->contenido=request('post_content');
            $post->numerodepipo=request('numeropipo');
            $post->dinerodepipo=request('pipodinero');
            $post->image_url=$newFileName;
            $post->save();
            return redirect('/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pepe  $pepe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $post=pepe::find($request->post_id);
        $post->delete();
        return redirect('/post');
    }
}
