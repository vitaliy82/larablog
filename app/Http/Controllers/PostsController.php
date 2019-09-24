<?php

namespace App\Http\Controllers;

use App\Entities\Post;
use App\Http\Requests;
use App\Repositories\PostRepository;
use App\Validators\PostValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class PostsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PostsController extends Controller
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * @var PostValidator
     */
    protected $validator;

    /**
     * PostsController constructor.
     *
     * @param PostRepository $postRepository
     * @param PostValidator $validator
     */
    public function __construct(PostRepository $postRepository, PostValidator $validator)
    {
        $this->postRepository = $postRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->paginate(3, request()->page);

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
        if ($permission = $this->hasPermission('create')) {
            return $permission;
        }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        if ($permission = $this->hasPermission('create')) {
            return $permission;
        }
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $request->merge(['text' => resolve('stopWord')->filter($request->all()['text'])]);
            $post = $this->postRepository->create($request->all());

            return redirect()->route('post.show', ['id' => $post->id])->with('success', 'Post Created.');
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
        if ($permission = $this->hasPermission('update', $id)) {
            return $permission;
        }

        return view('posts.edit', ['post' => $this->postRepository->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        if ($permission = $this->hasPermission('update', $id)) {
            return $permission;
        }
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $request->merge(['text' => resolve('stopWord')->filter($request->all()['text'])]);
            $post = $this->postRepository->update($request->all(), $id);

            return redirect()->route('post.show', ['id' => $post->id])->with('success', 'Post Updated.');
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
        if ($permission = $this->hasPermission('delete', $id)) {
            return $permission;
        }
        $this->postRepository->delete($id);

        return redirect()->route('post.index')->with('success', 'Post deleted.');
    }

    /**
     * @param String $action
     * @param null $id
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    protected function hasPermission(String $action, $id = null)
    {
        $post = is_null($id) ? Post::class : $this->postRepository->find($id);
        if (!auth()->user() || !auth()->user()->can($action, $post)) {
            return redirect()->route('post.index')->with('error', 'permission denied.');
        }
        return false;
    }

}
