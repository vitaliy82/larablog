<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepositoryEloquent;
use App\Validators\PostValidator;
use App\Entities\Post;

/**
 * Class PostsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PostsController extends Controller
{
    /**
     * @var PostRepositoryEloquent
     */
    protected $postRepository;

    /**
     * @var PostValidator
     */
    protected $validator;

    /**
     * PostsController constructor.
     *
     * @param PostRepositoryEloquent $postRepository
     * @param PostValidator $validator
     */
    public function __construct(PostRepositoryEloquent $postRepository, PostValidator $validator)
    {
        $this->postRepository = $postRepository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->postRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $posts = $this->postRepository->all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for posting the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create', Post::class)) {
            return view('posts.create');
        }
        return redirect()->route('post.index')->with('message', 'permission denied.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PostCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $post = $this->postRepository->create($request->all());
            return redirect()->route('post.show', ['id' => $post->id])->with('message', 'Post Created.');
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        if (auth()->user()->can('update', $post)) {
            return view('posts.edit', compact('post'));
        }

        return redirect()->route('post.index')->with('message', 'permission denied.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $post = $this->postRepository->update($request->all(), $id);

            return redirect()->route('post.show', ['id' => $post->id])->with('message', 'Post Updated.');
        } catch (ValidatorException $e) {

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postRepository->delete($id);

        return redirect()->route('post.index')->with('message', 'Post deleted.');
    }
}
