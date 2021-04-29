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
    public function index(Request $request, $s = null)
    {
        if(is_null($s)) {
            return News::getAll(auth()->user()->is_admin);
        }
        return News::findByTitle($s, auth()->user()->is_admin);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        if(auth()->user()->is_admin) {
            return News::create($request->validated());
        }
        return response([
            'message' => 'You do not have sufficient rights for this operation'
        ], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return News::getOne($id, auth()->user()->is_admin);
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
        if(auth()->user()->is_admin) {
            $fields = $request->validated();
            $news->status = $fields['status'];
            $news->save();
            return $news;
        }
        return response([
            'message' => 'You do not have sufficient rights for this operation'
        ], 403);
    }
}
