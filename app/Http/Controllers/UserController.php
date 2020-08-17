<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
        {
            return response()->json(User::with(['orders'])->get());
        }

    public function login(Request $request)
        {
            $status = 401;
            $response = ['error' => 'Unauthorized'];

            if (Auth::attempt($request->only(['email', 'password']))) {
                $status = 200;
                $response = [
                    'user' => Auth::user(),
                    'token' => Auth::user()->createToken('brewery')->accessToken,
                ];
            }

            return response()->json($response, $status);
        }

    public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|max:20',
                'lastname' =>'required|max:20',
                'role' =>'required|in:"seller", "buyer"',
                'address' => 'nullable',
                'city' => 'nullable',
                'mobile' =>'nullable',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $data = $request->only(['firstname', 'lastname', 'email', 'password', 'role', 'address',
                                    'city', 'mobile']);
            $data['password'] = bcrypt($data['password']);

            $user = User::create($data);
        

            return response()->json([
                'user' => $user,
                'token' => $user->createToken('brewery')->accessToken,
            ]);
        }

    public function update(Request $request, User $user){
        $status = $user->update(
            $request->only(['firstname', 'lastname', 'email', 'password', 'address', 'city', 'mobile'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'User Updated!' : 'Error Updating User'
        ]);
    }

    public function show(User $user)
        {
            return response()->json($user);
        }

    public function showOrders(User $user)
        {
            return response()->json($user->orders()->with(['beer'])->get());
        }
}
