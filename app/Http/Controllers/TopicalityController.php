<?php

namespace App\Http\Controllers;

use App\Http\Resources\Topicality as ResourcesTopicality;
use App\Topicality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Display every Topicality ordering by creation date

        return Topicality::orderByDesc('created_at')->get();
        
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // put some rules validation for the property of the topicality's model in a variable

        $attributes= $request->validate([
            'title' => ['required','string', 'unique:topicalities', 'max:255', 'min:10'],
            'content' => ['required', 'string', 'max: 255'],
        ]);


        // put the current user id in the user_id of the topicality
        $attributes['user_id'] = Auth::user()->id;
        

        // return a response when a topicality is create
        if (Topicality::create($attributes)) {
            return response()->json([
                'success' => 'Actu créer avec succès'
            ],200);
        };

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topicality  $topicality
     * @return \Illuminate\Http\Response
     */
    public function show(Topicality $topicality)
    {

        // return the topicality with resources
        return new ResourcesTopicality($topicality);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topicality  $topicality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topicality $topicality)
    {

        // put the auth user in $user variable;
        $user=Auth::user();
        
        // if the user can update thanks to the authotization of the policy, we update the topicality.
        if ($user->can('update', $topicality)) {

            $attributes = $request->validate([
                'title' => ['string', 'unique:topicalities', 'max:255', 'min:10', 'nullable'],
                'content' => ['nullable','string', 'max: 255'],
            ]);


        // return a response in case of a success update

        if ($topicality->update($attributes)) {
            return response()->json([
                'success' => 'Actu modifiée avec succès'
            ],200);
        };
            
          } else {
            echo 'Not Authorized.';
          }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topicality  $topicality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topicality $topicality)
    {
        $user=Auth::user();

        // Delete the topicality if the user has the right to do it

        if ($user->can('delete', $topicality)) {
            
            $topicality->delete();
            echo "Current logged in user delete with success";
          } else {
            echo 'Not Authorized.';
          }


    }
}
