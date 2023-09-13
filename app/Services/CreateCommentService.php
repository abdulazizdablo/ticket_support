<?php


namespace App\Services;

use App\Models\Comment;
use App\Models\Ticket;

class CreateCommentService{


    public function createComment($comment_data, Ticket $ticket){

$ticket->comments()->create([

'content' => $comment_data

]);

    }
}
