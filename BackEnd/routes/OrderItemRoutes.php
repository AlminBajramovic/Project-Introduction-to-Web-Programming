<?php

/**
 * @OA\Get(
 *     path="/order-items",
 *     tags={"OrderItems"},
 *     summary="Get all order items",
 *     @OA\Response(
 *         response=200,
 *         description="List of all order items"
 *     )
 * )
 */
Flight::route('GET /order-items', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::orderItemService()->getAll());
});

/**
 * @OA\Get(
 *     path="/order-items/{id}",
 *     tags={"OrderItems"},
 *     summary="Get order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the order item",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item with given ID"
 *     )
 * )
 */
Flight::route('GET /order-items/@id', function ($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::orderItemService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/order-items",
 *     tags={"OrderItems"},
 *     summary="Create a new order item",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="order_id", type="integer"),
 *             @OA\Property(property="product_id", type="integer"),
 *             @OA\Property(property="quantity", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item created"
 *     )
 * )
 */
Flight::route('POST /order-items', function () {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemService()->create($data));
});

/**
 * @OA\Put(
 *     path="/order-items/{id}",
 *     tags={"OrderItems"},
 *     summary="Update order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the order item to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="order_id", type="integer"),
 *             @OA\Property(property="product_id", type="integer"),
 *             @OA\Property(property="quantity", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item updated"
 *     )
 * )
 */
Flight::route('PUT /order-items/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/order-items/{id}",
 *     tags={"OrderItems"},
 *     summary="Delete order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the order item to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item deleted"
 *     )
 * )
 */
Flight::route('DELETE /order-items/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::orderItemService()->delete($id));
});
