<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Like;

class LikeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        try {
            $like = $this->searchGenerator($request);
            return response()->json($like, 200);
        } catch (\Throwable $th) {
            $this->content['statusCode'] = 500;
            $this->content['error'] = 'Internal Server Error';
            $this->content['message'] = 'something went wrong';
            return response()->json($this->content, 500);
        }
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        // try {
            $like = Like::create($request->all());
            return response()->json($like, 201);
        // } catch (\Throwable $th) {
        //     $this->content['statusCode'] = 500;
        //     $this->content['error'] = 'Internal Server Error';
        //     $this->content['message'] = 'Failed to create';
        //     return response()->json($this->content, 500);
        // }
    }

    public function bulk(Request $request)
    {
        $validatedData = $request->validate([
            'likes' => 'required|array',
        ]);

        try {
            foreach ($request->likes as $key => $value) {
               $like = Like::create($value);
            }
            return response()->json($request->likes, 201);
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
            $like = Like::findOrFail($request->id);
            return response()->json($like, 200);
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
        ]);

        try {
            $like = Like::findOrFail($request->id);

            $like->update($request->all());

            return response()->json($like, 200);
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
            $like = Like::findOrFail($request->id);

            Like::destroy($id);

            return response()->json(like, 200);
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
       
        $like = new Like;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $like = $like->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $like = $like->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$count);
            $like = $like->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $like = $like->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $like = $like->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $like = $like->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $like = $like->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $like = $like->limit($limit)->get();
        }else{
            if($per_page !== 'all'){
                $like = $like->paginate($per_page);
            }else{
                $like = $like->get();
            }
        }
        
        return $like;
    }
}