<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ProjectController extends Controller
{


      public function index(){
        $all = Client::all();
        return view('admin.projects.add', compact('all'));
      }

}
