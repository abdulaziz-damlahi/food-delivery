<?php

namespace App\Http\Controllers;
use App\user;
use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Payment;
use MercadoPago\Payer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Order;
use App\Model\BusinessSetting;
use App\CentralLogics\Helpers;
use App\CentralLogics\OrderLogic;

class MercadoPagoController extends Controller
{

public function checkout(Request $request){

     $order = Order::with(['details'])->where(['id' => session('order_id')])->first();
     $address = $order->delivery_address['address'];
     $total=  $order->order_amount;
     $orderUserID=  $order->user_id;

//user name
      $user = user::where('id', '=', $orderUserID)->first();
     $Fname=$user->f_name;
     $Lname=$user->l_name;
     $email=$user->email;
     $phone=$user->phone;

    $name= $request->get('cardholderName');
    $Month= $request->get('cardExpirationMonth');
    $year= $request->get('cardExpirationYear');
    $cardNumber= $request->get('cardNumber');
    $CVC= $request->get('CVC');
  //  dd($name,$Month,$year,$cardNumber,$CVC);

//requests
    $request = new \Iyzipay\Request\CreatePaymentRequest();
    $request->setLocale(\Iyzipay\Model\Locale::TR);
    $request->setConversationId($order->id);
    $request->setPrice($total);
    $request->setPaidPrice($total);
    $request->setCurrency(\Iyzipay\Model\Currency::TL);
    $request->setInstallment(1);
    $request->setBasketId($total);
    $request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
    $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
//paymentcard
    $paymentCard = new \Iyzipay\Model\PaymentCard();
    $paymentCard->setCardHolderName($name);
    $paymentCard->setCardNumber($cardNumber);
    $paymentCard->setExpireMonth( $Month);
    $paymentCard->setExpireYear( $year);
    $paymentCard->setCvc( $CVC);
    $paymentCard->setRegisterCard(0);
    $request->setPaymentCard($paymentCard);
//buyer
    $buyer = new \Iyzipay\Model\Buyer();
    $buyer->setId( $user->id);
    $buyer->setName($Fname);
    $buyer->setSurname($Lname);
    $buyer->setGsmNumber($phone);
    $buyer->setEmail($email);
    $buyer->setIdentityNumber("74300864791");
    $buyer->setLastLoginDate("2015-10-05 12:43:35");
    $buyer->setRegistrationDate("2013-04-21 15:12:09");
    $buyer->setRegistrationAddress($address);
    $buyer->setIp("85.34.78.112");
    $buyer->setCity("Istanbul");
    $buyer->setCountry("Turkey");
    $buyer->setZipCode("34732");
    $request->setBuyer($buyer);

    $fullname=$Fname.' '.$Lname;
    $shippingAddress = new \Iyzipay\Model\Address();
    $shippingAddress->setContactName($fullname);
    $shippingAddress->setCity("Istanbul");
    $shippingAddress->setCountry("Turkey");
    $shippingAddress->setAddress($address);
    $shippingAddress->setZipCode("34742");
    $request->setShippingAddress($shippingAddress);

    $billingAddress = new \Iyzipay\Model\Address();
    $billingAddress->setContactName($fullname);
    $billingAddress->setCity("Istanbul");
    $billingAddress->setCountry("Turkey");
    $billingAddress->setAddress($address);
    $billingAddress->setZipCode("34742");
    $request->setBillingAddress($billingAddress);


    $order = Order::with(['details'])->where(['id' => session('order_id')])->first();
    $product_id = $order->details->first();
    $product_id2 = $product_id->product_id;
    $product_details = $product_id->product_details;
    $price = $product_id->price;

    $basketItems = array();
    $Item = new \Iyzipay\Model\BasketItem();
    $Item->setId($product_id2);
    $Item->setName($product_id2);
    $Item->setCategory1($product_id2);
    $Item->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
    $Item->setPrice($price);
    $basketItems[0] = $Item;
  //options
    $options = new \Iyzipay\Options();
    $options->setApiKey(env("TEST_IYZI_API_KEY"));
    $options->setSecretKey(env("TEST_IYZI_SECRET_KEY"));
    $options->setBaseUrl(env("TEST_IYZI_BASE_URL"));

    $payment = \Iyzipay\Model\Payment::create($request, $options);

    if ($payment->getStatus() == "success") {
dd('odeme tamamlandi');
    }else{
        dd('yok');
    }


}

    public function index(Request $request)
    {


        $order = Order::with(['details'])->where(['id' => session('order_id')])->first();

        return view('payment-view-iyzico', compact('order'));
    }

}
