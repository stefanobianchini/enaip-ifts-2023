<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function create(Request $request) {

        //https://laravel.com/docs/10.x/validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'classification' => ['required', 'integer'],
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        //Qui dovrò agire su DB facendo un INSERT
        $hotel = new Hotel();
        $hotel->name = $request->input('name');
        $hotel->classification = $request->input('classification');
        $hotel->save();

        return response()->json($hotel, 201);

    }

    public function delete(Request $request, $id) {
        //DELETE http://localhost:8000/api/hotels/7
        //$id = 7

        //Operazione di DELETE su DB

        $hotel = Hotel::where('id', '=', $id)->findOrFail();
        $hotel->delete();
        return response()->json(null, 204);
    }

    public function read(Request $request, $id) {
        //GET http://localhost:8000/api/hotels/3
        //$id=3

        //Operazione di SELECT su DB
        $hotel = Hotel::where('id', '=', $id)->with('reviews')->findOrFail();
        return response()->json($hotel);
    }

    public function readAll(Request $request) {
        //Operazione di SELECT su DB
        $hotels = Hotel::with('reviews')->get();
        return response()->json($hotels);
    }

    public function update(Request $request, $id) {
        //PUT http://localhost:8000/api/hotels/22
        //$id=22     

        //https://laravel.com/docs/10.x/validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'classification' => ['required', 'integer']
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        //Ora eseguo la UPDATE su database
        $hotel = Hotel::where('id', '=', $id)->findOrFail();
        $hotel->name = $request->input('name');
        $hotel->classification = $request->input('classification');
        $hotel->save();

        return response()->json($hotel);

    }
}
