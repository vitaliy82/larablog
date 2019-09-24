<?php

namespace App\Repositories;

use App\Entities\Like;
use App\Entities\Post;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class LileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LikeRepositoryEloquent extends BaseRepository implements LikeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Like::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        //$this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Store a newly created like in storage.
     *
     * @param $id
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function set($id)
    {
        $this->togglePostIfUserFirstLiked($id)->create(['post_id' => $id, 'user_id' => auth()->user()->id]);
    }

    /**
     * Remove like from storage.
     *
     * @param $id
     */
    public function clean($id)
    {
        $this->togglePostIfUserFirstLiked($id)->deleteWhere(['post_id' => $id, 'user_id' => auth()->user()->id]);
    }

    /**
     * toggle field user_like_first
     *
     * @param $id
     * @return $this
     */
    protected function togglePostIfUserFirstLiked($id)
    {
        $user_id = auth()->user()->id;
        $post = Post::find($id);
        if ($post['user_like_first'] == $user_id) {
            $post->user_like_first = null;
        } elseif (!$post['user_like_first']) {
            $post->user_like_first = $user_id;
        }
        $post->save();
        return $this;
    }

}
