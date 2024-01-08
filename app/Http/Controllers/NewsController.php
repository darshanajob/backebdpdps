<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\news;
use App\Http\Controllers\Controller;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = news::with("newsLocales")->get();
        $response = [
            "AllNews" => $news,
        ];
        return response($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
     */
    public function store(Request $request)
    {
//        $request = $request->validate([
//            'isChecked' => 'required',
//            'endDateSelect' => 'string',
//            'startDateSelect' => 'required'
//        ]);
        $responce = $this->repository->addNewNews($request);
        return response($responce, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
     */
    public function show(news $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
     */
    public function edit(news $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
     */
    public function update(Request $request, news $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
     */
    public function destroy(news $news)
    {
        //
    }
    public function getNewsCount()
    {
        $count = $this->repository->getPublishedNewsCount();
        $response = [
            "count" => $count,
        ];
        return response($response, 200);
    }
}
