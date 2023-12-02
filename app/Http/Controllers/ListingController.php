<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;

class ListingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
    }

    //Show all listings
    /* public function index(){
        return view('listings.index',[
            'listings'=> Listing::latest()->filter(request([ 'tag' , 'search' ]))->get()
        ]);
    } */

      //Show all listings with pagination
    public function index(){
        return view('listings.index',[
            'listings'=> Listing::latest()->filter(request([ 'tag' , 'search' ]))->paginate(4)
        ]);
    }

    // show single listing
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // create listing
    public function create ()
    {
        return view('listings.create');
    }

     // store listing
    public function store(Request $request)
    {
        // checking request
          //dd($request->all());

            // checking file
         // dd($request->file('logo'));

        //Validation
        $formFields = $request->validate(
            [
                'title'=>'required',
                // company'=>['require', Rule::unique('DBTable','field')],
                'company'=>['required', Rule::unique('listings','company')],
                'location'=>'required',
                'website'=>'required',
                'email'=>['required','email'],
                'logo'=>'required',
                'tags'=>'required',
                'description'=>'required',
            ]
        );

        //add it to fillables fields on Class Listing  //
        //$formFields['logo'] = $request->file('logo')->store('logos', 'public');

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields ['user_id'] = auth()->id();
        // process to save db
        Listing::create($formFields);
        //Flash Message Created
        // success* is the id name
        return redirect('/')->with('success', 'Listing Created Succefully');
         // See component Flash Message
    }

    // edit listing
    public function edit(Listing $listing){
       // dd($listing);
        return view('listings.edit', ['listing' => $listing]);
    }

      // store listing
    public function update(Request $request, Listing $listing)
    {
        // Only owners can update
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        //Validation
        $formFields = $request->validate
        (
            [
                'title'=>'required',
                'company'=>'required',
                'location'=>'required',
                'website'=>'required',
                'email'=>['required','email'],
                'tags'=>'required',
                'description'=>'required',
            ]
        );
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
          // process to save db
        $listing->update($formFields);
        //Flash Message Created
        return back()->with('success', 'Listing Updated Succefully');
        // See component Flash Message
    }

    public function destroy(Listing $listing){
        // Only owners can delete listing
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('success', 'Listing Deleted Succefully');
    }

    //Manage Listing
    public function manage(){
       // return view('listings.manage', ['listings' => auth()
       // ->user()->listings()->get()]);

       return view('listings.manage', ['listings'=>auth()
       ->user()->listings]);
    }
}
