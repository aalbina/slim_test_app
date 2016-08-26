<?php
/**
 * Created by PhpStorm.
 * User: albina
 * Date: 25.08.16
 * Time: 20:15
 */

use Interop\Container\ContainerInterface;

class OrdersController
{
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function ordersList($request, $response, $args)
    {
        $orders = \Order::all();
        return $this->ci->get('renderer')->render($response, 'orders/list.phtml', ['orders' => $orders]);
    }

    public function apiOrdersList($request, $response, $args)
    {
        $orders = \Order::all()->toJson();
        $newResponse = $response->withStatus(200)->withJson($orders);

        return $newResponse;
    }

    public function apiCreateOrder($request, $response, $args)
    {
        $raw_order = $request->getParsedBody();

        try {
            $validated_order = $this->validateOrder($raw_order);

            $order = new \Order($validated_order);
            $order->save();

            $newResponse = $response->withStatus(200);
            return $newResponse;
        } catch (Error $e) {
            $this->ci->get('logger')->error($e->getMessage());

            $newResponse = $response->withStatus(404);
            return $newResponse;
        }
    }

    private function validateOrder($raw_order)
    {
        if (!preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.(19[3-9][0-9]|200[0-9])$/', $raw_order['birth'])) {
            throw new Error('Wrong birth date format was given: ' . $raw_order['birth']);
        } else {
            $raw_order['birth'] = date('Y-m-d',strtotime($raw_order['birth']));
        }

        if (!preg_match('/^\d{12}$/', $raw_order['inn'])) {
            throw new Error('Wrong INN number was given: ' . $raw_order['inn']);
        }

        if (!preg_match('/^\w+$/', $raw_order['type'])) {
            throw new Error('Wrong card type was given: ' . $raw_order['type']);
        }

        return $raw_order;
    }
}