<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Projects;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactUs;
use App\Models\About;
use Illuminate\Support\Facades\Mail;
use App\Models\Post;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Storage;
use App\Models\Services;

class DefortController extends Controller
{
    public function index(){
        $posts=Post::published()
            ->with('category')
            ->latest('published_at')
            ->paginate(3);
        return view('index', ['posts' => $posts]);
    }

    public function projects(){
        $projects = Projects::latest()->paginate(6);
        return view('projects.projects', compact('projects'));
    }

    public function viewproject($id){
        $project = Projects::where('id', $id)->first();
        return view('projects.viewproject', compact('project'));
    }

    //Contact
    public function contact(){
        return view('contact');
    }

    public function addcontact(ContactRequest $request){
        $validated = $request->validated();
        Contact::create($validated);
        return redirect('/contact')->with('success','Message received successfully!');
        
        // Attempt to send email notification to admin
        // $data = $request->all();
        // Mail::to('contact@defort.com')->send(new ContactUs($data));
    }

    public function about(){
        $faqs = About::latest()->get();
        return view('about', ['faqs' => $faqs]);
    }

    //Services
    public function services(){
        $services = Services::latest()->get();
        return view('services', ['services' => $services]);
    }
}
