<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MultimediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $carts = Cart::with('multimediaItem')->where('user_id', $user->id)->get();

        return view('pages.carts.index', compact('carts'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'multimedia_item_id' => 'required|numeric',
        ]);

        $item = MultimediaItem::find($data['multimedia_item_id']);
        $data['quantity'] = 1;
        $data['price_per_day'] = $item->price_per_day;
        $data['subtotal'] = $data['price_per_day'] * $data['quantity'];
        $data['user_id'] = $user->id;

        $existedCart = Cart::where('user_id', $data['user_id'])->where('multimedia_item_id', $data['multimedia_item_id'])->first();
        if ($existedCart) {
            $data['quantity'] = $existedCart->quantity + 1;
            $data['subtotal'] = $data['price_per_day'] * $data['quantity'];
            $existedCart->update($data);
        } else {
            Cart::create($data);
        }

        return redirect()->back()->with('success', 'Menambahkan ke keranjang +1.');
    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $data = $request->validate([
            'quantity' => 'required|int|min:1',
        ]);

        $cart = Cart::find($id);
        $cart->quantity = $data['quantity'];
        $cart->subtotal = $cart->price_per_day * $cart->quantity;
        $cart->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Cart::destroy($id);

        return redirect()->back();
    }
}
