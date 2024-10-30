<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\services\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserFormRequest $request) // invoke because You do one job
    {
            // make request to validate data
        $lang = $request->header('lang', 'en');
        $translate = new GoogleTranslate($lang);
//        dd($lang); //test lang
        $data=$request->validated();
        //if Duplicate email
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json([
                'error' => $translate->translate('already has been email')],402);
        }
        $existingUser_phone= User::where('phone', $request->phone)->first();
        if ($existingUser_phone) {
            return response()->json([
                'error' => $translate->translate('already has been phone')],403);
        }
        //$data['password'] =bcrypt($data['password']);
        //hashed password improve this (add function in model)because in edit profile repeat the best not repeat
        $user=User::query()->create($data);//create new user in database in PhpMyAdmin
        // إنشاء توكن جديد للمستخدم
        $token =$user->createToken('YourAppName')->plainTextToken;
        return response()->json([
            'message' => $translate->translate('Registration successful!'),
            "username" => $translate->translate($data["username"]), // ترجمة اسم المستخدم
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password'=>$data['password'],
            "type" => $translate->translate($data["type"]), // ترجمة النوع
            "Category_user" => $translate->translate($data["category_user"]), // ترجمة النوع
            'token' => $token // إرجاع الـ Token
        ], 300);
    }
}
