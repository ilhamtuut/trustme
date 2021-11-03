<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Auth;
use App\Product;
use App\ProductCategorie;
use App\ProductImage;
use App\ProductCheckout;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categorie = ProductCategorie::all();
        return view('backend.product.index', compact('categorie'));
    }
    public function post(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:70',
            'categorie' => 'required|exists:product_categories,id',
            'price' => 'required|numeric|min:1|digits_between: 1,20',
            'stock' => 'required|numeric|min:1|digits_between: 1,20',
            'weight' => 'required|numeric|min:1|digits_between: 1,20',
            'description' => 'required|string|min:3|max:1500',
            'dz_file' => 'required|array|min:1|max:5', 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'product');
        }
        $product = new Product;
        $product->user_id = Auth::User()->id;
        $product->categorie_id = $request->categorie;
        $product->name = $request->title;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->stock = $request->weight;
        $product->description = $request->description;

        $product->save();
        $product->slug = Str::slug($request->title, '-').'-'.$product->id;
        $product->save();

        $extentionName = 'assets-store/file';
        foreach($request->dz_file as $idex => $use){
            $fileName = "product-".Auth::User()->id."-".$idex.time().'.png';
            $pathAsset = public_path().'/'.$extentionName.'/'.$fileName;
            $pathInsert = url($extentionName).'/'.$fileName;
            $decode = base64_decode(substr($use, strpos($use, ",")+1));

            $image = new ProductImage;
            $image->product_id = $product->id;
            $image->path = $pathInsert;

            file_put_contents($pathAsset, $decode);
            $image->save();
        }
        $request->session()->flash('success', 'Successfully, posted product');  
        return redirect()->back();              
    }
    public function categorie()
    {
        return view('backend.product.categorie');
    }
    public function postCategorie(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:20', 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'categorie');
        }
        $categorie = new ProductCategorie;
        $categorie->name = $request->name;

        $categorie->save();
        $request->session()->flash('success', 'Successfully, posted Category');
        return redirect()->back();    
    }
    public function order(Request $request)
    {
        $q = $request->get('q');
        $data = ProductCheckout::where('id', $q)->first();
        if($data){
            return view('backend.product.order', compact('data'));
        }
        $data = ProductCheckout::all();
        return view('backend.product.orders', compact('data'));
    }
    public function postOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:product_checkouts,id',
            'status' => 'required', 
        ]);
        if ($validator->fails()) {
            $request->session()->flash('failed', 'ID not found');
            return redirect()->back();  
        }
        $data = ProductCheckout::where('id', $request->id)->first();
        $data->status = $request->status;

        $data->save();
        $request->session()->flash('success', 'Successfully, upadated Status');
        return redirect()->back();    
    }
}
