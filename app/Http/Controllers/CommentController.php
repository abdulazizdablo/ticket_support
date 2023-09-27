<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Models\Comment;


class CommentController extends Controller
{

    public function store(CreateCommentRequest $request)
    {
        Comment::create($request->validated());

        return back()->withMessage('Comment has been added');
    }
}
