<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\PurchaseTransactionDetail;

class PurchaseTransactionDetailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        try {
            $purchasetransactiondetail = $this->searchGenerator($request);
            return response()->json($purchasetransactiondetail, 200);
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
            $purchasetransactiondetail = PurchaseTransactionDetail::create($request->all());
            return response()->json($purchasetransactiondetail, 201);
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
            'purchasetransactiondetails' => 'required|array',
        ]);

        try {
            foreach ($request->purchasetransactiondetails as $key => $value) {
               $purchasetransactiondetail = PurchaseTransactionDetail::create($value);
            }
            return response()->json($request->purchasetransactiondetails, 201);
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
            $purchasetransactiondetail = PurchaseTransactionDetail::findOrFail($request->id);
            return response()->json($purchasetransactiondetail, 200);
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
            $purchasetransactiondetail = PurchaseTransactionDetail::findOrFail($request->id);

            $purchasetransactiondetail->update($request->all());

            return response()->json($purchasetransactiondetail, 200);
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
            $purchasetransactiondetail = PurchaseTransactionDetail::findOrFail($request->id);

            PurchaseTransactionDetail::destroy($id);

            return response()->json(purchasetransactiondetail, 200);
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
       
        $purchasetransactiondetail = new PurchaseTransactionDetail;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $purchasetransactiondetail = $purchasetransactiondetail->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $purchasetransactiondetail = $purchasetransactiondetail->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$count);
            $purchasetransactiondetail = $purchasetransactiondetail->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $purchasetransactiondetail = $purchasetransactiondetail->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $purchasetransactiondetail = $purchasetransactiondetail->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $purchasetransactiondetail = $purchasetransactiondetail->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $purchasetransactiondetail = $purchasetransactiondetail->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $purchasetransactiondetail = $purchasetransactiondetail->limit($limit)->get();
        }else{
            if($per_page !== 'all'){
                $purchasetransactiondetail = $purchasetransactiondetail->paginate($per_page);
            }else{
                $purchasetransactiondetail = $purchasetransactiondetail->get();
            }
        }
        
        return $purchasetransactiondetail;
    }
}