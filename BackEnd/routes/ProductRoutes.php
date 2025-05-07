<?php

/**
 * @OA\Get(
 *     path="/products",
 *     tags={"Products"},
 *     summary="Get all products",
 *     @OA\Response(
 *         response=200,
 *         description="List of all products"
 *     )
 * )
 */
Flight::route('GET /products', function(){
    Flight::json(Flight::productService()->getAll());
});

/**
 * @OA\Get(
 *     path="/products/{id}",
 *     tags={"Products"},
 *     summary="Get product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the product",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product with given ID"
 *     )
 * )
 */
Flight::route('GET /products/@id', function($id){
    Flight::json(Flight::productService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/products",
 *     tags={"Products"},
 *     summary="Create a new product",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="price", type="number"),
 *             @OA\Property(property="description", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product created"
 *     )
 * )
 */
Flight::route('POST /products', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->createProduct($data));
});

/**
 * @OA\Put(
 *     path="/products/{id}",
 *     tags={"Products"},
 *     summary="Update a product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the product to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="price", type="number"),
 *             @OA\Property(property="description", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product updated"
 *     )
 * )
 */
Flight::route('PUT /products/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/products/{id}",
 *     tags={"Products"},
 *     summary="Delete a product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the product to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product deleted"
 *     )
 * )
 */
Flight::route('DELETE /products/@id', function($id){
    Flight::json(Flight::productService()->delete($id));
});
