<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function create(Request $request) {

        //https://laravel.com/docs/10.x/validation
        $validator = Validator::make($request->all(), [
            'description' => ['required', 'max:255'],
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'user_id' => ['required', 'exists:users,id']
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        //Qui dovrò agire su DB facendo un INSERT
        $review = new Review();
        $review->description = $request->input('description');
        $review->stars = $request->input('stars');
        $review->user_id = $request->input('user_id');
        $review->save();

        return response()->json($review, 201);

    }

    public function delete(Request $request, $id) {
        //DELETE http://localhost:8000/api/reviews/7
        //$id = 7

        //Operazione di DELETE su DB

        $review = Review::where('id', '=', $id)->findOrFail();
        $review->delete();
        return response()->json(null, 204);
    }

    public function read(Request $request, $id) {
        //GET http://localhost:8000/api/reviews/3
        //$id=3

        //Operazione di SELECT su DB
        $review = Review::where('id', '=', $id)->with('user')->findOrFail();
        return response()->json($review);
    }

    public function readAll(Request $request) {
        //Operazione di SELECT su DB
        $reviews = Review::with('user')->get();
        return response()->json($reviews);
    }

    public function update(Request $request, $id) {
        //PUT http://localhost:8000/api/reviews/22
        //$id=22     

        //https://laravel.com/docs/10.x/validation
        $validator = Validator::make($request->all(), [
            'description' => ['required', 'max:255'],
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'user_id' => ['required', 'exists:users,id']
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        //Ora eseguo la UPDATE su database
        $review = Review::where('id', '=', $id)->findOrFail();
        $review->description = $request->input('description');
        $review->stars = $request->input('stars');
        $review->user_id = $request->input('user_id');
        $review->save();

        return response()->json($review);

    }
}
