<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Application;
use App\Models\User;
use App\Models\Role;
use App\Models\Plan;
use App\Models\Package;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $page_name = 'Dashboard';

        return view('panel.admin.dashboard',compact('page_name'));
    }
    
    
    public function settings(){
        $page_name = 'Settings';
        $settings = Setting::first();
        //dd($settings);
        return view('panel.admin.settings',compact('page_name', 'settings'));
    }
    public function roles(){
        $page_name = 'Roles';
        $roles = Role::get();
        return view('panel.admin.roles',compact('page_name', 'roles'));
    }
    public function subscribers(){
        $page_name = 'Subscribers';
        
        return view('panel.admin.subscribers',compact('page_name'));
    }
    public function users(){
        $page_name = 'Users';
        $users = User::with('roles')->paginate(10);
        $roles = Role::where('name', '!=', 'member')->get();
//dd($users);
        return view('panel.admin.users',compact('page_name', 'users', 'roles'));
    }
    public function backup(){
        $page_name = 'Backup';
        return view('panel.admin.backup',compact('page_name'));
    }
    public function reports(){
        $page_name = 'Reports';
        return view('panel.admin.reports',compact('page_name'));
    }
}
