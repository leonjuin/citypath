<?php
namespace App\Classes;

use DB;
use Exception;
use Redirect;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Payment;
use App\Models\PaymentFree;
use App\Models\PaymentEghl;
use App\Models\Order;
use App\Models\BookingContact;
use App\Classes\RoomRateManager;
use Carbon\Carbon;

use Illuminate\Database\QueryException;

class PaymentManager
{
	//public $company;

	function __construct() {
		//$this->company = Company::findOrFail($companyId);
	}

    public function payWithEghl($orderId, $request){
        $order = Order::find($orderId);

        $merchantId = config('app.payment.eghl.merchant_id');
        $merchantPassword = config('app.payment.eghl.merchant_password');

        $cancelURL = implode("", [config('app.url'), '/reservation/book-your-stay']);
        $approvalURL = implode("", [config('app.url') , '/reservation/payment/success']);
        $rejectionURL = implode("", [config('app.url') , '/reservation/payment/failed']);
        $callbackURL = implode("", [config('app.url'), '/reservation/payment/callback']);

        $currencyCode = 'MYR';
        $pageTimeout = 800;

        $hashString = implode("", [
            $merchantPassword, 
            $merchantId, 
            $order->payment_id, 
            $cancelURL, 
            $approvalURL, 
            $rejectionURL, 
            $callbackURL, 
            $order->total_amount, 
            $currencyCode, 
            $request->cust_ip, 
            $pageTimeout,
        ]);
        $hashValue = hash('sha256', $hashString);

        // handle payment gateway process
        $paymentData = (object) array(
            'TransactionType' => 'SALE',
            'PymtMethod' => 'ANY',
            'ServiceId' => $merchantId,
            'PaymentId' => $order->payment_id,
            'OrderNumber' => $order->id,
            'PaymentDesc' => 'Room Booking',
            'MerchantReturnURL' => $cancelURL,
            'MerchantApprovalURL' => $approvalURL,
            'MerchantUnApprovalURL' => $rejectionURL,
            'MerchantCallBackURL' => $callbackURL,
            'Amount' => $order->total_amount,
            'CurrencyCode' => $currencyCode,
            'HashValue' => $hashValue,
            'CustIP' => $request->cust_ip,
            'CustName' => $request->cust_name,
            'CustEmail' => $request->cust_email,
            'CustPhone' => $request->cust_phone,
            'LanguageCode' => 'en',
            'MerchantName' => config('app.name'),
            'PageTimeout' => $pageTimeout,
        );


        $paymentGatewayURL = implode("",[
            "https://test2pay.ghl.com/IPGSG/Payment.aspx?", 
            "TransactionType=", $paymentData->TransactionType, "&", 
            "PymtMethod=", $paymentData->PymtMethod, "&",
            "ServiceId=", $paymentData->ServiceId, "&",
            "PaymentId=", $paymentData->PaymentId, "&",
            "OrderNumber=", $paymentData->OrderNumber, "&",
            "PaymentDesc=", $paymentData->PaymentDesc, "&",
            "MerchantReturnURL=", $paymentData->MerchantReturnURL, "&",
            "MerchantApprovalURL=", $paymentData->MerchantApprovalURL, "&",
            "MerchantUnApprovalURL=", $paymentData->MerchantUnApprovalURL, "&",
            "MerchantCallBackURL=", $paymentData->MerchantCallBackURL, "&",
            "Amount=", $paymentData->Amount, "&",
            "CurrencyCode=", $paymentData->CurrencyCode, "&",
            "HashValue=", $paymentData->HashValue, "&",
            "CustIP=", $paymentData->CustIP, "&",
            "CustName=", $paymentData->CustName, "&",
            "CustEmail=", $paymentData->CustEmail, "&",
            "CustPhone=", $paymentData->CustPhone, "&",
            "LanguageCode=", $paymentData->LanguageCode, "&",
            "MerchantName=", $paymentData->MerchantName, "&",
            "PageTimeout=", $paymentData->PageTimeout
        ]);
        return $paymentGatewayURL;
    }

    public function payWithFree($orderId, $request){
        $payment = Payment::where('order_id', $orderId)->first();
        $approvalURL = implode("", [config('app.url') , '/reservation/payment/success']);

        PaymentFree::create([
            'payment_id' => $payment->id,
            'remark' => 'full paid'
        ]);

        return $approvalURL;

    }

    public function paymentSuccess($request, $booking){
        DB::transaction(function() use($request, &$booking){
            
            Order::where('id', $request->input('OrderNumber'))->update([
               'status' => 'paid'
            ]);
            $order = Order::where('id', $request->input('OrderNumber'))->first();
            $booking = Booking::where('order_id', $order->id)->first();

            Payment::where('order_id', $request->input('OrderNumber'))->update([
               'status' => 'succeed'
            ]);
            PaymentEghl::create([
               'transaction_type' => $request->input('TransactionType',''),
               'pymt_method' => $request->input('PymtMethod',''),
               'service_id' => $request->input('ServiceID',''),
               'payment_id' => $request->input('PaymentID',''),
               'order_number' => $request->input('OrderNumber',''),
               'amount' => $request->input('Amount',''),
               'currency_code' => $request->input('CurrencyCode',''),
               'hash_value' => $request->input('HashValue',''),
               'hash_value_2' => $request->input('HashValue2',''),
               'txn_id' => $request->input('TxnID',''),
               'issuing_bank' => $request->input('IssuingBank',''),
               'txn_status' => $request->input('TxnStatus',''),
               'auth_code' => $request->input('AuthCode',''),
               'bank_ref_no' => $request->input('BankRefNo',''),
               'token_type' => $request->input('TokenType',''),
               'token' => $request->input('Token',''),
               'resp_time' => $request->input('RespTime',''),
               'txn_message' => $request->input('TxnMessage','')
            ]); 

            return $booking;
        });

        return $booking;
    }
}