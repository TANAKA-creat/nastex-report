<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Photo;
use App\Models\Review;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::latest()->paginate(15);

        $user = Auth::user();
        // dd(Auth::user());
        return view('reports.index', compact('reports','user')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('reports.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReportRequest $request)
    {
        $report = new Report();

        // 2022/12/07下記一行を追記
        $report->user_id = \Auth::id();
        
        $report->title = $request->title;
        $report->body = $request->body;
        $report->save();
        return to_route('reports.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $reviews = $report->reviews()->get();

        $user = Auth::user();

        // 2022/12/07 下記を追記
        $user_id = Auth::id();

        return view('reports.show', compact('report','user','reviews','user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        // $users = User::all();
        // if($users !== 0){
        //     foreach($users as $user)
        //     $user = Auth::user();
        // }
        $user = Auth::user();

        return view('reports.edit', compact('report','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportRequest  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->title = $request->input('title');
        $report->body = $request->input('body');
        $report->update();

        return to_route('reports.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        
        return to_route('reports.index');
    }
}