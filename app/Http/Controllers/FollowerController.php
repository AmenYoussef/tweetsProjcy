<?php

namespace App\Http\Controllers;
use DB;



use Illuminate\Http\Request;
use App\Models\follower;


class FollowerController extends Controller
{
    //

    public function addfolower(Request $request) {
        //
        $request->validate([
            'userID' => ['required'],
            'folowerID' => ['required']
        ]);

        

        $follower = Follower::create($request->all());

        return redirect()->back();
    }

    public function unfolower(Request $request) {
        

        DB::delete('delete from followers where id = ?',[$request->id]);
        return redirect()->back();
    }

}
