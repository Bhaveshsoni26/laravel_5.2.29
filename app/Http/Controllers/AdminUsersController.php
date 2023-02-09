<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use App\User;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\If_;
use Whossun\Toastr\Facades\Toastr;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        if(!Auth::check()){
            Auth::logout();
            return redirect('/login');
        }
    }
    public function index()
    {
        //
        // $active = User::where('is_active',1)->get();
        $users = User::with('roles')->get();
        $loggedInUser = Auth::user()->isAdmin();
        // dd($loggedInUser);
        if($loggedInUser == 1){
        return view('admin.users.index', compact('users'));
        }else{
            return view('errors.401', compact('users'));
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
        $roles = Role::lists('name','id')->all();
        $loggedInUser = Auth::user()->isAdmin();
        // dd($loggedInUser);
        if($loggedInUser == 1){
            return view('admin.users.create',compact('roles'));
        }else{
            return view('errors.401');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // dd($request->all());
        
        $input = $request->all();

        if($file = $request->file('photo_id')){
            // return "photo exist";
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $input['password']= bcrypt($request->password);

        User::create($input);

        Toastr::success('User Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect('/admin/users');
        // return $request->all();
        // $request->flashExcept('password');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.users.show');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::lists('name','id')->all();

        return view('admin.users.edit',compact('user','roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);

        $input = $request->all();
        $file = $request->file('photo_id');
        // dd($input);
        if($file){ // if new image is selected for profile of user
            // dd('file_exist');
            $user = User::where('id',$id)->first();
            $docs = Photo::find($user->photo_id); 
            if($docs){
                // dd('new file');
                // delete old file 
                $oldFileName = $docs->file; // old profile image name
                $file_path = public_path().$oldFileName; // old profile image path in public
                if(file_exists($file_path)){
                    unlink($file_path); //delete from public folder
                }
                $name = time().$file->getClientOriginalName(); // create new filename for image
                $file->move('images',$name); // move file in public/images folder
                $docs->update(['file'=>$name]); // add new file name in photo table
                $input['photo_id'] = $docs->id;
                // delete old file 
            }else{
                // dd('old file');
                $name = time().$file->getClientOriginalName(); // create new filename for image
                $newDoc = Photo::create(['file'=>$name]);
                $file->move('images',$name); // move file in public/images folder
                $input['photo_id'] = $newDoc->id;
            }

        }
        if (!request('password') || request('password') == null ) {
            unset($input['password']);   
        }
        if (!request('confirm-password') || request('confirm-password') == null ) {
            unset($input['confirm-password']);
        }
        if(request('password')){
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        $user->update($input);

        // Session::flash('success', 'User Has Been Updated Successfully');
        // toastr()->success('User Updated Successfully', 'Success');
        Toastr::success('User Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $docs = Photo::find($user->photo_id); 
        if($docs){
            $oldFileName = $docs->file; // old profile image name
            $file_path = public_path().$oldFileName; // old profile image path in public
            if(file_exists($file_path)){
                unlink($file_path); //delete from public folder
            }
            $docs->delete();//Delete from photo table
        }

        $user->delete();

        Toastr::error('User Deleted Successfully', 'Warning', ["positionClass" => "toast-top-right"]);

        return back();

    }
}
