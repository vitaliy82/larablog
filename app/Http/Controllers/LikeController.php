<?php

namespace App\Http\Controllers;


use App\Repositories\LikeRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    private $likeRepository;
    private $postRepository;

    public function __construct(LikeRepository $likeRepository, PostRepository $postRepository)
    {
        $this->likeRepository = $likeRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * Store a newly created like in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create($id)
    {
        $this->likeRepository->set($id);
        return redirect()->back();
    }

    /**
     * Remove like from storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->likeRepository->clean($id);
        return redirect()->back();
    }

}
