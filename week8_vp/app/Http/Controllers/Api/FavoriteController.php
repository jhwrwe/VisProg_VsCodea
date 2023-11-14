<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Models\favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavoriteController extends Controller
{
    public function ListFavorit(Request $request){
        $user = User::where("id", $request->id)->first();
        $favorits = $user->favorits()->get();


        return[
            'status'=> Response::HTTP_OK,
            'message'=>'Success',
            'data'=> FavoriteResource::collection($favorits)

        ];

    }
    public function CreateFavorit (Request $request){
        $favorit = new favorite();
        $favorit->user_id = $request->user_id;
        $favorit->movie_id = $request->movie_id;
        $favorit->save();
        return[
            'status'=> Response::HTTP_OK,
            'message'=>'Success',
            'data'=> $favorit

        ];
    }
    public function DeleteFavorit (Request $request){
        $favorit = favorite::where('id', $request->id)->first();
        $favorit->delete();
        return[
            'status'=> Response::HTTP_OK,
            'message'=>'deleted',
            'data'=> $favorit

        ];
    }

}
