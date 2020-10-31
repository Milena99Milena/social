<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;

class EventController extends Controller
{
    public function index($id)
    {

        $event=Event::findOrFail($id); 

        return view('event',array(
            'event'=>$event,
        ));
    }
}
