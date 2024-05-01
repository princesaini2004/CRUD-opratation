<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
  use App\Models\Users;
  use App\Http\Requests\LoginRequest;
 use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CrudController extends Controller
{
    
    public function index(Request $request)
    {
        $post = Users::get();
        return view('Crud.index', compact('post'));
    }
    public function listJson(Request $request){
      
        $pageNumber = ( $request->start / $request->length )+1;
        $pageLength = $request->length;
        $skip       = ($pageNumber-1) * $pageLength;

        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';


        $query = \DB::table("users");

        $search = $request->cSearch;
        $query = $query->where(function($query) use ($search){
            $query->orWhere('FirstName', 'like', "%".$search."%");
            $query->orWhere('Email', 'like', "%".$search."%");
        });

        $orderByName = 'FirstName';
        switch($orderColumnIndex){
            case '0':
                $orderByName = 'FirstName';
                break;
            case '1':
                $orderByName = 'Email';
                break;
        }

        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $users = $query->skip($skip)->take($pageLength)->get();

        return response()->json(["draw"=> $request->draw, "recordsTotal"=> $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $users], 200);
    }
 
    public function GetAll()
    {
        return Users::get();        
    }
     
    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|max:255',
            'MiddleName' => 'required',
            'LastName' => 'required',
            'Email' => 'required',
            'PhoneNumber' => 'required',
            'Address' => 'required',
            'password' => 'required', 
        ]);
    
        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->input('password'));
    
        Users::create($requestData);
    
        return redirect()->route('Crud.index')
            ->with('success', 'Post created successfully.');
    }
    public function show($id)
    {
        $post = Users::find($id);
        return view('Crud.show', compact('post'));

    }
    public function edit($id)
    {
        $post = Users::find($id);
        return view('Crud.edit', compact('post'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'FirstName' => 'required',
            'MiddleName' => 'required',
            'LastName' => 'required',
            'Email' => 'required',
            'PhoneNumber' => 'required',
            'Address' => 'required',
        ]);

        $post = Users::find($id);
        $post->update($request->all());

        return redirect()->route('Crud.index')
            ->with('success', 'Post updated successfully.');
    }


    public function destroy($id)
    {
        $post = Users::find($id);
        $post->delete();

        // return redirect()->route('Crud.index')
        //     ->with('success', 'Post deleted successfully');
    }
    public function create()
    {
        return view('Crud.create');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = Users::create($data);
        if(!$user){
            return redirect()->route('Crud.register')
            ->with('success', 'Post created successfully.');
           };
    
        return redirect()->route('Crud.index')
            ->with('success', 'Post created successfully.');
    }
    
}
