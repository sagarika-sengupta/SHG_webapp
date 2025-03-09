<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;

abstract class Controller
{
    public function store(UserRequest $request)
        {
            // Since the validation is already handled, you can safely access $request->validated()
            $validatedData = $request->validated();

            // Your logic here, e.g., creating a new user or processing data
        }

}

