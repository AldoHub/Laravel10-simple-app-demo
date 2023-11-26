<?php

namespace App\Http\Controllers;

use App\Models\Twxt;
use Illuminate\Http\Request;

class TwxtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //add the user to the return of the query in order to avoid performance issues
        //preload the user for the view render
        $twxts = Twxt::with('user')->latest()->get();
        return view("twxts.index", [
            'twxts' => $twxts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // -- not needed in this case since the form is on the index page
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //ddd($request->all());
   
        $formfields = $request->validate([
            'message' => ['required', 'min:3', 'max:255']
        ]);

        //add the twxt to the authenticated user directly using the relationship
        //will add user_id automatically
        auth()->user()->twxts()->create($formfields);

        return to_route('twxts.index')->with('status', 'Twxt was created successfully!!!');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Twxt $twxt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($twxt)
    {
        //
     
      
        $_twxt = Twxt::findOrFail($twxt);
      

        //---TODO: Replace with Access Policy
        //check if the user is the same
        if(auth()->user()->id !== $_twxt->user_id){
            abort(403);
        }
      
        return view('twxts.edit', [
            'twxt' => $_twxt
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $twxt)
    {
        //
        $formfields = $request->validate([
            'message' => ['required', 'min:3', 'max:255']
        ]);

        $_twxt = Twxt::findOrFail($twxt);
        
        //---TODO: Replace with Access Policy
        //check if the user is the same
        if(auth()->user()->id !== $_twxt->user_id){
            abort(403);
        }   

        $_twxt->update($formfields);
        
        return to_route('twxts.index')->with('status', 'Twxt was updated successfully!!!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($twxt)
    {
        //
        $_twxt = Twxt::findOrFail($twxt);
         
        //---TODO: Replace with Access Policy
        //check if the user is the same
        if(auth()->user()->id !== $_twxt->user_id){
            abort(403);
        }   
      
        $_twxt->delete();
        return to_route('twxts.index')->with('status', 'Twxt was deleted successfully!!!');

    }
}
