<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\StopWordRepository;
use App\Validators\StopWordValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class StopWordsController.
 *
 * @package namespace App\Http\Controllers;
 */
class StopWordsController extends Controller
{
    /**
     * @var StopWordRepository
     */
    protected $stopWordRepository;

    /**
     * @var StopWordValidator
     */
    protected $validator;

    /**
     * StopWordsController constructor.
     *
     * @param StopWordRepository $stopWordRepository
     * @param StopWordValidator $validator
     */
    public function __construct(StopWordRepository $stopWordRepository, StopWordValidator $validator)
    {
        $this->stopWordRepository = $stopWordRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stopWords = $this->stopWordRepository->all();
        return view('stopWords.index', compact('stopWords'));
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
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $this->stopWordRepository->create($request->all());
            return redirect()->back()->with('success', 'StopWord created');
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stopWord = $this->stopWordRepository->find($id);
        return view('stopWords.edit', compact('stopWord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $this->stopWordRepository->update($request->all(), $id);

            return redirect()->route('stop-word.index')->with('success', 'Edit successful');
        } catch (ValidatorException $e) {

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->stopWordRepository->delete($id);
        return redirect()->back()->with('success', 'StopWord deleted.');
    }
}
