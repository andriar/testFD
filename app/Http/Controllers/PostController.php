<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Post;

class PostController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        // try {
            $post = $this->searchGenerator($request);
            return response()->json($post, 200);
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
            'post' => 'required|string',
        ]);

        try {
            $request->merge(['user_id' => '2a767767-994e-4b9f-8b12-cd4eec5fc5b1']);
            $post = Post::create($request->all());
            return response()->json($post, 201);
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
            'posts' => 'required|array',
        ]);

        try {
            foreach ($request->posts as $key => $value) {
               $post = Post::create($value);
            }
            return response()->json($request->posts, 201);
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
            $post = Post::findOrFail($request->id);
            return response()->json($post, 200);
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
            $post = Post::findOrFail($request->id);

            $post->update($request->all());

            return response()->json($post, 200);
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
            $post = Post::findOrFail($request->id);

            Post::destroy($id);

            return response()->json(post, 200);
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

        $post = new Post;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $post = $post->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $post = $post->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$join);
            $post = $post->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $post = $post->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $post = $post->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $post = $post->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $post = $post->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $post = $post->limit($limit)->get();
        }else{
            if($per_page !== 'all'){
                $post = $post->paginate($per_page);
            }else{
                $post = $post->get();
            }
        }
        
        return $post;
    }
}