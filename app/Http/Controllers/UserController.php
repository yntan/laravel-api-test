<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\UserApiHelper;
use App\Http\Controllers\UserTransformer;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = UserApiHelper::validateIndexRequest($request);
        $users = User::listUsers($request);

        return $users->get();
    }
 
    public function show(User $user)
    {
        return $user;
    }

    public function store(Request $request)
    {
        $data = UserApiHelper::validateRequest($request);

        if (isset($data['phone'])) {
            $data['phone'] = str_replace('+', '', $data['phone']); //remove +
        }
        
        $user = User::create($data);
        $user = fractal($user, new UserTransformer())->toArray();

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $data = UserApiHelper::validateRequest($request);

        if (isset($data['phone'])) {
            $data['phone'] = str_replace('+', '', $data['phone']); //remove +
        }

        $user->update($data);

        return response()->json(["message"=>"Success"], 200);
    }

    public function delete(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
