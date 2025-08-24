<?php

namespace App\Http\Controllers;



use App\Models\QuotUsers;
use App\Models\Quotations;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use File;
use URL;
use Mail;
use App\Mail\SendLink;
    
class UsersController extends Controller
{
    //
    public function index()
    {
        
        return view('users.view', [
            'users' => QuotUsers::paginate(15),            
        ]);
    }


    public function view($id)
    {
        $user = QuotUsers::where('id',$id)->get();
        $quots = Quotations::where('user_id',$id)->paginate(15);
        
        return view('users.viewClients', [
            'quots' => $quots,
            'user' => $user[0]->name,
        ]);
    }


    public function create()
    {
        //
        return view('users.add');
    }

    public function store(Request $request)
    {
       
        //
        $request->validate([
            'userName' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'logo' => ['required']
        ]);

        
        $logoName = $request->userName.'_logo.'.$request->logo->extension();
        $request->logo->move(public_path('images'), $logoName);
        $quotUser = QuotUsers::create([
            'name' => $request->userName,
            'email' => $request->email,
            'address' => $request->address,
            'logo' => 'images/'.$logoName
        ]);

        
        return redirect('users')->with('message', 'User Added Successfully!' );

    }

    public function destroy($id)
    {
        //
        $pd = QuotUsers::where('id',$id)->get('logo');
        
        
        if(File::exists(public_path($pd[0]->logo))){

            File::delete(public_path($pd[0]->logo));

            QuotUsers::where('id',$id)->delete();
            return redirect('/users')->with('message', 'User Deleted Successfully!' );
        
        }else{

            return redirect('/users')->with('message', 'Unable to Delete User!' );
        
        }
        
        
    }

    public function createLink($id)
    {
        
        $quot = Quotations::create([
            "user_id" => $id,
            "clientName" => '',
            "link" => '',
            "pdfLink" => '',

        ]);

        $link = URL::temporarySignedRoute('cost-calculate', now()->addSeconds(3600),[
            "token" => $quot->id
        ]);


        Quotations::where('id', $quot->id)->update(['link' => $link]);
        
        $user = QuotUsers::findOrFail($id);
     
        $mailData = [
            'link' => $link,
            
        ];
        
        Mail::to($user->email)->send(new SendLink($mailData));
             
        // dd("Email is sent successfully.");
        return redirect()->route('users.view')->with('message', 'Link has been Created for '.$user->name.' and sent to '.$user->email.' Successfully!' )->with('link',$link);
    }
}

