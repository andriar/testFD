<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Comment;

class CommentController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        try {
            $comment = $this->searchGenerator($request);
            return response()->json($comment, 200);
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
            'comment' => 'required',
            'post_id' => 'exists:posts,id',
            'comment_id' => 'exists:comments,comment_id',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $comment = Comment::create($request->all());
            return response()->json($comment, 201);
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
            'comments' => 'required|array',
        ]);

        try {
            foreach ($request->comments as $key => $value) {
               $comment = Comment::create($value);
            }
            return response()->json($request->comments, 201);
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
            $comment = Comment::findOrFail($request->id);
            return response()->json($comment, 200);
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
            $comment = Comment::findOrFail($request->id);

            $comment->update($request->all());

            return response()->json($comment, 200);
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
            $comment = Comment::findOrFail($request->id);

            Comment::destroy($id);

            return response()->json(comment, 200);
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
       
        $comment = new Comment;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $comment = $comment->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $comment = $comment->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$count);
            $comment = $comment->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $comment = $comment->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $comment = $comment->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $comment = $comment->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $comment = $comment->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $comment = $comment->limit($limit)->get();
        }else{
            if($per_page !== 'all'){
                $comment = $comment->paginate($per_page);
            }else{
                $comment = $comment->get();
            }
        }
        
        return $comment;
    }
}