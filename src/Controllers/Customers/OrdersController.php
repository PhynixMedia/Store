<?php

namespace Store\Manager\Controllers\Orders;

use Store\Manager\Controllers\AppController;

class OrdersController extends AppController {

    public function __construct(){

        parent::__construct();
    }

    public function fulfilment(){

        // payload array to be sent to server
        $response = $this->orderService->checkout(cart_checkout());
        if(_value($response, "status") == "success"){
            return redirect()->to(route('checkout.success', ["status"=>"success"]))->withSuccess('Payment successfully processed.');
        }
        return redirect()->to(route('checkout.cancel', ["status"=>"failed"]))->withError('Unable to process payment, Please contact support.');

    }

}