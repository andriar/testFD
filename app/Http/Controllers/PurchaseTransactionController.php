<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\PurchaseTransaction;
use App\Models\PurchaseTransactionDetail;
use App\Models\Stock;

class PurchaseTransactionController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        try {
            $purchasetransaction = $this->searchGenerator($request);
            return response()->json($purchasetransaction, 200);
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
            'transaction_code' => 'required|string|unique:purchase_transactions',
            'total' => 'required|numeric',
            'supplier_id' => 'required|uuid|exists:suppliers,id',
            'details' => 'required|array',
            'details.*.good_id' => 'required|uuid|exists:goods,id',
            'details.*.name' => 'required|string',
            'details.*.qty' => 'required|numeric',
            'details.*.price' => 'required|numeric',
        ]);
        
        $id = "";

        try {
            $purchasetransaction = PurchaseTransaction::create($request->all());
            $id = $purchasetransaction->id;

            foreach ($request->details as $key => $value) {
                $purchasetransactionDetail = PurchaseTransactionDetail::create([
                    "name" => $value["name"],
                    "qty" => $value["qty"],
                    "price" => $value["price"],
                    "good_id" => $value["good_id"],
                    "purchase_transaction_id" => $id
                ]);

                $stock = Stock::where('good_id', $value["good_id"])->first();

                if($stock){
                    $stockUpdate = Stock::findOrFail($stock->id)->update([
                        "qty" => $value["qty"] + $stock->qty,
                    ]);
                }else{
                    $stock = Stock::create([
                        "qty" => $value["qty"],
                        "good_id" => $value["good_id"],
                    ]);
                }
            }
            return response()->json($purchasetransaction, 201);
        } catch (\Throwable $th) {
            $getOne = PurchaseTransaction::findOrFail($id);
            if($getOne){
                PurchaseTransaction::destroy($id);
            }

            $this->content['statusCode'] = 500;
            $this->content['error'] = 'Internal Server Error';
            $this->content['message'] = 'Failed to create';
            return response()->json($this->content, 500);
        }
    }

    public function bulk(Request $request)
    {
        $validatedData = $request->validate([
            'purchasetransactions' => 'required|array',
        ]);

        try {
            foreach ($request->purchasetransactions as $key => $value) {
               $purchasetransaction = PurchaseTransaction::create($value);
            }
            return response()->json($request->purchasetransactions, 201);
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
            $purchasetransaction = PurchaseTransaction::findOrFail($request->id);
            return response()->json($purchasetransaction, 200);
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
            $purchasetransaction = PurchaseTransaction::findOrFail($request->id);

            $purchasetransaction->update($request->all());

            return response()->json($purchasetransaction, 200);
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
            $purchasetransaction = PurchaseTransaction::findOrFail($request->id);

            PurchaseTransaction::destroy($id);

            return response()->json(purchasetransaction, 200);
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
       
        $purchasetransaction = new PurchaseTransaction;

        if(is_array($whereHas)){
            foreach ($whereHas as $item => $value) {
                $words = explode(",",$value);
                     $purchasetransaction = $purchasetransaction->whereHas($words[0], function ($query) use ($words) {
                        $query->where($words[1], $words[2]);
                    });
            }
        }

        if($join !== ''){
            $join = Str::lower($join);
            $words = explode(",",$join);
            $purchasetransaction = $purchasetransaction->with($words);
        }

        if($count !== ''){
            $count = Str::lower($count);
            $words = explode(",",$count);
            $purchasetransaction = $purchasetransaction->withCount($words);
        }

        if(is_array($filter)){
            foreach ($filter as $item => $value) {
                $words = explode(",",$value);
                if(array_key_exists(2, $words)){
                    if($words[2] || $words[2] == 'AND'){
                        $purchasetransaction = $purchasetransaction->orWhere($words[0], 'LIKE', '%'.$words[1].'%');
                    }else{
                        $purchasetransaction = $purchasetransaction->where($words[0], 'LIKE', '%'.$words[1].'%');
                    }
                }else{
                    $purchasetransaction = $purchasetransaction->where($words[0], 'LIKE', '%'.$words[1].'%');
                }
            }
        }

        $sortItem = explode(",",$sort);
        if(strtoupper($sortItem[1]) == 'ASC' || strtoupper($sortItem[1]) == 'DESC'){
            $purchasetransaction = $purchasetransaction->orderBy($sortItem[0], $sortItem[1]);
        }

        if($limit != ''){
            $purchasetransaction = $purchasetransaction->limit($limit)->get();
        }else{
            if($per_page !== 'all'){
                $purchasetransaction = $purchasetransaction->paginate($per_page);
            }else{
                $purchasetransaction = $purchasetransaction->get();
            }
        }
        
        return $purchasetransaction;
    }
}