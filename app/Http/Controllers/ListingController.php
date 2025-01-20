<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all listings
    Public function index() {

        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);

        return view('listings.index', ['listings'=> $listings]);

    }

    //Show single listings
    public function show(listing $listing) {

        return view('listings.show', [
            'listing' => $listing
        ]);

    }

    //Create new listing
    public function create() {

        return view('listings.create');

    }

     //store  listings in database
  public function store(Request $request) {

    // dd($request->all());

    $formFields = $request->validate([
      'title' => 'required',
      'company' => ['required', Rule::unique('listings','company')],
      'location' => 'required',
      'website' => 'required',
      'email'=> ['required','email'],
      'tags' => 'required',
      'description' => 'required']);

      if($request->hasFile('logo')){
        
        $formFields['logo'] = $request->file('logo') -> store('logos','public');
      }

      $formFields['user_id'] = auth()->id();

      // 'image1' => 'required|mimes:jpeg,png,jpg|max:2048',

    listing::create($formFields);

    return redirect()->route('listings.index')->withsuccess('Listing created successfully!');

  
  }

  //show single listing for editing
public function edit(listing $listing) {
  
      return view('listings.edit', [
                'listing' => $listing
            ]);
    }

      // update listing in database
    public function update(Request $request, listing $listing)
    {
      // Make sure logged in user is the owner
      if($listing->user_id != auth()->id()){
          abort(403, 'Unauthorized Action');
      }

      $formFields = $request->validate([
        'title' => 'required',
        'company' => 'required',
        'location' => 'required',
        'website' => 'required',
        'email'=> ['required','email'],
        'tags' => 'required',
        'description' => 'required']);
    
        if($request->hasFile('logo')){
          
          $formFields['logo'] = $request->file('logo') -> store('logos','public');
        }
    
        // 'image1' => 'required|mimes:jpeg,png,jpg|max:2048',
    
      $listing->update($formFields);
    
      return redirect('/listings/'. $listing->id)->withsuccess('Listing updated successfully!');

      }

      // Delete listing from database
public function destroy(listing $listing) {

    // Make sure logged in user is the owner
    if($listing->user_id != auth()->id()){
      abort(403, 'Unauthorized Action');
    }
        $listing->delete();

        return redirect()->route('listings.index')->withSuccess('Listing deleted successfully!');

    }

    // Manage Listings 
public function manage() {

      // if(!auth()->user()->hasRole(['admin'])){
      //     abort(403);
      // }

        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
      
      }
}
