<?php

namespace App\Http\Controllers;

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
    private $repository;
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
//        $request = $request->validate([
//            'isChecked' => 'required',
//            'endDateSelect' => 'string',
//            'startDateSelect' => 'required'
//        ]);
        $responce = $this->repository->addNewNews($request);
        return response($responce, 201);
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
