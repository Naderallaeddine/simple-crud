<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $fillingData=$request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        //to not insert html code
        $fillingData['title']=strip_tags($fillingData['title']);
        $fillingData['body']=strip_tags($fillingData['body']);

        $fillingData['user_id']=auth()->id();
        Post::create($fillingData);
        return redirect('/');
    }

    public function showEdit(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('edit-post',['post'=>$post]);
    }

    public function updatedPost(Post $post,Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $fillingData=$request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        //to not insert html code
        $fillingData['title']=strip_tags($fillingData['title']);
        $fillingData['body']=strip_tags($fillingData['body']);

        $post->update($fillingData);
        return redirect('/');
    }
    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/');
    }


}
