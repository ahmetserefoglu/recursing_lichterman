<?php

namespace AhmetSerefoglu\RecursingLichterman\Http\Controllers;

namespace AhmetSerefoglu\RecursingLichterman;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class UsersController extends Controller
{
    protected $successStatus = 200;
    protected $errorStatus = 400;

    public function store(Request $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|unique',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'code' => $this->errorStatus]);
        }

        $user = User::create($request->all());

        $user->fill([
            'secret' => Crypt::encrypt($request->secret)
        ])->save();

        $message['success'] = 'Kullanici Başarıyla Oluşturuldu';

        return response()->json(['message' => $message, 'code' => $this->successStatus]);
    }
}
