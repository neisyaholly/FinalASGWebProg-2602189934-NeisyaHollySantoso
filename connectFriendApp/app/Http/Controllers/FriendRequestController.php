<?php

namespace App\Http\Controllers;

use App;
use App\Models\FriendRequest;
use Auth;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        $currentUserID = Auth::user()->id;
        $friendRequest = FriendRequest::where('friend_requests.receiver_id', '=', $currentUserID)->where('friend_requests.status', '=', 'pending')->join('users', 'users.id', '=', 'friend_requests.sender_id')->get(['friend_requests.id as request_id', 'users.*']);

        return view('request', compact('friendRequest'));
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
        $loc = session()->get('locale');
        App::setLocale($loc);

        $sender_id = Auth::user()->id;
        $receiver_id = $request->input('receiver_id');

        $friendRequest = FriendRequest::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id
        ]);

        if ($friendRequest) {
            return redirect()->route('user.index')->with('success', 'Friend request sent');
        }
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
    public function destroy(FriendRequest $friendRequest)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        $deleteRequest = FriendRequest::destroy($friendRequest->id);

        return redirect()->route('friend-request.index')->with('success', 'Succesfully Delete');
    }
}
