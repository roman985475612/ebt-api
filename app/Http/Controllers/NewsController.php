<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\StatusPatchRequest;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(empty($request->s)) {
            return News::all();
        }
        return News::findByTitle($request->s);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        return News::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return $news;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StatusPatchRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(StatusPatchRequest $request, News $news)
    {
        $validated = $request->validated();
        $news->status = $validated['status'];
        $news->save();
        return $news;
    }
}
