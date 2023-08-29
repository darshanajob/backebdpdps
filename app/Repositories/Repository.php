<?php
namespace App\Repositories;
use App\Models\Payments;
use App\Models\Tax;
use App\Models\Teachers;
use App\Models\WaterSupply;
use App\Reposi;
use App\Models\User;


class Repository{
 /*   public function registerNew(array $data){
        $token = $user->createToken('apptoken')->plainTextToken;
        $user->assignRole('admin');
        $user = User::create([
            'nic' => $data['nic'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'mobileNo' => $data['mobileNo'],
            'name' => $data['name']
        ]);

        $responce = [
            'user' => $user,
            'token' => $token,

        ];
        return response($responce, 201);
    }*/

    public function addNewWater(array $data){

        $user = User::create([
            'name' => $data['aname'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $token = $user->createToken('apptoken')->plainTextToken;

     //   $user->assignRole('teacher');

        $adminDetails = User::latest()->first()->id;

        $teacher = WaterSupply::create([
            'tele' => $data['tele'],
            'aname' => $data['aname'],
            'distance' => $data['distance'],
            'taxNo' => $data['taxNo'],
            'scheme' => $data['scheme'],
            'service' => $data['service'],
              'address' => $data['address'],
            'user_id ' => $user->id,
        ]);

        $responce = [
            'teacher' => $teacher,
            'token' => $token
        ];
        return $responce;
    }

    public function addNewTax($fields){
        $taxCal = Tax::findbynic($fields->nic);
        if($taxCal){
            $taxCal = Tax::create([
                'name' => $fields['name'],
                'nic' => $fields['nic'],
                'amount' => $fields['amount'],
                'account' => $fields['account'],
                'telephone' => $fields['telephone'],
                'description' => $fields['description'],
                'email' => $fields['email'],
            ]);
            $taxId = Tax::latest()->first();
            $payment = Payments::create([
                'year' => $fields['year'],
                'amount' => $fields['amount'],
                'tax_id' => $taxId,
                'payment_type' => $fields['payment_type']
            ]);
        }else{
       /*     $taxCal->name =  $fields['name'];
            $taxCal->nic =  $fields['nic'];
            $taxCal->ammount =  $fields['ammount'];
            $taxCal->account =  $fields['account'];
            $taxCal->ammount =  $fields['ammount'];
            $taxCal->telephone =  $fields['telephone'];
            $taxCal->description =  $fields['description'];
            $taxCal->save();*/

            $payment = Payments::create([
                'year' => $fields['year'],
                'amount' => $fields['amount'],
                'tax_id' => $taxCal->id,
                'payment_type' => $fields['payment_type']
            ]);
        }

        return [
            'tax' => $payment,
        ];
    }
}


