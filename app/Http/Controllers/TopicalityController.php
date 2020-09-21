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


    //    return ResourcesTopicality::collection(Topicality::orderByDesc('created_at')->get());
        return Topicality::orderByDesc('created_at')->get();
    //    return $topicalities->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes= $request->validate([
            'title' => ['required','string', 'unique:topicalities', 'max:255', 'min:10'],
            'content' => ['required', 'string', 'max: 255'],
        ]);


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

        $user=Auth::user();

       

        return $topicality;
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

        $user=Auth::user();
        

        if ($user->can('update', $topicality)) {

            $attributes = $request->validate([
                'title' => ['string', 'unique:topicalities', 'max:255', 'min:10', 'nullable'],
                'content' => ['nullable','string', 'max: 255'],
            ]);

            
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

        if ($user->can('delete', $topicality)) {
            
            $topicality->delete();
            echo "Current logged in user delete with success";
          } else {
            echo 'Not Authorized.';
          }


    }
}
