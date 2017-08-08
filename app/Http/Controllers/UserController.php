<?php

namespace App\Http\Controllers;
use App\Country;
use App\Photo;
use App\Post;
use App\Role;
use App\User;
use Arubacao\Friends\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function autocomplete()
    {
        $term = Input::get('term');

        $results = array();

        // this will query the users table matching the first name or last name.
        // modify this accordingly as per your requirements

        $queries = DB::table('users')
            ->where('firstname', 'LIKE', '%' . $term . '%')
            ->orWhere('lastname', 'LIKE', '%' . $term . '%')
            ->take(5)->get();

        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->firstname . ' ' . $query->lastname];

            return Response::json($results);
        }

    }

    public function getProfile($id)
    {

        if(Auth::id() == $id)
        {
            return redirect('/dashboard');
        }
        {
            $user = User::where('id', $id)->first();

            if(!$user)
            {
               Session::flash('Not Found', 'This user could not be found, please try your search again.', 'info');

               return redirect('/dashboard');
            }
            $posts = Post::where("dash_id", "=", $user->id)->latest()->paginate(3);
            $photos = Photo::where('user_id', '=', $user->id)->latest()->paginate(6);
            return view('profile.index',compact('user','posts', 'photos'));
        }

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);

        $countries = Country::all()->pluck('name');


        return view('user.edit', compact('user', 'countries'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $input = $request->all();

        $this->validate($request, [
            'firstname' => 'required|string|min:2|max:20',
            'lastname' => 'required|string|min:2|max:20',
            'email' => 'required|string|email|max:255|',
            'country_living' => 'required',
            'country_from' => 'required',
        ]);

        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = $user->photos()->create(['path' => $name]);

            $input['photo_id'] = $photo->id;

        }

        $input['password'] = bcrypt($request->password);

        $user->update($input);

        return redirect('/dashboard');
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $input = $request->all();

        $this->validate($request, [
            'status' => 'max:100|min:3|string'
        ]);

        $user->update($input);

        return redirect()->back();
    }

    public function updateCover(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $input = $request->all();

        if ($file = $request->file('cover_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = $user->photos()->create(['path' => $name]);

            $input['cover_id'] = $photo->id;

        }

        $user->update($input);

        return redirect('/dashboard');

    }

    public function updateProfilePic(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $input = $request->all();

        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = $user->photos()->create(['path' => $name]);

            $input['photo_id'] = $photo->id;

        }

        $user->update($input);

        return redirect('/dashboard');

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
