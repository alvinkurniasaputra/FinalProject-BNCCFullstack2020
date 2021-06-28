<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use App\User;
use File;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        return view('forum.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $id = Auth::id();
        return view('forum.users.show', compact('user','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::id() == $id){
            $user = User::where('id',$id)->first();
            return view('forum.users.edit', compact('user'));
        }
        else{
            return redirect("/users/$id");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id',$id)->update(["name" => $request["name"],"location" => $request["location"],"title" => $request["title"],"about_me" => $request["about_me"]]);
        return response(true,200);
    }

    public function update_photo(Request $request, $id)
    {
        $user = User::where('id',$id)->first();
        $validatedData = $request->validate([
            'image' => 'image'
        ]);

        if($request->hasFile('image')){
            $photo = $request->file('image');
            $filename = time() . '.' . $photo->getClientOriginalExtension();

            if($user->photo !== 'default.jpg'){
                $file = public_path('/uploads/images/' . $user->photo);
                if(File::exists($file)){
                    unlink(($file));
                }
            }
            Image::make($photo)->resize(300,300)->save(public_path('/uploads/images/' . $filename));

            User::where('id',$id)->update(['photo'=>$filename]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
