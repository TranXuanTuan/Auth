<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Artist;
use App\Model\ArtistCategory;
use App\Model\Song;

class ArtistController extends Controller
{
    public function index()
    {
    	$artist_categories = ArtistCategory::all();
        $artists = Artist::paginate(12);
        return view('artists.index', compact('artists','artist_categories'));
    }

    public function show($category)
    {
        $artist_categories = Artist::where('category_id',$category)->get();
        return view('artists.show', compact('artist_categories'));
    }

    public function detail($id)
    {
        $artist = Artist::findorfail($id);
        return view('artists.detail', compact('artist'));
    }
}
