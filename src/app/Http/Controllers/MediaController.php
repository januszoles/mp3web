<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Input;
use Storage;

use App\Repositories\MediaRepository;
use App\Audio;
use App\Video;

class MediaController extends Controller {

    /**
     * The MediaRepository
     *
     * @var MediaRepository
     */
    protected   $mediaRepository;


    /**
     * Create a new controller instance.
     *
     * @param  MediaRepository  $mediarepository
     * @return void
     */
    public function __construct (MediaRepository $mediarepository) {
        // $this->middleware('auth');
        $this->mediaRepository  =   $mediarepository;
    }


    /**
     * Display a list of all audiotracks
     * @param  Request  $request
     * @return Response
     */
    public function listAudio (Request $request) {
        return view('welcome', [
            'tracks' =>  $this->mediaRepository->getTracksAudio()
        ]);
    }


    /**
     * Play - provide track's metadata as JSON
     * @param  Request  $request
     * @return Response
     */
    public function Play ($id) {
        $meta   =   $this->mediaRepository->getTrackMeta($id);
        $plays  =   $meta->get('plays', 0);
        $meta->put('plays', ++$plays);
        $this->mediaRepository->setTrackMeta($meta);
        return response()->json($meta);
    }


    /**
     * Rate - add like/dislike vote
     * @param  Request  $request
     * @return Response
     */
    public function Rate ($id, $vote) {
        $meta       =   $this->mediaRepository->getTrackMeta($id);
        $rateKey    =   $vote . 's';
        $rateCur    =   $meta->get($rateKey, 0);
        $meta->put($rateKey, ++$rateCur);
        $saveResult =   $this->mediaRepository->setTrackMeta($meta);
        $saveResult->put('action', $vote);
        return response()->json($saveResult);
    }


    /**
     * Create a new MediaFile.
     *
     * @return \Illuminate\Http\Response
     */
    public function create () {
        //
    }


    /**
     * Store an Media Track in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request) {
        //
    }


    /**
     * Update Media Track in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $bet
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request) {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($id) {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id) {
        //
    }

}