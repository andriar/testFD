<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\SellingTransaction;

class SellingTransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        try {
            $sellingtransaction = $this->searchGenerator($request);
            return response()->json($sellingtransaction, 200);
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
            'name' => 'required',
        ]);

        try {
            $sellingtransaction = SellingTransaction::create($request->all());
            return response()->json($sellingtransaction, 201);
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
            'sellingtransactions' => 'required|array',
        ]);

        try {
            foreach ($request->sellingtransactions as $key => $value) {
               $sellingtransaction = SellingTransaction::create($value);
            }
            return response()->json($request->sellingtransactions, 201);
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
            $sellingtransaction = SellingTransaction::findOrFail($request->id);
            return response()->json($sellingtransaction, 200);
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
            $sellingtransaction = SellingTransaction::findOrFail($request->id);

            $sellingtransaction->update($request->all());

            return response()->json($sellingtransaction, 200);
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
            $sellingtransaction = SellingTransaction::findOrFail($request->id);

            SellingTransaction::destroy($id);

            return response()->json(sellingtransaction, 200);
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
       
        $sellingtransaction = new SellingTransaction;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $sellingtransaction = $sellingtransaction->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $sellingtransaction = $sellingtransaction->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$count);
            $sellingtransaction = $sellingtransaction->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $sellingtransaction = $sellingtransaction->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $sellingtransaction = $sellingtransaction->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $sellingtransaction = $sellingtransaction->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $sellingtransaction = $sellingtransaction->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $sellingtransaction = $sellingtransaction->limit($limit)->get();
        }else{
            if($per_page !== 'all'){
                $sellingtransaction = $sellingtransaction->paginate($per_page);
            }else{
                $sellingtransaction = $sellingtransaction->get();
            }
        }
        
        return $sellingtransaction;
    }
}