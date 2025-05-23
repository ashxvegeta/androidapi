<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    public function register(Request $request){



        try{
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password'=> 'required|confirmed|min:6',
            'age'=>'required|integer|min:1'

        ]);

        $user = User::create([
            'name'=> $validated['name'],
            'email'=> $validated['email'],
            'password'=> Hash::make($validated['password']),
            'age'=>$validated['age']
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'=>true,
            'message' => 'User registered successfully',
            'token' => $token,
            'user' => $user

        ]);    
        }catch(ValidationException $e){
              return response()->json([
                'status'=>false,
                'message'=>'Validation false',
                  'errors'=> $e->errors()
              ],422);
        }catch(\Exception $e){
 return response()->json([
                'status'=>false,
                'message'=>'Registrstion failed',
                  'errors'=> $e->getMessage()
              ],500);
        }

    }

    public function login(Request $request){
        try {
            $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user = User::where('email',$credentials['email'])->first();
        if(!$user || !Hash::check($credentials['password'],$user->password)){
          return response()->json([
            'status'=>false,
             'message'=>'Invalid credentials'
          ],401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status'=>true,
            'mesage'=>'Login successful',
            'token'=>$token,
            'user'=>$user
        ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'=>false,
                'message'=>'Login falied',
                'errors'=>$e->getMessage()
            ],422);
        }
        catch(\Exception $e){
 return response()->json([
                'status'=>false,
                'message'=>'Registrstion failed',
                  'errors'=> $e->getMessage()
              ],500);
        }
        
    }
}
