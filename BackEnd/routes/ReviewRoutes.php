<?php

/**
 * @OA\Get(
 *     path="/reviews",
 *     tags={"Reviews"},
 *     summary="Get all reviews",
 *     @OA\Response(
 *         response=200,
 *         description="List of all reviews"
 *     )
 * )
 */
Flight::route('GET /reviews', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::reviewService()->getAll());
});

/**
 * @OA\Get(
 *     path="/reviews/{id}",
 *     tags={"Reviews"},
 *     summary="Get review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the review",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review with given ID"
 *     )
 * )
 */
Flight::route('GET /reviews/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::reviewService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/reviews",
 *     tags={"Reviews"},
 *     summary="Create a new review",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="product_id", type="integer"),
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="rating", type="integer"),
 *             @OA\Property(property="comment", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review created"
 *     )
 * )
 */
Flight::route('POST /reviews', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->create($data));
});

/**
 * @OA\Put(
 *     path="/reviews/{id}",
 *     tags={"Reviews"},
 *     summary="Update review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the review to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="product_id", type="integer"),
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="rating", type="integer"),
 *             @OA\Property(property="comment", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review updated"
 *     )
 * )
 */
Flight::route('PUT /reviews/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/reviews/{id}",
 *     tags={"Reviews"},
 *     summary="Delete review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the review to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review deleted"
 *     )
 * )
 */
Flight::route('DELETE /reviews/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::reviewService()->delete($id));
});
