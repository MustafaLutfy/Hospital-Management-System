<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Doctor;
use App\Models\appointment;

class HomeController extends Controller
{
    
    public function redirect()
    {
        $doctors = doctor::all();
        if(Auth::id())
        {
            if(Auth::user()->usertype=='0')
            {
                return view('user.home',compact('doctors'));
            }
            else
            {
                return view('admin.home');
            }
        }
        else{
            return redirect()->back();
        }
    }
    public function index()
    {
        if(Auth::id())
        {
            return redirect('home');
        }
        else{
            $doctors = doctor::all();
        
            return view('user.home',compact('doctors'));
        }
       
    }
    public function myappointments()
    {
        if(Auth::id())
        {
            $userid = Auth::user()->id;

            $appo = appointment::where('user_id', $userid)->get();

            return view('user.myappointments', compact('appo'));
        }
        else
        {
            return redirect()->back();
        }
       
    }
    public function deleteApt($id)
    {
        $data = appointment::find($id);
        $data->delete();
        return redirect()->back()->with('message','Appointment Deleted seccessfully');
    }
   
    public function appointment(Request $request){
        $appointment = new appointment;

        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->date = $request->date;
        $appointment->doctor = $request->select_doctor;
        $appointment->number = $request->number;
        $appointment->message = $request->message;
        $appointment->status = 'In progress';

        if(Auth::id())
        {
            $appointment->user_id = Auth::user()->id;
        }
        
     

        $appointment->save();

        return redirect()->back()->with('message','Appointment Recorded seccessfully');
    }
}
