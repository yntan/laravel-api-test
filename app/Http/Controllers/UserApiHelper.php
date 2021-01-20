<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserApiHelper
{
    public static function validateRequest(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|min:1|max:100',
            'email' => 'required|email',
            'phone' => 'sometimes|required|string|min:10|max:50',
            'age' => 'sometimes|required|string|min:1|max:5'
        ]);

        return $validatedData;
    }

    public static function validateIndexRequest(Request $request)
    {
        $validatedData = $request->validate([
            'sort' => 'required_with:order',
            'order' => 'required_with:sort'
        ]);

        return $validatedData;
    }
}