<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/mercado_pogo/css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<main>
    <!-- Hidden input to store your integration public key -->


    <!-- Payment -->
    <section class="payment-form dark">
        <div class="container__payment">
            <div class="block-heading">
                <h2>Card Payment</h2>

            </div>
            <div class="form-payment">
                <div class="products">
                    <!-- <h2 class="title">Summary</h2> -->
                    <!-- <div class="item">
                        <span class="price" id="summary-price"></span>
                        <p class="item-name">Book x <span id="summary-quantity"></span></p>
                    </div> -->
                    <p class="alert alert-danger" role="alert" id="error_alert" style="display:none;"></p>
                    <div class="total">{{\App\CentralLogics\translate('amount_to_be_paid')}}<span class="price">{{ $order->order_amount }}</span></div>
                </div>
                <div class="payment-details">
                    <form method="POST" action="{{route("iyzico.checkout")}}">
                            @csrf
                        <h3 class="title">Card Details</h3>
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <input id="cardholderName" name="cardholderName" placeholder="CARD HOLDER NAME" type="text" class="form-control"/>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="input-group expiration-date">
                                    <input id="cardExpirationMonth" name="cardExpirationMonth" type="text"  placeholder="month" class="form-control"/>
                                    <span class="date-separator">/</span>
                                    <input id="cardExpirationYear" name="cardExpirationYear"  placeholder="year"  type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group col-sm-8">
                                <input id="cardNumber" name="cardNumber"  placeholder="CARD NUMBER"  type="text" class="form-control"/>
                            </div>
                            <div class="form-group col-sm-4">
                                <input id="CVC" name="CVC"   placeholder="CVC" type="text" class="form-control"/>
                            </div>
                            <div id="issuerInput" class="form-group col-sm-12 hidden">
                                <select id="issuer" name="issuer" class="form-control"></select>
                            </div>

                            <div class="form-group col-sm-12">
                                <br>
                                <button id="submit" type="submit" class="btn btn-primary btn-block">Pay</button>
                                <br>
                                <p id="loading-message">Loading, please wait...</p>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
</body>

</html>
