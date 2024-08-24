<?php

namespace App\Http\Controllers;

use App;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        // Check if the user is authenticated
        $currentUserID = Auth::check() ? Auth::user()->id : null;

        // Get the search term and gender filter from the request
        $searchTerm = $request->input('search');
        $genderFilter = $request->input('gender');

        // Build the query for fetching users
        $query = User::query();

        // Apply search and gender filters
        if ($searchTerm) {
            $query->where('hobbies', 'like', '%' . $searchTerm . '%');
        }

        if ($genderFilter) {
            $query->where('gender', $genderFilter);
        }

        // If the user is authenticated, exclude their own ID and filter out users who have already sent/received requests
        if ($currentUserID) {
            // Subquery to get the list of users who have sent a request to the current user
            $sentRequestUserIDs = DB::table('friend_requests')
                ->where('sender_id', '=', $currentUserID)
                ->pluck('receiver_id');

            // Subquery to get the list of users who are already friends with the current user
            $friendUserIDs = DB::table('friends')
                ->where('user_id', '=', $currentUserID)
                ->pluck('friend_id');

            $query->whereNotIn('id', $sentRequestUserIDs)
                ->whereNotIn('id', $friendUserIDs)
                ->where('id', '!=', $currentUserID);
        }

        // Execute the query and get the results
        $dataUser = $query->get();

        return view('home', compact('dataUser'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}