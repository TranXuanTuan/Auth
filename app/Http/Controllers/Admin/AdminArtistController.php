<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ArtistCategory;
use App\Model\Artist;
use Auth;
use Session;

class AdminArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::all();
        return view('admin.artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artistcategories = ArtistCategory::all();
        return view('admin.artists.create',compact('artistcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $ext = $request->file('avatar')->getClientOriginalExtension();
            $this->artist->avatar = $request->file('avatar')->storeAs(
                'public/artist_images', time() . '.' . $ext
            );
        }
        $this->validate($request, [
            'category_id' => 'required',
            'artist_name' => 'required|max:100',
            'intro' => 'required|max:100',
            ]);
        $category_id = $request['category_id'];
        $artist_name = $request['artist_name'];
        $intro = $request['intro'];
        $avatar = $request['avatar'];

        $artist = Artist::create($request->only('category_id','artist_name','intro','avatar'));
        return redirect()->route('admin.artists.index')
                ->with('flash_message','Artist successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('admin/artists'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artistCategory = ArtistCategory::findOrFail($id);
        return view('admin.artists.edit', compact('artistCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $artistCategory = ArtistCategory::findOrFail($id);
        $artistCategory->category_name = $request['category_name'];
        
        $artistCategory->save();

        return redirect()->route('artists.index', 
            $artistCategory->id)->with('flash_message','Artist successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artistCategory = ArtistCategory::findOrFail($id);
        $artistCategory->delete();

        return redirect()->route('artists.index')
            ->with('flash_message',
             'Artist successfully deleted');
    }
}
