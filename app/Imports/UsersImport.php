<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use App\Models\UsersMembership;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Base\Constants\Auth\Role; 

class UsersImport implements ToModel
{
    public function model(array $row)
    {
         $created_params = [
            'name' => $row[0],
            'mobile' => $row[1],
            'email' => $row[2],
            'userid' => $row[3],
            'raw_p' => $row[4], // Storing the raw password
            'password' => Hash::make($row[4]), // Encrypting the password
        ];
        
        $user = User::create($created_params); 
        
        $member_ship_data = new UsersMembership();
        $member_ship_data->user_id = $user->id;
        $member_ship_data->membership_type = 1;
        $member_ship_data->date = Carbon::now('Asia/Kolkata')->format("Y-m-d H:i:s");
        $member_ship_data->amount = 20000;
        $member_ship_data->expiry_date = Carbon::now('Asia/Kolkata')->addYear()->format("Y-m-d H:i:s");
        $member_ship_data->is_lifetime_member = 1;
        $member_ship_data->is_paid = 0;
        $member_ship_data->save();
        $user->attachRole(Role::USER);
        return $user;
    }
}
 