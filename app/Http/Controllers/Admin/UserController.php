<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\WorkShiftType;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Designation;
use App\Models\MailSetting;
use App\Mail\SendPassword;
use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use App\Models\Document;
use App\Models\Program;
use App\User;
use Toastr;
use Hash;
use Auth;
use Mail;
use DB;
use Exception;

class UserController extends Controller
{
    use FileUploader;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct () 
    {
        // Module Data
        $this->title     = trans_choice('module_staff', 1);
        $this->route     = 'admin.users-admin';
        $this->view      = 'admin.users';
        $this->path      = 'user';
        $this->access    = 'user';

        try {
            $current_theme = DB::table('themes')->where('current_theme',1)->first();
            if(!$current_theme){
                throw new Exception("505, Server Error");
                die;
            }     
            $this->theme = $current_theme->slug;
            $this->theme_id = $current_theme->id; 
       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title']     = 'Users';
        $data['route']     = $this->route;

        $data['users'] = DB::table('users')->where('users.is_admin',0)->where('is_admin',0)->get();
            
        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;

        $data['departments'] = DB::table('departments_category')->where('status', 'active')->orderBy('title', 'asc')->get();

        return view($this->view.'.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field Validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'department' => 'required',
            'password' => 'required',            
        ]);

        // Random Password
        $password = $request->password;

        $staff_id = rand(100,2);

        // Store data
        $user = new User;
        $user->staff_id = $staff_id;
        $user->department_id = $request->department;
        $user->first_name = $request->name;
        
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->password_text = Crypt::encryptString($password);
        
        $user->status = $request->status;
        $user->created_by = Auth::guard('web')->user()->id;
        $user->save();
        
        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
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
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        $data['path']      = $this->path;

        $data['row'] = User::find($id);

        return view($this->view.'.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['title']     = 'Edit Data';
        $data['route']     = $this->route;
        $data['view']      = $this->view;

        $data['data'] = DB::table('users')->where('id',$id)->where('theme',$this->theme_id)->first();

        return view($this->view.'.edit', $data);
    }

    public function update(Request $request, $id)
    {
    try {
        $status = DB::table('users')->where('id',$id)
        ->update([
           'status'=>$request->status,
       ]);
    } catch (\Throwable $th) {
        
    }
        if ($status) {
            Toastr::success('Data Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if (! $id || $id == '') {
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }
        
        $status = DB::table('users')->where('id',$id)->where('theme',$this->theme_id)->delete();
        if ($status) {
            Toastr::success('Data Deleted Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route($this->route.'.index');
    }
}
