<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Good;

class GoodController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        try {
            $good = $this->searchGenerator($request);
            return response()->json($good, 200);
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
            'code' => 'required|string|unique:goods,code',
            'name' => 'required|string|unique:goods,name',
            'category_id' => 'uuid|exists:categories,id',
            'sub_category_id' => 'uuid|exists:sub_categories,id',
        ]);

        try {
            $good = Good::create($request->all());
            return response()->json($good, 201);
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
            'goods' => 'required|array',
        ]);

        try {
            foreach ($request->goods as $key => $value) {
               $good = Good::create($value);
            }
            return response()->json($request->goods, 201);
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
            $good = Good::findOrFail($request->id);
            return response()->json($good, 200);
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
            'code' => 'required|string|unique:goods,id,'.$request->id,
            'name' => 'required|string'
            // 'name' => 'required|string|unique:goods,name,'.$request->name,
            // 'category_id' => 'uuid|exists:categories,id',
            // 'sub_category_id' => 'uuid|exists:sub_categories,id',
        ]);

        try {
            $good = Good::findOrFail($request->id);

            $good->update($request->all());

            return response()->json($good, 200);
        } catch (\Throwable $th) {
            $this->content['statusCode'] = 404;
            $this->content['error'] = 'Not Found';
            $this->content['message'] = 'Data Not Found';
            return response()->json($this->content, 404);
        }
    }

    public function delete(Request $request, $id)
    {
        // try {
            $good = Good::findOrFail($request->id);

            Good::destroy($id);

            return response()->json(good, 200);
        // } catch (\Throwable $th) {
        //     $this->content['statusCode'] = 404;
        //     $this->content['error'] = 'Not Found';
        //     $this->content['message'] = 'Data Not Found';
        //     return response()->json($this->content, 404);
        // }
    }

    public function searchGenerator($request) {
        $per_page = $request->per_page ?  $request->per_page : 'all';
        $filter = $request->filter ? $request->filter : [];
        $sort = $request->sort ? $request->sort : 'created_at,ASC';
        $join = $request->join ? $request->join : '';
        $count = $request->count ? $request->count : '';
        $whereHas = $request->where_has ? $request->where_has : [];
        $limit = $request->limit ? $request->limit : '';
       
        $good = new Good;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $good = $good->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $good = $good->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$count);
            $good = $good->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $good = $good->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $good = $good->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $good = $good->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $good = $good->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $good = $good->limit($limit)->get();
        }
        else if($per_page == -1){
            $count = new Good;
            $count =  $count->count();
            if($count > 100){
                $count = 100;
            } else {
                $count = $count;
            }
            $good = $good->paginate($count);
        }
        else{
        if($per_page !== 'all'){
            $good = $good->paginate($per_page);
        }else{
            $good = $good->get();
            }
        }
        
        return $good;
    }
}