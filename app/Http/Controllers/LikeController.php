<?php

namespace App\Http\Controllers;


use App\Repositories\LikeRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    private  $likeRepository;
    private  $postRepository;

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
    public function create(Request $request, $id){
        $uid = auth()->user()->id;
        $params = ['post_id' => $id, 'user_id' => $uid];
        $this->likeRepository->create($params);
        $this->setUserIfFirstLikedPost($id, $uid);
        return redirect()->back();
    }

    /**
     * Remove like from storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id){
        $this->likeRepository->deleteWhere(['post_id' => $id, 'user_id' => auth()->user()->id]);
        return redirect()->back();
    }

    /**
     * @param $id
     * @param $uid
     */
    protected function setUserIfFirstLikedPost($id, $uid){
        $post = $this->postRepository->find($id);
        if(!$post['user_like_first']){
            $data = ['user_like_first' => $uid, 'text' => $post['text'], 'title' => $post['title']];
            $this->postRepository->update($data, $id);
        }
    }

}
