
# Laravel Payeer Checkout

This Laravel package allows you to create payment using Payeer.




## Usage/Examples
### Install Using Composer
```javascript
composer require dipesh79/laravel-payeer-checkout
```

### Add Two Variables in .env
You can get shop id and merchant id Payeer Dashboard 
```
PAYEER_SHOP_ID="Your Shop Id"
PAYEER_MERCHANT_KEY="Your Merchant Id"
```
### Publish Vendor File
```
php artisan vendor:publish --provider="Dipesh79\LaravelPayeerCheckout\PayeerServiceProvider"
```
or 
```
php artisan vendor:publish
```
And publish "Dipesh79\LaravelPayeerCheckout\PayeerServiceProvider"


Redirect the user to payment page from your controller

```
use Dipesh79\LaravelPayeerCheckout\LaravelPayeerCheckout;

//Your Controller Method
public function payeerPayment()
{
    //Store payment details in DB with pending status
    $payment = new LaravelPayeerCheckout();
    $amount = 123; 
    $order_id = 251264889; //Your Unique Order Id
    $description = "Order Description"; //Your Order Description which will be shown in payeer dashboard 
    $currency = 'USD' //This is optional. Default is USD
    return redirect($payment->payeerCheckout($amount,$order_id,$description,$currency))
}

```

After Successfull Payment payeer will redirect the use to your success url and you can change the payment status to Success else you can change the status to Fail when payeer redirect user to fail url.

Success Payment Case
```
public function payeerSuccess(Request $request)
{
    $order_id = $request->m_orderid;
    $payment = Payment::where('order_id', $order_id)->first();
    $payment->status = "Success";
    $payment->save();

    //Other Tasks
           
}
```
Fail Payment Case

```
public function payeerFail(Request $request)
{
    $payment = Payment::where('order_id', $request->m_orderid)->first();
    $payment->status = "Fail";
    $payment->save();
    //Other Tasks           
}
```



## License

[MIT](https://choosealicense.com/licenses/mit/)


## Author

- [@Dipesh79](https://www.github.com/Dipesh79)


## Support

For support, email dipeshkhanal79@gmail.com.

