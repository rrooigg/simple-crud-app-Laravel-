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
}
