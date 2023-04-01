<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(Request $request) {

        //https://laravel.com/docs/10.x/validation
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'max:255'],
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
        $user = new User();
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->title = $request->input('title');
        $user->save();

        return response()->json($user, 201);

    }

    public function delete(Request $request, $id) {
        //DELETE http://localhost:8000/api/users/7
        //$id = 7

        //Operazione di DELETE su DB

        $user = User::where('id', '=', $id)->findOrFail();
        $user->delete();
        return response()->json(null, 204);
    }

    public function read(Request $request, $id) {
        //GET http://localhost:8000/api/users/3
        //$id=3

        //Operazione di SELECT su DB
        $user = User::where('id', '=', $id)->with('reviews')->findOrFail();
        return response()->json($user);
    }

    public function readAll(Request $request) {
        //Operazione di SELECT su DB
        $users = User::with('reviews')->get();
        return response()->json($users);
    }

    public function update(Request $request, $id) {
        //PUT http://localhost:8000/api/users/22
        //$id=22     

        //https://laravel.com/docs/10.x/validation
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'max:255'],
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
        $user = User::where('id', '=', $id)->findOrFail();
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->title = $request->input('title');
        $user->save();

        return response()->json($user);

    }
}
