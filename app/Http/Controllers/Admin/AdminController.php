<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if($request->session()->has('ADMIN_LOGIN'))
         {
            return redirect('admin/dashboard');
         }
         else
         {
             return view('admin.login');
         }
       // return view('admin.login');
    }
    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        //$password = $request['password'];
        // echo $email;
      //  $result = Admin::where(['email' => $email, 'password' => $password])->get();
      $result = Admin::where(['email' => $email])->first();
        if($result)
        {
            if($request->post('password') == $result->password)
            {
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_ID', $result->id);
             //   $name = $result->name->get();
              //  $data = compact('name');
                return view('admin.dashboard');
            }
            else{
                $request->session()->flash('error', 'Wrong password');
                    return view('admin.login');
            }

        }
        else
        {
          //  $message = "Wrong email or password";
            $request->session()->flash('error', 'Wrong email or password');
            return view('admin.login');
        }


    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

}
