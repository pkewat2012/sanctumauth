<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NotificationEvent;
use App\Models\User;
use Str;
use Hash;
use DB;

class NotificationController extends Controller
{
    public function store_data(){
        $add = User::Create([
            'name' => "pk_".Str::random(10),
            'username' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            
        ]);
       
        event(new NotificationEvent($add->name));
    }

    public function get_users(){

        $orderBy = DB::table('users')->select('id', 'name', 'email')->orderBy('id', 'desc');
        $total_temp = $orderBy->get();
        $recordsTotal = count($total_temp);
        $dataAry = array();
        foreach ($total_temp as $key => $row) {
            $tempAry = array();
            $tempAry['id'] = $row->id;
            $tempAry['name'] = $row->name;
            $tempAry['email'] = $row->email;
        
           
            array_push($dataAry, $tempAry);
        }
        echo json_encode(array(
            'draw' => '',
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $dataAry
        ));

    }
}
