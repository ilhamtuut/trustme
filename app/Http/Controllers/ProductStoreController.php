<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\User;
use App\Balance;
use App\HistoryTransaction;
use Auth;
use App\Product;
use App\ProductCategorie;
use App\ProductImage;
use App\ProductWishlist;
use App\ProductCart;
use App\ProductCheckout;

class ProductStoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function cartwishlist($perPage = null)
    {
        if(Auth::check()){
            $productWislist = ProductWishlist::with('product')->where('user_id', Auth::User()->id)->offset(0)->limit(3)->orderBy('id', 'ASC')->get();
            $productCart = ProductCart::with('product')->where('user_id', Auth::User()->id)->offset(0)->limit(3)->orderBy('id', 'ASC')->get(); 
            return compact('productCart','productWislist');
        }
        return [];
    }
    public function wishLiked($data)
    {
        if(Auth::check()){
            $product = ProductWishlist::where('user_id', Auth::User()->id)->where('product_id', $data->id)->first();
            return $product ? '1' : '0';
        }
    }
    public function ranjaOngkir($url,$metode,$data='')
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $metode,
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 2302af6bb90da7f0dcdb542c2d6236b2"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return [];
        }
        $json = json_decode($response, true);
        return $json['rajaongkir']['results'];
    }
    public function index()
    {
        $categorie = ProductCategorie::all();
        $product = Product::with('image')->get();
        foreach($product as $key => $value) {
            $value['wishlist'] = $this->wishLiked($value);
        }
        return view('store.index', array_merge($this->cartwishlist(), compact('categorie','product')));
    }
    
    public function detail(Request $request)
    {
        $q = $request->get('q');
        $product = Product::with('image','categorie')->where('slug', $q)->first();
        if($product){
            $categorie = ProductCategorie::all();
            $related = Product::with('image')->where('id', '!=', $product->id)->offset(0)->limit(8)->get();
            $product['wishlist'] = $this->wishLiked($product);
            foreach($related as $key => $value) {
                $value['wishlist'] = $this->wishLiked($value);
            }
            return view('store.detail',  array_merge($this->cartwishlist(), compact('categorie','product','related')));
        }
        abort(404);        
    }
    public function wishlist()
    {
        $wishlist = ProductWishlist::with('product')->where('user_id', Auth::User()->id)->orderBy('id', 'ASC')->get();
        return view('store.wishlist', array_merge($this->cartwishlist(), compact('wishlist')));
    }
    public function wishlistPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id', 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'product');
        }
        $product = ProductWishlist::where('user_id', Auth::User()->id)->where('product_id', $request->id)->first();
        if($product){
            $product->delete();
            return redirect()->back()->with('alert-store', array('message' => 'Wish list has been removed', 'status' => "danger"));
        }else{
            $product = new ProductWishlist;
            $product->user_id = Auth::User()->id;
            $product->product_id = $request->id;

            $product->save();
            return redirect()->back()->with('alert-store', array('message' => 'Wish list has been added', 'status' => "success"));
        }        
    }
    public function cart()
    {
        $cart = ProductCart::with('product')->where('user_id', Auth::User()->id)->orderBy('id', 'ASC')->get();
        return view('store.cart', array_merge($this->cartwishlist(), compact('cart')));
    }
    public function city(Request $request)
    {
        $q = $request->get('q');
        $city = $this->ranjaOngkir("https://api.rajaongkir.com/starter/city",'GET');
        $city = array_filter($city, function ($k) use($q){ 
            return $k['province_id'] == $q;
        });
        return response()->json($city);
    }
    public function estimed($data)
    {
        $dc = 15500;
        $cost = $data->sum("cost") / $dc;
        $total = ($data->sum("total") / $dc) + $cost;
        $balance = Auth::user()->balance->where('description','Dinasty Coin')->first()->balance;
        return compact('cost','balance','total');
    }
    public function cost(Request $request)
    {
        $q = $request->get('q');
        $urlCost = "https://api.rajaongkir.com/starter/cost";
        $origin = 23; //bandung
        $courier = 'jne';
        $cart = ProductCart::where('user_id', Auth::User()->id);
        foreach($cart->get() as $use){
            $cost = $this->ranjaOngkir($urlCost,'POST',"origin=".$origin."&destination=".$q."&weight=".$use->product->weight."&courier=".$courier."");

            $use->cost = $cost[0]['costs'][0]['cost'][0]['value'];
            $use->courier = $courier;
            $use->save();
        }
        $estimed = $this->estimed($cart);
        if($estimed['total'] > $estimed['balance']){
            return response()->json(0);        
        }
        return response()->json(['cost' => number_format($estimed['cost'], 8), 'total' => number_format($estimed['total'], 8)]);
    }
    public function cartPost(Request $request)
    {
        $product = ProductCart::where('user_id', Auth::User()->id)->where('product_id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id', 
            'qty' => $product ? '' : 'required'.'|numeric|min:1|max:100', 
            'status' => 'string', 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'product');
        }
        if($product && $request->status == "remove"){
            $product->delete();
            return redirect()->back()->with('alert-store', array('message' => 'Cart list has been removed', 'status' => "danger"));
        }else{
            if($product){
                $product->qty = $product->qty + $request->qty;
                $product->total = $product->total + ($request->qty * $product->product->price);   
                
                $product->save();
            }else{
                $product = new ProductCart;
                $product->user_id = Auth::User()->id;
                $product->product_id = $request->id;
                $product->qty = $request->qty;
                $product->total = $request->qty * $product->product->price;

                $product->save();
                if($product && $request->status == "wishlist"){
                    $productWislist = ProductWishlist::where('user_id', Auth::User()->id)->where('product_id', $request->id)->first();
                    $productWislist->delete();
                }
            }
            return redirect()->back()->with('alert-store', array('message' => 'Cart list has been added', 'status' => "success"));   
        }     
    }
    public function checkout()
    {
        $cart = ProductCart::with('product')->where('user_id', Auth::User()->id)->orderBy('id', 'ASC')->get();
        if(!$cart->isEmpty()){
            $provinsi = $this->ranjaOngkir("https://api.rajaongkir.com/starter/province",'GET');
            return view('store.checkout', array_merge($this->cartwishlist(),compact('cart','provinsi')));
        }
        abort(404);
    }
    public function checkoutList()
    {
        $data = ProductCheckout::with('product')->where('user_id', Auth::User()->id)->orderBy('id', 'ASC')->get();
        return view('store.checkoutList', array_merge($this->cartwishlist(), compact('data')));
    }
    public function checkoutPost(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'city' => 'required|string', 
            'information' => 'required|string|min:3|max:1500',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'form');
        }
        $cart = ProductCart::where('user_id', Auth::User()->id);
        $estimed = $this->estimed($cart);
        if($estimed['total'] > $estimed['balance']){
            return redirect()->back()->with('alert-store', array('message' => 'Balance not enog', 'status' => "danger"));        
        }

        $usersOut = User::where('id', Auth::user()->id)->first()->balance()->where('description','Dinasty Coin')->first();
        $usersOut->balance = $usersOut->balance - round($estimed['total'], 8);
        $usersOut->save();

        HistoryTransaction::create([
            'balance_id'=> $usersOut->id,
            'from_id' => Auth::user()->id,
            'to_id'=> 1,
            'amount'=>  round($estimed['total'], 8),
            'description' => 'Transaction Dinasty Coin Store',
            'status' => 1,
            'type' => 'OUT'
        ]);
        
        
        $usersIn = User::where('id', 1)->first()->balance()->where('description','Dinasty Coin')->first();
        $usersIn->balance = $usersIn->balance - round($estimed['total'], 8);
        $usersIn->save();

        HistoryTransaction::create([
            'balance_id'=> $usersIn->id,
            'from_id' => Auth::user()->id,
            'to_id'=> 1,
            'amount'=>  round($estimed['total'], 8),
            'description' => 'Transaction Dinasty Coin Store',
            'status' => 1,
            'type' => 'IN'
        ]);

        $place = json_decode($request->city);
        foreach($cart->get() as $use){
            $product = new ProductCheckout;
            $product->user_id = Auth::User()->id;
            $product->product_id = $use->product_id;
            $product->qty = $use->qty;
            $product->total = $use->total;
            $product->weight = $use->product->weight;
            $product->city = $place->city_name;
            $product->province = $place->province;
            $product->zip = $place->postal_code;
            $product->cost = $use->cost;
            $product->courier = $use->courier;
            $product->information = $request->information;

            $product->save();
            $use->delete();
        }
        return redirect('store/checkout-list')->with('alert-store', array('message' => 'Order has been added', 'status' => "success"));       
    }
}
