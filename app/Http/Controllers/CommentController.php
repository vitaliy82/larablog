<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use App\Repositories\CommentRepositoryEloquent;
use App\Validators\PostValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class CommentController extends Controller
{
    /**
     * @var commentRepositoryEloquent
     */
    protected $commentRepository;

    /**
     * PostsController constructor.
     *
     * @param CommentRepositoryEloquent $commentRepository
     */
    public function __construct(CommentRepositoryEloquent $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->commentRepository->create($request->all());
            return redirect()->back()->with('success', 'Post commented.');
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
