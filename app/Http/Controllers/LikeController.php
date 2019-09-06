<?php

namespace App\Http\Controllers;


use App\Repositories\LikeRepositoryEloquent;
use App\Repositories\PostRepositoryEloquent;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    private  $likeRepository;
    private  $postRepository;


    public function __construct(LikeRepositoryEloquent $likeRepository, PostRepositoryEloquent $postRepository)
    {
        $this->likeRepository = $likeRepository;
        $this->postRepository = $postRepository;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function set(Request $request, $id)
    {
        $uid = auth()->user()->id;
        $params = ['post_id' => $id, 'user_id' => $uid];

        $like = $this->likeRepository->findWhere($params)->first();
        if(!$like){
            $this->likeRepository->create($params);
            $post = $this->postRepository->find($id, ['user_like_first']);
            if(!$post['user_like_first']){
                $this->postRepository->update(['user_like_first' => $uid], $id);
            }
        }else{
            $like->delete();
        }

        return redirect()->back();
    }

}
