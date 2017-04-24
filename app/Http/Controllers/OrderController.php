<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderEmail;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderForm()
    {
        $products = Product::all();

        foreach ($products as $product) {
            $productList[$product['id']] = "{$product['name']} ({$product['manufacturer']})";
        }

        return view('order.form', [
            'products' => $productList ?? [],
            'orderCount' => Order::count(),
        ]);
    }

    public function getPrice(Product $product)
    {
        return response()->json($product->price ?? 0);
    }

    public function makeOrder(OrderRequest $request)
    {
        $toInsert = $request->toArray();

        foreach ($toInsert['line'] as &$row) {
            $product = Product::find($row['product']);

            if ($product) {
                $row['manufacturer'] = $product->manufacturer;
                $row['name'] = $product->name;

                unset($row['product']);
            }
        }

        $order = Order::create($toInsert);

        dispatch(new SendOrderEmail($order));

        $order->document()->save();

        return redirect('/');
    }

    public function searchForm()
    {
        return view('search.form');
    }

    public function search(Request $request)
    {
        $result = Order::search();

        if ($request->orderId) {
            $result->match('id', $request->orderId);
        }

        if ($request->username) {
            $result->match('username', $request->username);
        }

        if ($request->surname) {
            $result->match('surname', $request->surname);
        }

        if ($request->email) {
            $result->match('email', $request->email);
        }

        if ($request->createDate) {
            $result->match('created_at', $request->createDate);
        }

        if ($request->sumTo) {
            $result->range('total', [
                'from' => $request->sumFrom ?? 0,
                'to' => $request->sumTo,
            ]);
        }

        return redirect()->route('search.result', [
            'result' => $result->get()->hits()->toArray(),
        ]);
    }

    public function searchResult(Request $request)
    {
        return view('search.result', [
            'result' => $request->result,
        ]);
    }
}