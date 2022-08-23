<?php

namespace Store\Manager\Controllers\Orders;

use Store\Manager\Controllers\AppController;

class OrdersController extends AppController {

    public function __construct(){

        parent::__construct();
    }

    public function fulfilment(){

        $params = cart_checkout();

        try {
            // payload array to be sent to server
            $response = $this->orderService->checkout($params);

            \Log::info("Response Date" . json_encode($response));

            if (_value($response, "status") == "success") {
                return redirect()->to(route('checkout.success', ["status" => "success"]))->withSuccess('Payment successfully processed.');
            }

            self::notify($params);

            return redirect()->to(route('checkout.cancel', ["status" => "failed"]))->withError('Unable to process payment, Please contact support.');

        }catch(\Exception $e){

            self::notify($params);

            \Log::info("Response Date" . $e->getMessage());
            return redirect()->to(route('checkout.cancel', ["status" => "failed"]))->withError('Oops! There was an issue with your request, we will notify the admin on your behalf.');

        }
    }

    private static function notify(array $params){
        // send notification to admin about this error

        \Log::info("Response Date" . json_encode($params));
    }

}