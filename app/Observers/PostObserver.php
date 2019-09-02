<?php

namespace App\Observers;

use App\Entities\Post;
use Illuminate\Http\UploadedFile;
use Image;

class PostObserver
{
    /**
     * Handle the post "creating" event.
     *
     * @param  \App\Entities\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->user_id = auth()->user()->id;
        $this->saveImage($post);
    }

    /**
     * Handle the post "updating" event.
     *
     * @param  \App\Entities\Post  $post
     * @return void
     */
    public function updating(Post $post)
    {
        if ($post->img  instanceof UploadedFile) {
            $this->saveImage($post);
        }
    }

    /**
     * Save image
     *
     * @param Post $post
     * @return void
     */
    protected function saveImage(Post $post){
        $resize = Image::make($post->img->getRealPath())
            ->resize(700, 700, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
        $hash = md5($resize->__toString());
        $path = "app/public/blog/{$hash}.jpg";
        $resize->save(storage_path($path));
        $post->img = "blog/{$hash}.jpg";
    }

}
