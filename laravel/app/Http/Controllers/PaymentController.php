<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Services\PaymentServices;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Products;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $Paymentservices;

    public function __construct(PaymentServices $Paymentservices)
    {
        $this->Paymentservices = $Paymentservices;
    }

    public function createpayment($id)
    {
        $products = User::find(auth()->user()->id)->products_cart;
        $product = [];
        foreach($products as $product1){
            if($product1->id == $id){
                $product[]=$product1;
            }
        }


        return view('payment.payment' ,compact('product'));
    }

    public function payorder($id)
    {

        $products = User::find(auth()->user()->id)->products_cart;
        $product = [];
        foreach($products as $product1){
            if($product1->id == $id){
                $product[]=$product1;
            }
        }
        $user = User::find(auth()->user()->id);
        $data =  [
            'CustomerName' => $user->name,
            'MobileCountryCode' => '2',
            'CustomerMobile' => '01147998052',
            'NotificationOption' => 'LNK',
            'InvoiceValue' => $product[0]->price * $product[0]->pivot->amount,
            'CustomerEmail' => $user->email,
            'CallBackUrl' => env('succses_url'),
            'ErrorUrl' => env('failed_url'),
            'Language' => 'en',
            'CustomerReference'  => $product[0]->id,
            'UserDefinedField'   => $product[0]->pivot->amount,
            'DisplayCurrencyIso' => 'EGP',
        ];
        
        $payment_data = $this->Paymentservices->sendPayment($data);
        return redirect($payment_data['Data']['InvoiceURL']);
    }

    public function callback(Request $request)
    {
        $data = ['Key'=>$request->paymentId , 'KeyType'=>'PaymentId'];
        $payment_data =  $this->Paymentservices->getPaymentStatus($data);
        $product = Products::find($payment_data['Data']['CustomerReference']);
        $payment =  Payment::create([
            'user_id'=>auth()->user()->id,
            'products_id'=>$payment_data['Data']['CustomerReference'],
            'seller_id'=>$product->user_id,
            'product_name'=>$product->product_name,
            'product_image_path'=>$product->product_image_path,
            'InvoiceId'=>$payment_data['Data']['InvoiceId'],
            'InvoiceStatus'=>$payment_data['Data']['InvoiceStatus'],
            'InvoiceDisplayValue'=>$payment_data['Data']['InvoiceDisplayValue'],
            'amount'=>$payment_data['Data']['UserDefinedField'],
            'TransactionDate'=>$payment_data['Data']['InvoiceTransactions'][0]['TransactionDate'],
            'PaymentGateway'=>$payment_data['Data']['InvoiceTransactions'][0]['PaymentGateway'],
            'TransactionId'=>$payment_data['Data']['InvoiceTransactions'][0]['TransactionId'],
            'PaymentId'=>$payment_data['Data']['InvoiceTransactions'][0]['PaymentId'],
            'TransactionStatus'=>$payment_data['Data']['InvoiceTransactions'][0]['TransactionStatus'],
            'Country'=>$payment_data['Data']['InvoiceTransactions'][0]['Country'],
            'CardNumber'=>$payment_data['Data']['InvoiceTransactions'][0]['CardNumber'],
         ]);
        $product->update(['amount'=>$product->amount - $payment_data['Data']['UserDefinedField']]);
        
        Cart::where('user_id' , auth()->user()->id)
        ->where('products_id' ,$payment_data['Data']['CustomerReference'])->delete();

        $carts = Cart::where('products_id' ,$payment_data['Data']['CustomerReference']);
        
        foreach($carts as $cart){
            if($cart->amount > $product->amount){
                $cart->update(['amount'=>$product->amount]);
            }
        }

        return redirect()->route('payments.show');
    }

    public function error(Request $request)
    {
        $data = ['Key'=>$request->paymentId , 'KeyType'=>'PaymentId'];
        $payment_data =  $this->Paymentservices->getPaymentStatus($data);
        print 'Failed payment. Please check the reason for the failure by
        searching for this code on this page: ('
        .$payment_data['Data']['InvoiceTransactions'][0]['ErrorCode'].") ";
        ?><a href="https://docs.myfatoorah.com/docs/get-payment-status#error-codes">Faild Page</a><?php
    }
    public function show()
    {
        $payments = Payment::where( 'user_id',auth()->user()->id)->get();
        return view('payment.show' , compact('payments'));
    }
        public function seller_show()
    {
        $products = Payment::where('seller_id'  , auth()->user()->id)->get();
        return view('payment.seller_show' , compact('products'));
    }
    public function shipping($id)
    {
        Payment::find($id)->update(['shipped_at'=>now()]);
        return $this->seller_show();
    }
    public function delivered($id)
    {
        Payment::find($id)->update(['delivered_at'=>now()]);
        return $this->seller_show();
    }
}
