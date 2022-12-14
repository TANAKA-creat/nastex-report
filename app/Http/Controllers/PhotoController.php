<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Report;
use App\Models\User;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $photos = Photo::latest()->paginate(15);

        return view('photos.index', compact('user','photos'));
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
     * @param  \App\Http\Requests\StorePhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhotoRequest $request)
    {
        $photo = new Photo();

        // 2022/12/07 下記一行を追記
        $photo->user_id = \Auth::id();

        $photo->title = $request->input('title');
        $photo->image = $request->input('image');
        if(request('image')) {
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His'). '_' . $original;
            request()->file('image')->move('storage/images', $name);
            $photo->image = $name;
        }
        $photo->save();

        // return to_route('photos.show');
        // return redirect()->route('photos.show',compact('photo'));
        return redirect()->route('photos.index', ['photo' => $photo->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo, User $user)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        
        return view('photos.show', compact('photo','user','user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhotoRequest  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        return to_route('photos.index');
    }
}
