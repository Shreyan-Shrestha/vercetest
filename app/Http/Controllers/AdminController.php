<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\Contact;
use App\Models\About;
use App\Models\Services;
use App\Http\Requests\ServicesRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\AboutRequest;

class AdminController extends Controller
{
    public function index()
    {
        $projectsCount = Projects::count();
        $faqsCount = About::count();
        $blogsCount = Contact::count();
        $messagesCount = Contact::count();

        view()->share('projectsCount', $projectsCount);
        view()->share('faqsCount', $faqsCount);
        view()->share('blogsCount', $blogsCount);
        view()->share('messagesCount', $messagesCount);
        return view('admin.admin', ['projectsCount' => $projectsCount, 'faqsCount' => $faqsCount, 'blogsCount' => $blogsCount, 'messagesCount' => $messagesCount]);
    }

    public function projects()
    {
        $projects = Projects::latest()->get();
        return view('admin.project.projectlist', ['projects' => $projects]);
    }

    public function addprojectform()
    {
        return view('admin.project.addproject');
    }

    public function addproject(ProjectRequest $request)
    {
        $validated = $request->validated();

        // Handling the image file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public'); // Store in storage/app/public/images
            $validated['image'] = 'images/' . $imageName; // Add image path to validated data
        }

        // Create the project
        Projects::create($validated);

        return redirect()->route('admin.projects')->with('success', 'Added Project successfully!');
    }

    public function editproject($id)
    {
        $project = Projects::where('id', $id)->first();
        return view('admin.project.editproject', ['project' => $project]);
    }

   public function editprojectsubmit(ProjectRequest $request)
{
    $validated = $request->validated();

    $oldImagePath = null;

    // Handling the image file upload ONLY if a new one is provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->storeAs('images', $imageName, 'public');
        $validated['image'] = 'images/' . $imageName;

        // Get the current (old) image path before updating
        $project = Projects::find($request['id']);
        $oldImagePath = $project->image;
    }

    // Update the project
    Projects::where('id', $request['id'])->update($validated);

    // Delete old image file ONLY if a new one was uploaded
    if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
        Storage::disk('public')->delete($oldImagePath);
    }

    return redirect()->route('admin.projects')->with('success', 'Project updated successfully!');
}

    public function delproject($id)
    {
        $project = Projects::where('id', $id)->first();

        // Delete the image file if it exists
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        // Delete the project record
        Projects::where('id', $id)->delete();

        return redirect()->route('admin.projects')->with('success', 'Project deleted successfully!');
    }

    //Contact
    public function contact()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.contact', ['contacts' => $contacts]);
    }

    public function destroycontact($id)
    {
        Contact::where('id', $id)->delete();
        return redirect()->route('admin.contacts')->with('success', 'Message has been deleted');
    }

    //FAQs
    public function faqs()
    {
        $faqs = About::latest()->get();
        return view('admin.about.faqs', ['faqs' => $faqs]);
    }

    public function addfaqform()
    {
        return view('admin.about.addfaq');
    }
    public function addfaq(AboutRequest $request)
    {
        $validated = $request->validated();
        About::create($validated);
        return redirect()->route('admin.faqs')->with('success', 'Added FAQ successfully!');
    }
    public function editfaq($id)
    {
        $faq = About::where('id', $id)->first();
        return view('admin.about.editfaq', ['faq' => $faq]);
    }
    public function editfaqsubmit(AboutRequest $request)
    {
        $validated = $request->validated();
        About::where('id', $request['id'])->update($validated);
        return redirect()->route('admin.faqs')->with('success', 'FAQ updated successfully!');
    }
    public function delfaq($id)    {
        About::where('id', $id)->delete();
        return redirect()->route('admin.faqs')->with('success', 'FAQ deleted successfully!'); 
    }   

    //Services
    public function services(){
        $services = Services::latest()->get();
        return view('admin.services.services', ['services' => $services]);
    }
    public function addserviceform(){
        return view('admin.services.addservice');
    }
    public function addservice(ServicesRequest $request){
        $validated = $request->validated();
        Services::create($validated);
        return redirect()->route('admin.services')->with('success', 'Added Service successfully!');
    }
    public function editservice($id){
        $service = Services::where('id', $id)->first();
        return view('admin.services.editservice', ['service' => $service]);
    }
    public function editservicesubmit(ServicesRequest $request){
        $validated = $request->validated();
        Services::where('id', $request['id'])->update($validated);
        return redirect()->route('admin.services')->with('success', 'Service updated successfully!');
    }
    public function delservice($id)    {
        Services::where('id', $id)->delete();
        return redirect()->route('admin.services')->with('success', 'Service deleted successfully!'); 
    } 
}
