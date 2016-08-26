<?php
// Routes

$app->group('/domain', function () {
    $this->get('/orders', '\OrdersController:ordersList')->setName('orders-list');

    $this->group('/api', function () {
        $this->get('/orders', '\OrdersController:apiOrdersList')->setName('api-orders-list');
        $this->post('/orders', '\OrdersController:apiCreateOrder')->setName('api-orders-add');
    });
});
