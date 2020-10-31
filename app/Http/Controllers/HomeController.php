<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth; //klasa za logovanog korisnika
use App\User;
use App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->get();
        $events=Event::orderBy('date','desc')->get();
        //var_dump($posts);

        $user=Auth::user();
        $following=$user->following;
        $followers=$user->followers;

        //odredjujemo mutual, following, followers, others
        $followingIds=$user->following->pluck('id')->toArray(); //id svih korisnika koje pratimo
        //var_dump($followingIds);
        $followerIds=$user->followers->pluck('id')->toArray(); //id svih korisnika koje mene prate
        $mutualIds=array_intersect($followingIds,$followerIds); //id uzajamnih prijatelja //funkcija za presek

        $followingIds=array_diff($followingIds,$mutualIds);
        $followerIds=array_diff($followerIds,$mutualIds);

        $mutuals=User::whereIn('id',$mutualIds)->orderBy('name')->get();
        $followers=User::whereIn('id',$followerIds)->orderBy('name')->get();
        $following=User::whereIn('id',$followingIds)->orderBy('name')->get();
        $others=User::whereNotIn('id',array_merge($mutualIds,$followerIds,$followingIds,array($user->id)))->orderBy('name')->get();
        //var_dump($mutuals);
       // var_dump($followerIds); var_dump($followingIds); var_dump($mutualIds);

        //echo $followers;
        //var_dump($following);
        //echo $following;
        return view('home',array(
            'objave'=>$posts,
            'following'=>$following,
            'followers'=>$followers,
            'mutuals'=>$mutuals,
            'others'=>$others,
            'events'=>$events,
        ));
    }

   
        public function publish()
        {
            //$_POST['content'] --> ovo je bilo u obicnom PHP-u
            $content = request('content'); // u Laravelu preko funkcije request, dobijamo ono sto je submitovano
            // Auth::user(); ->logovani korisnik
            $id = Auth::user()->id; // id logovanog korisnika
            if(!empty($content))
            {
                //ubacivanje novog reda u tabelu posts
                //1) kreirati novi objekat modela Post
                $post = new Post();
                //2) popunimo polja ovom objektu
                $post->user_id = $id;
                $post->content = $content;
                //3) pozvati metodu save();
                $post->save();
                //Redirekcija na home page
                return redirect('/home')->with('success', 'Post published!'); //with dodaje poruku nakon publishovanje
            }
            else
            {
                return redirect('/home')->with('error', 'Error: Post cannot be empty');
            }
        }
    
    

}
