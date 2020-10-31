<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileContoller extends Controller
{
    public function viewProfile($id)
    {
        //nadjemo korisnika sa zataim id-jem
        //$user=User::find($id); //ne mora da postoji pk
        $user=User::findOrFail($id); //mora da postoji pk
        $posts=$user->posts()->orderBy('created_at','desc')->get();
        //echo $user->posts; //na osnovu metode posts() iz klase user
        return view('profile', array(
            'user'=>$user,
            'posts'=>$posts,
        ));
    }
}
