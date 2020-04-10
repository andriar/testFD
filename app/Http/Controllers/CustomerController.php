<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Customer;

class CustomerController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        try {
            $customer = $this->searchGenerator($request);
            return response()->json($customer, 200);
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
            'name' => 'required|string',
            'address' => 'required|string',
            'telephone' => 'required|numeric',
            'meta' => 'json',
        ]);

        try {
            $customer = Customer::create($request->all());
            return response()->json($customer, 201);
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
            'customers' => 'required|array',
        ]);

        try {
            foreach ($request->customers as $key => $value) {
               $customer = Customer::create($value);
            }
            return response()->json($request->customers, 201);
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
            $customer = Customer::findOrFail($request->id);
            return response()->json($customer, 200);
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
            'name' => 'required|string',
            'address' => 'required|string',
            'telephone' => 'required|numeric',
            // 'meta' => 'json',
        ]);

        try {
            $customer = Customer::findOrFail($request->id);

            $customer->update($request->all());

            return response()->json($customer, 200);
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
            $customer = Customer::findOrFail($request->id);

            Customer::destroy($id);

            return response()->json(customer, 200);
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
       
        $customer = new Customer;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $customer = $customer->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $customer = $customer->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$count);
            $customer = $customer->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $customer = $customer->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $customer = $customer->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $customer = $customer->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $customer = $customer->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $customer = $customer->limit($limit)->get();
        }else{
            if($per_page >= 0){
                $customer = $customer->paginate($per_page);
            }else if($per_page == -1){
                $count = new Customer;
                $count =  $count->count();
                if($count > 100){
                    $count = 100;
                } else {
                    $count = $count;
                }
                $customer = $customer->paginate($count);
            }else{
                $customer = $customer->get();
            }
        }
        
        return $customer;
    }
}