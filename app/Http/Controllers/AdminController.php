<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Notifications\MyFirstNotification;
use Notification;
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
{
    public function addview(){
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
                return view('admin.add_doctor');
            }
            else{
                return redirect('home');
            }
        }
        
    }
    public function appointments(){
        $data = appointment::all();
        return view('admin.appointments', compact('data'));
    }
    // public function sendApprovingMail($id){
        
    // }
    public function decline($id){
        $data = appointment::find($id);
        $data->status = 'Canceled';
        $details = [
            'header' => 'Welcome '.$data->name,
            'actiontext' => 'Visit our website',
            'ending' => "Sorry we don't have appointment place on '.$data->date.' you can choose another time from our website, Thanks for your trust",
        ];
        Notification::send($data,new MyFirstNotification($details));
        $data->save();
        return redirect()->back()->with('message','Appointment deleted seccessfully');
    }
    public function approve($id){

        // if(Auth::id())
        // {
            
            $data = appointment::find($id);
            $data->status = 'Approved';
            $details = [
                'header' => 'Welcome '.$data->name,
                'actiontext' => 'Visit our website',
                'ending' => 'You can visit us on '.$data->date.' for your appointment, Thanks for your trust',
            ];
            Notification::send($data,new MyFirstNotification($details));
            $data->save();
            return redirect()->back()->with('message','Appointment deleted seccessfully');
            // if(Auth::user()->usertype==1)
            // {
               
            // }
            // else
            // {
            //     return redirect('home');
            // }
        // }
        
    }
    public function showdoctors(){

        $doctors = doctor::all();

        if(Auth::user()->usertype==1)
            {
                return view('admin.doctors',compact('doctors'));
            }
            else
            {
                return redirect('home');
            }
        }

        
        

    // public function edit(){

    //     $doctors = doctor::all();

    //     return view('admin.doctors',compact('doctors'));

    // }
    public function delete($id){

        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
                $doctor = doctor::find($id);
                $doctor->delete();
                return redirect()->back()->with('message','Doctor deleted seccessfully');
            }
            else
            {
                return redirect('home');
            }
        }
        
    }
    public function upload(Request $request){

        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
                $doctor = new doctor;

                $image = $request->file;
                $imagename = time().'.'.$image->getClientoriginalExtension();
                $request->file->move('doctorimage', $imagename);
                $doctor->image = $imagename;
                $doctor->name = $request->name;
                $doctor->doctor_number = $request->number;
                $doctor->specialty = $request->specialty;
                $doctor->room_number = $request->roomNumber;
        
                $doctor->save();
        
                return redirect()->back()->with('message','Doctor added seccessfully');
            }
            else
            {
                return redirect('home');
            }
        }

       
    }
}
