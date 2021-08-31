<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->roles->pluck('name');

        $vendors = User::role('Vendor')->count(); 
        $products = Product::count(); 
        $users = User::count(); 


        if(!empty($role))
        {
           $role =  $role[0];

           if($role == 'User')
           {
                $html = '<div class="container"><div class="row justify-content-center"><div class="col-md-12"><div class="card"><div class="card-header">'.Auth::user()->name.'</div><div class="card-body"><div class="row">';


            $html .='<div class="col-md-6 col-lg-2 col-xlg-3"><div class="card card-hover"><div class="box bg-cyan text-center"><h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1><h6 class="text-white">Total Vedors '.$vendors.'</h6></div></div></div>'; 

            $html .='<div class="col-md-6 col-lg-2 col-xlg-3"><div class="card card-hover"><div class="box bg-cyan text-center"><h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1><h6 class="text-white">Total Products '.$products.' </h6></div></div></div>';

             $html .='<div class="col-md-6 col-lg-2 col-xlg-3"><div class="card card-hover"><div class="box bg-cyan text-center"><h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1><h6 class="text-white">Vedors - Total</h6></div></div></div>';    
           
          $html .='</div></div></div></div></div></div>';
           }

           if($role == 'SuperAdmin')
           {
            $html = '<div class="container"><div class="row justify-content-center"><div class="col-md-12"><div class="card"><div class="card-header">{{ {{ Auth::user()->name }} }}</div><div class="card-body"><div class="row">';


            $html .='<div class="col-md-6 col-lg-2 col-xlg-3"><div class="card card-hover"><div class="box bg-cyan text-center"><h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1><h6 class="text-white">Total Users - '.$users.'</h6></div></div></div>';

             $html .='<div class="col-md-6 col-lg-2 col-xlg-3"><div class="card card-hover"><div class="box bg-cyan text-center"><h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1><h6 class="text-white">Vedors - Total</h6></div></div></div>';


            
           
          $html .='</div></div></div></div></div></div>';
           }
        }



        

        return view('home',compact('html'));
    }

     public function getlogout()
    {
        Auth::logout();
        return redirect()->to('/login');
    }
}
