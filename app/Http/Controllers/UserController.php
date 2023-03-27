<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(Request $request) {

        //https://laravel.com/docs/10.x/validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'surname' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
            'age' => ['required', 'integer'],
            'title' => ['max:255']
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        //Qui dovrò agire su DB facendo un INSERT


    }

    public function delete(Request $request, $id) {
        //DELETE http://localhost:8000/api/users/7
        //$id = 7

        //Operazione di DELETE su DB
    }

    public function read(Request $request, $id) {
        //GET http://localhost:8000/api/users/3
        //$id=3

        //Operazione di SELECT su DB
    }

    public function readAll(Request $request) {
        //Operazione di SELECT su DB
    }

    public function update(Request $request, $id) {
        //PUT http://localhost:8000/api/users/22
        //$id=22     

        //https://laravel.com/docs/10.x/validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'surname' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
            'age' => ['required', 'integer'],
            'title' => ['max:255']
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        //Ora eseguo la UPDATE su database


    }
}
