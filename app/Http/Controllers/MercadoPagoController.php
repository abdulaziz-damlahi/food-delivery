<?php

namespace App\Http\Controllers;

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
    $total=  $order->order_amount;
    $options = new \Iyzipay\Options();
    $name= $request->get('cardholderName');
    $Month= $request->get('cardExpirationMonth');
    $year= $request->get('cardExpirationYear');
    $cardNumber= $request->get('cardNumber');
    $CVC= $request->get('CVC');
  //  $user = Auth::user();
   // return $user;
  //  dd($name,$Month,$year,$cardNumber,$CVC);
//options
    $options->setApiKey(env("TEST_IYZI_API_KEY"));
    $options->setSecretKey(env("TEST_IYZI_SECRET_KEY"));
    $options->setBaseUrl(env("TEST_IYZI_URL"));
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
  //  $buyer = new \Iyzipay\Model\Buyer();
   // $buyer->setId( $user->id);
    $buyer->setName($user->name);
    $buyer->setSurname("Doe");
    $buyer->setGsmNumber("+905350000000");
    $buyer->setEmail("email@email.com");
    $buyer->setIdentityNumber("74300864791");
    $buyer->setLastLoginDate("2015-10-05 12:43:35");
    $buyer->setRegistrationDate("2013-04-21 15:12:09");
    $buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
    $buyer->setIp("85.34.78.112");
    $buyer->setCity("Istanbul");
    $buyer->setCountry("Turkey");
    $buyer->setZipCode("34732");
    $request->setBuyer($buyer);

}
    public function index(Request $request)
    {


        $order = Order::with(['details'])->where(['id' => session('order_id')])->first();

        return view('payment-view-iyzico', compact('order'));
    }

}
