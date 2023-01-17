<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      
        $product = Product::latest();

        $products = Product:: where ([
            ['nume', '!=', Null], [function ($query) use ($request) {
                if (($term=$request->term)) {
                    $query->orWhere('nume', 'LIKE', '%'.$term . '%')-> get();
                }
            }]
        ])
        ->orderBy ("codprodus", "desc")
        ->paginate(5);


        $product = Product::orderBy('nume',$request->sort ?? 'DESC')->paginate();
        $product = Product::orderBy('nume',$request->sort ?? 'ASC')->paginate();
        
        $product = Product::orderBy('pret',$request->sort ?? 'ASC')->paginate();
        $product = Product::orderBy('pret',$request->sort ?? 'DESC')->paginate();
        
        $query = Product::orderBy('created_at','desc');
       
        if($request->min_price && $request->max_price){
            $query = $query->where('pret','>=',$request->min_price);
            $query = $query->where('pret','<=',$request->max_price);
        }
        //$product = $query->paginate();




        return view('products.index',compact('product'));
        }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nume' => 'required',
            'descriere' => 'required',
            'poza' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'pret' => 'required',
        ]);
        $input = $request->all();
       
        if ($poza = $request->file('poza')) {
            $destinationPath = 'poza/';
            $profileImage = date('YmdHis') . "." . $poza->getClientOriginalExtension();
            $poza->move($destinationPath, $profileImage);
            $input['poza'] = "$profileImage";
        }
        Product::create($input);
        return redirect()->route('products.index')
                        ->with('success','Produs inregistrat cu succes.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nume' => 'required',
            'descriere' => 'required',
            'poza' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'pret' => 'required',
        ]);
  
        $input = $request->all();
  
        if ($poza = $request->file('poza')) {
            $destinationPath = 'poza/';
            $profileImage = date('YmdHis') . "." . $poza->getClientOriginalExtension();
            $poza->move($destinationPath, $profileImage);
            $input['poza'] = "$profileImage";
        }else{
            unset($input['poza']);
        }
          
        $product->update($input);
    
        return redirect()->route('products.index')
                        ->with('success','Produs modificat cu succes.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
     
        return redirect()->route('products.index')
                        ->with('success','Produs sters cu succes.');
    }
    
    
    public function productshop(Request $request)
    {
        #Get minimum and maximum price to set in price filter range
        $min_price = Product::min('pret');
        $max_price = Product::max('pret');
        dd('Minimum Price value in DB->'.$min_price,'Maximum Price value in DB->'.$max_price);
 
        #Get filter request parameters and set selected value in filter
        $filter_min_price = $request->min_price;
        $filter_max_price = $request->max_price;
         
        #Get products according to filter
        if($filter_min_price && $filter_max_price){
            if($filter_min_price >0 && $filter_max_price >0)
            {
            $product = Product::select('nume','descriere','poza','pret')->whereBetween('pret',[$filter_min_price,$filter_max_price])->get();
          }
        }  
        #Show default product list in Blade file
        else{
            $product = Product::select('nume','descriere','poza','pret')->get();
        }
        return view('products.index',compact('products'));
    }
    
          
   

}