<?php

/**
 * @OA\Get(
 *     path="/orders",
 *     tags={"Orders"},
 *     summary="Get all orders",
 *     @OA\Response(
 *         response=200,
 *         description="List of all orders"
 *     )
 * )
 */
Flight::route('GET /orders', function() {
    Flight::json(Flight::orderService()->getAll());
});

/**
 * @OA\Get(
 *     path="/orders/{id}",
 *     tags={"Orders"},
 *     summary="Get order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the order",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order with given ID"
 *     )
 * )
 */
Flight::route('GET /orders/@id', function($id) {
    Flight::json(Flight::orderService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/orders",
 *     tags={"Orders"},
 *     summary="Create a new order",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="total_price", type="number"),
 *             @OA\Property(property="status", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order created"
 *     )
 * )
 */
Flight::route('POST /orders', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->create($data));
});

/**
 * @OA\Put(
 *     path="/orders/{id}",
 *     tags={"Orders"},
 *     summary="Update order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the order to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="total_price", type="number"),
 *             @OA\Property(property="status", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order updated"
 *     )
 * )
 */
Flight::route('PUT /orders/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/orders/{id}",
 *     tags={"Orders"},
 *     summary="Delete order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the order to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order deleted"
 *     )
 * )
 */
Flight::route('DELETE /orders/@id', function($id) {
    Flight::json(Flight::orderService()->delete($id));
});
