<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{



    public function store(CreateCommentRequest $request)
    {
        Comment::create($request->validated());
        //$ticket->comments()->create($request->validated());
        return back()->withMessage('Comment has been added');
    }
}
