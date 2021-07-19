<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorite\FavoriteRequest;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /**
     * Create a new CartController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['store','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * for Admin only
     * 
     */
    public function index() // Secured Endpoint
    {
        $favorites = DB::table('favorites')->paginate(5);
        
        return response()->json([
            'success' => true,
            'payload' => $favorites
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * for Auth User
     * 
     */
    public function store(FavoriteRequest $request) // Secured Endpoint
    {
        $request = $request->validated();

        $favorite = Favorite::create( $request );

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Favorite $favorite
     * @return \Illuminate\Http\Response
     * 
     * for Admin only
     * 
     */
    public function show(Favorite $favorite) // Secured Endpoint
    {
        return response()->json([
            'success' => true,
            'payload' => $favorite
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Favorite $favorite
     * @return \Illuminate\Http\Response
     * 
     * for specific user, who created this recored 
     * 
     */
    public function update(FavoriteRequest $request, Favorite $favorite) // Secured Endpoint
    {
        if ($favorite->user_id != Auth::user()->id ) 
        {
            return response()->json([
                'message' => "Unauthenticated, this action for specific user only",
            ],401);
        }
        
        $request = $request->validated();

        $favorite = $favorite->update( $request );

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Favorite $favorite
     * @return \Illuminate\Http\Response
     * 
     * for specific user, who created this recored 
     * 
     */
    public function destroy(Favorite $favorite) // Secured Endpoint
    {
        if ($favorite->user_id != Auth::user()->id ) 
        {
            return response()->json([
                'message' => "Unauthenticated, this action for specific user only",
            ],401);
        }

        $favorite = $favorite->delete( $favorite );

        if ($favorite) return response()->json([
            'success' => true,
        ]);
    }
}
