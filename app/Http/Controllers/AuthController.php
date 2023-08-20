<?php

namespace App\Http\Controllers;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }


    public function register(Request $request){
        define("Admin", 1);
        define("GS", 2);
        $fields = $request->validate([
            'requesttype' => 'required'
        ]);

        if($fields['requesttype'] == Admin){

            $fields = $request->validate([
                'email' => 'required|string|unique:users,email',
                'password' => 'string|confirmed',
                'is_active' => 'required',
                'type' => 'required',
                'name' => 'required'
            ]);
            $response = $this->repository->registerNew($data);
          //  $response = $this->teacherRepository->updatePassword($id, $fields, $request);
            return response($response, 201);

        }
    }
}
