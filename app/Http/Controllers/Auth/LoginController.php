<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormlogin;
use App\Http\Resources\UserResource;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserFormlogin $request)//make form UserFormlogin write validate data
    {
        $lang = $request->header('lang', 'en');// في حاله عدم تحقق الشرط تكون اللغة en
        $translate = new GoogleTranslate($lang);//يستخدم لترجمة الجمل المطلوبة
        $creditial=$request->validated();
//        dd($creditial);
        if (auth()->attempt($creditial)){
            $data=auth()->user();
            return response()->json([
                'message' => $translate->translate('Login successful')]);

        }else{
            return response()->json([
            'error' => $translate->translate('email or password not correct')],405);

        }

    }

}
