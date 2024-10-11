<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', [CustomerController::class,'index']);


Route::get('/setup', function() {
    $credentials = [
        "email" => "ilias@gmail.com",
        "password" => "ilias"
    ];

    if (!Auth::attempt($credentials)) {
        $user = new User();
        $user->name = "Ilias";
        $user->email = $credentials["email"];
        $user->password = bcrypt($credentials["password"]);

        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $adminToken = $user->createToken("admin",["create","update","delete"])->plainTextToken;
            $normalToken = $user->createToken("normal",["create","update"])->plainTextToken;
            $basicToken = $user->createToken("basic",['create'])->plainTextToken;

            return [
                "superadmin"=>$adminToken,
                "admin"=>$normalToken,
                "basic"=>$basicToken,
            ];

        }
    }
});
