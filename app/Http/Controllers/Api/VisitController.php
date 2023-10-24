<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisitController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        // Validation form
        $validator = Validator::make(
            $data,
            [
                'ip_address' => 'required|ip',
                'estate_id' => 'required|integer|min:1',
            ],
            [
                'ip_address.required' => 'L\'indirizzo ip è richiesto.',
                'ip_address.ip' => 'Il dato deve essere un indirizzo ip.',
                'estate_id.required' => "L\'id dell'annuncio è richiesto..",
                'estate_id.integer' => "L\'id dell'annuncio deve essere un numero.",
                'estate_id.min' => "L\'id dell'annuncio non può essere negativo.",
            ]
        );

        // If validation fails, return errors bag & convert into object
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $visit = new Visit();
        $visit->fill($data);
        $visit->date = '2023-10-14';
        $visit->save();
        return response()->json($visit);
    }
}
