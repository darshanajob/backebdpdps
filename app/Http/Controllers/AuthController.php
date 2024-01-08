<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    private $repository;
    private  $userRepository;

    public function __construct(Repository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }


    public function register(Request $request)
    {

        define("App\Http\Controllers\ADMIN", 1);
        define("App\Http\Controllers\GS", 2);
        define("App\Http\Controllers\Customer", 3);
        define("App\Http\Controllers\Member", 4);
        define("App\Http\Controllers\Officer", 5);

        $fields = $request->validate([
            'requesttype' => 'required|integer', // Make sure it's an integer
        ]);
        if ($fields['requesttype'] == ADMIN) {

//            $field = $request->validate([
//                'email' => 'required|string|unique:users,email',
//                'password' => 'string|confirmed',
//                'is_active' => 'required',
//                'type' => 'required',
//                'name' => 'required',
//                'nic' => 'required',
//                'mobileNo' => 'required'
//            ]);

            // Call the registerNew method with $field data
            $response = $this->repository->registerNew($request);
            return response($response, 201);

        } elseif ($fields['requesttype'] == GS) {

            $response = $this->repository->registerNew($request);

            return response($response, 201);

        } elseif ($fields['requesttype'] == Customer) {

            $response = $this->repository->registerNew($request);

            return response($response, 201);

        } elseif ($fields['requesttype'] == Member) {

            $response = $this->repository->registerNew($request);

            return response($response, 201);

        }elseif ($fields['requesttype'] == Officer) {

            $response = $this->repository->registerNew($request);

            return response($response, 201);

        }
    }


    public function activate(Request $request)
    {
        $response = $this->userRepository->activate($request);
        return response($response, 201);
    }


    public function login(Request $request)
    {
        $response = $this->repository->login($request);
        return response($response, 201);
    }


}
