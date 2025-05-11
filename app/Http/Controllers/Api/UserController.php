<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        if ($users->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'no data found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'data fetched successfully',
            'data' => $users
        ], 200);
    }



public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'age' => 'required|integer|min:1',
        'email' => 'required|email|unique:users,email'
    ]);

    $user = User::create($validated);

    return response()->json([
        'status' => true,
        'message' => 'User created successfully',
        'data' => $user
    ], 201);
}

public function update(Request $request,$id){

    $user = User::find($id);
    if(!$user){
        return responce()->json([
            'status'=> false,
            'message'=> 'user not found',
            'data'=> null
        ]);
    }
    $validated = $request->validate([
    'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $id,
        'age' => 'required|integer|min:0',
    ]);
    $user->update($validated);
    if($user){
        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ], 200);
    }else{
        return response()->json([
            'status' => false,
            'message' => 'User not updated',
            'data' => null
        ], 500);
    }
}

public function destroy($id){
     $user = User::find($id);
     if(!$user){
        return response()->json([
            'status' => false,
            'message' => 'user not found',
            'data' => null
        ], 404);
     }else{

        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'user deleted successfully',
            'data' => null
        ], 200);

     }
}

public function toggleStatus($id){

    $user = User::find($id);
    if(!$user){
        return response()->json([
            'status' => false,
            'message' => 'user not found',
            'data' => null
        ], 404);
    }
    $user->status = $user->status == 1 ? 0 : 1;
    $user->save();
    return response()->json([
        'status' => true,
        'message' => 'user status updated successfully',
        'data' => $user
    ], 200);

}

}