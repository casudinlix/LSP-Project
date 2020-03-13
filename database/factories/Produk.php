<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produk;
use Faker\Generator as Faker;

$factory->define(Produk::class, function (Faker $faker) {
    return [
        'kode' => $faker->postcode,
        'name' => $faker->slug,
        'harga' => $faker->randomDigit,
        'stok' => $faker->randomDigit //factory(\App\Produk::class, 10)->create()
    ];
});
