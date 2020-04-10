<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        // try {
            $user = $this->searchGenerator($request);
            return response()->json($user, 200);
        // } catch (\Throwable $th) {
        //     $this->content['statusCode'] = 500;
        //     $this->content['error'] = 'Internal Server Error';
        //     $this->content['message'] = 'something went wrong';
        //     return response()->json($this->content, 500);
        // }
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5|confirmed',
        ]);

        try {
            $request->merge(['password' => Hash::make($request->password)]);
            $user = User::create($request->all());
            return response()->json($user, 201);
        } catch (\Throwable $th) {
            $this->content['statusCode'] = 500;
            $this->content['error'] = 'Internal Server Error';
            $this->content['message'] = 'Failed to create';
            return response()->json($this->content, 500);
        }
    }

    public function bulk(Request $request)
    {
        $validatedData = $request->validate([
            'users' => 'required|array',
            'users.*.name' => 'required|string|max:30',
            'users.*.email' => 'required|email||unique:users,email',
            'users.*.password' => 'required|string|min:5',
        ]);

        try {
            foreach ($request->users as $key => $value) {
               $user = User::create($value);
            }
            return response()->json($request->users, 201);
        } catch (\Throwable $th) {
            $this->content['statusCode'] = 500;
            $this->content['error'] = 'Internal Server Error';
            $this->content['message'] = 'Failed to create';
            return response()->json($this->content, 500);
        }
    }

    public function show(Request $request)
    {

        try {
            $user = User::findOrFail($request->id);
            return response()->json($user, 200);
        } catch (\Throwable $th) {
            $this->content['statusCode'] = 404;
            $this->content['error'] = 'Not Found';
            $this->content['message'] = 'Data Not Found';
            return response()->json($this->content, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try {
            $user = User::findOrFail($request->id);

            $user->update($request->all());

            return response()->json($user, 200);
        } catch (\Throwable $th) {
            $this->content['statusCode'] = 404;
            $this->content['error'] = 'Not Found';
            $this->content['message'] = 'Data Not Found';
            return response()->json($this->content, 404);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $user = User::findOrFail($request->id);

            User::destroy($id);

            return response()->json(user, 200);
        } catch (\Throwable $th) {
            $this->content['statusCode'] = 404;
            $this->content['error'] = 'Not Found';
            $this->content['message'] = 'Data Not Found';
            return response()->json($this->content, 404);
        }
    }

    public function searchGenerator($request) {
        $per_page = $request->per_page ?  $request->per_page : 'all';
        $filter = $request->filter ? $request->filter : [];
        $sort = $request->sort ? $request->sort : 'created_at,ASC';
        $join = $request->join ? $request->join : '';
        $count = $request->count ? $request->count : '';
        $whereHas = $request->where_has ? $request->where_has : [];
        $limit = $request->limit ? $request->limit : '';

        $user = new User;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $user = $user->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $user = $user->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$count);
            $user = $user->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $user = $user->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $user = $user->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $user = $user->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $user = $user->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $user = $user->limit($limit)->get();
        }else{
            if($per_page !== 'all'){
                $user = $user->paginate($per_page);
            }else{
                $user = $user->get();
            }
        }
        
        return $user;
    }
}