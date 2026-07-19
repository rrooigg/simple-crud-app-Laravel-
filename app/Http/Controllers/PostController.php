<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        //remove html tags from both title & body
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        //addes a new key('user_id) & returns the id of the authenticateed user 
        $incomingFields['user_id'] = Auth::id(); 

        Post::create($incomingFields);
        
        return redirect('/');
    }

    public function showEditScreen(Post $post) {
        //if your not the author of the post redirect back home
        if(Auth::user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }
    public function updatePost(Post $post, Request $request) {
        if(Auth::user()->id !== $post['user_id']) {
            return redirect('/');
        }
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        //update the post
        $post->update($incomingFields);
        return redirect('/');

    }

    public function deletePost(Post $post) {
        if(Auth::user()->id === $post['user_id']) {
            $post->delete();
        }
        return redirect('/');
    }
}
