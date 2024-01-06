<?php
namespace App\Repositories;
use App\Models\Complain;
use App\Models\Payments;
use App\Models\Tax;
use App\Models\Teachers;
use App\Models\WaterSupply;
use App\Reposi;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomEmail;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Vonage\Client\Credentials\Basic;
use Vonage\Client;
use Vonage\SMS\Message\SMS;
use Vonage\SMS\Message\SMSCollection;

class Repository{
    public function registerNew(array $data){

        $user = User::create([
            'nic' => $data['nic'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name' => $data['name'],
            'is_active' => $data['is_active'],
            'type' => $data['type'],
        ]);
        $token = $user->createToken('apptoken')->plainTextToken;
        $user->assignRole('admin');
        $responce = [
            'user' => $user,
            'token' => $token,

        ];
        return response($responce, 201);
    }

    public function addComplain(array $data){
        $complain = Complain::create([

            'topic' => $data['topic'],
            'complain_date' => $data['complain_date'],
            'status' => $data['status'],
        ]);
    }

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

        $basic  = new \Vonage\Client\Credentials\Basic("831cb65a", "LVg6EEtYjLd5vJ6A");
        $client = new \Vonage\Client($basic);
        $responsessssss = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("94778590204",  'PDPS', 'Call me if u get this A text message sent using the Nexmo SMS API')
        );
        $message = $responsessssss->current();

        if ($message->getStatus() == 0) {
            return "The message was sent successfully\n ";
        } else {
            return "The message failed with status: " . $message->getStatus() . "\n";
        }

        $recipient = "chinadaredareya@gmail.com";
        $subject = "test";
        $messagesss = "hutho";
        Mail::to($data['email'])->send(new CustomEmail($messagesss));

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

    public function  login($request)
    {
       // return $request;
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //check NIC
        $user = User::whereEmail($fields['email'])->with('roles')->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw new NotFoundHttpException('Please check email or Password !');
        } else {
            if ($user->status === "Disable") {
                throw new UnauthorizedHttpException(
                    "Account Is Disabled! Please Contact Administrator.",
                    "Account Is Disabled! Please Contact Administrator."
                );
            }
        }

        $token = $user->createToken('apptoken')->plainTextToken;

        return  $responce = [
            'user' => $user,
            'token' => $token,
        ];

        //return response($responce, 201);
        return response([
            'message' => $responce
        ], 200);
    }

}


