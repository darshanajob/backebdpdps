<?php

namespace App\Http\Controllers;

use App\Models\news;
use App\Http\Controllers\Controller;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
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
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
     */
    public function show(news $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(news $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, news $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
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
