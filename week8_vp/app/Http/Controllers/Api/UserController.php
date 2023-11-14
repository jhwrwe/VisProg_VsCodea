<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Catch_;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getAllUser(){
        $users = User::all();
        return UserResource::collection($users);
    }
    public function checkPassword(){
        $users = User::all();
        $check =[];

        foreach($users as $user){
            array_push($check,
            Hash::check("Evan1234", $user->password)
        );
        }
        return $check;
    }


    public function createUser(Request $request){
        try{
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->age = $request->age;
        $user->save();

        // User::create($request);

        return[
            'status'=> Response::HTTP_OK,
            'message'=> "Success",
            'data'=>$user
        ];
    } Catch(Exception $e){
        return [
            'status'=> Response::HTTP_INTERNAL_SERVER_ERROR,
            'message'=> $e->getMessage(),
            'data'=> $user
            ];
        }
}
public function updateUser(Request $request){
    if(!empty($request->email)){
    $user = User::where('email',$request->email)->first();
        }else{
            $user = User::where('id',$request->id)->first();
        }
        if(!empty($user)){
           try{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->age = $request->age;
            $user->save();
            return [
            'status'=> Response::HTTP_OK,
            'message'=> 'Success',
            'data'=>$user
            ];
           }catch(Exception $e){
            return [
                'status'=> Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'=> $e->getMessage(),
                'data'=> $user
                ];
           }
        }
        return[
            'status'=> Response::HTTP_NOT_FOUND,
            'message'=> 'User not found',
            'data'=> []
        ];
    }
    public function deleteUser(Request $request)
    {
        if (!empty($request->id)) {
            $user = User::where('id', $request->id)->first();
        } else {
            $user = User::where('email', $request->email)->first();
        }
        if (!empty($user)) {
            try {
                $user->delete();
                return [
                    'status' => Response::HTTP_OK,
                    'message' => 'Success',
                    'data' => $user
                ];
            } catch (Exception $e) {
                return [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                    'data' => $user
                ];
            }
        } else {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'USER NOT FOUND',
                'data' => $user
            ];
        }
    }
}



