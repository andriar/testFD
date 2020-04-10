<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Supplier;

class SupplierController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        // try {
            $supplier = $this->searchGenerator($request);
            return response()->json($supplier, 200);
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
            'name' => 'required',
        ]);

        try {
            $supplier = Supplier::create($request->all());
            return response()->json($supplier, 201);
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
            'suppliers' => 'required|array',
        ]);

        try {
            foreach ($request->suppliers as $key => $value) {
               $supplier = Supplier::create($value);
            }
            return response()->json($request->suppliers, 201);
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
            $supplier = Supplier::findOrFail($request->id);
            return response()->json($supplier, 200);
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
            $supplier = Supplier::findOrFail($request->id);

            $supplier->update($request->all());

            return response()->json($supplier, 200);
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
            $supplier = Supplier::findOrFail($request->id);

            Supplier::destroy($id);

            return response()->json(supplier, 200);
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
       
        $supplier = new Supplier;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $supplier = $supplier->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $supplier = $supplier->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$count);
            $supplier = $supplier->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $supplier = $supplier->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $supplier = $supplier->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $supplier = $supplier->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $supplier = $supplier->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $supplier = $supplier->limit($limit)->get();
        }else{
            if($per_page >= 0 && $per_page != 'all'){
                $supplier = $supplier->paginate($per_page);
            }else if($per_page == -1){
                $count = new Supplier;
                $count =  $count->count();
                if($count > 100){
                    $count = 100;
                } else {
                    $count = $count;
                }
                $supplier = $supplier->paginate($count);
            }else if($per_page == 'all'){
                $supplier = $supplier->get();
            }
        }
        
        return $supplier;
    }
}