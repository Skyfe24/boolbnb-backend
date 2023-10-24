<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        // Validation form
        $validator = Validator::make(
            $data,
            [
                'email' => 'required|email',
                'text' => 'required|string|max:300',
            ],
            [
                'email.required' => 'Devi inserire una mail.',
                'email.email' => 'L\'email non è valida.',
                'text.required' => "Devi inserire il contenuto.",
                'text.max' => "Il corpo del messaggio deve contenere meno di 300 caratteri."
            ]
        );

        // If validation fails, return errors bag & conver into object
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if (empty($data['name'])) $data['name'] = 'Anonimo';

        $message = new Message();
        $message->fill($data);
        $message->save();
        return response()->json($message);
    }
}
