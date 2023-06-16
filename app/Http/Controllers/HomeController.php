<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use App\Contact;
use App\Donner;
use TCG\Voyager\Models\Post;

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
        return view('home');
    }


    public function store(Request $request)
    {
        $contact = new Contact();

        $contact->name = $request->input('Name');
        $contact->email = $request->input('Email');
        $contact->object = $request->input('Object');
        $contact->message = $request->input('Message');

        $contact->save();

        return redirect()->route('home', ['#contact-us'])->with('success', 'Message envoyé');
    }

    // blog method
    public function blog()
    {
        $posts = Post::paginate(2);
        return view('blog.blog', ['posts' => $posts]);
    }

    // method for single post
    public function single_post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        //dd($post);
        return view('blog.blog_show', ['post' => $post]);
    }

    // method for donner_sang
    public function donner_sang()
    {
        return view('donner_sang');
    }

    // method for save donneur de sang with map
    public function save_donneur_du_sang(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'date' => 'required',
            'url' => 'required',
        ], [
            'name.required' => "🔥 excuse moi le Nom il est nécessaire 🔥",
            'mobile.required' => "🔥 excuse moi le Téléphone il est nécessaire  🔥",
            'date.required' => "🔥 excuse moi La Date du donne sang il est nécessaire  🔥",
            'url.required' => "🔥 excuse moi il est nécessaire de sélectionner le center de donne sang dans la map 🔥",
        ]);

        Donner::create([
            'donner_fullname'   => $request->get('name'),
            'donner_mobile'     => $request->get('mobile'),
            'donner_date'       => $request->get('date'),
            'donner_url_map'    => $request->get('url'),
            'donner_latitude'   => $request->get('lat'),
            'donner_langtitude' => $request->get('lng'),
        ]);

        return redirect()->back()->with('success', 'La réservation pour donne sang il est faire avec success');
    }
}
