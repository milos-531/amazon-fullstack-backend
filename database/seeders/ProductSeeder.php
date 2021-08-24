<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name'=>'Oppo mobile',
                "price"=>"300",
                "description"=>"A smartphone with 8gb ram and much more feature",
                "category"=>"mobile",
                "rating" =>"3",
                "image"=>"https://assetscdn1.paytm.com/images/catalog/product/M/MO/MOBOPPO-A52-6-GFUTU6297453D3D253C/1592019058170_0..png"
            ],
            [
                'name'=>'Panasonic Tv',
                "price"=>"400",
                "description"=>"A smart tv with much more feature",
                "category"=>"tv",
                "rating" =>"2",
                "image"=>"https://i.gadgets360cdn.com/products/televisions/large/1548154685_832_panasonic_32-inch-lcd-full-hd-tv-th-l32u20.jpg"
            ],
            [
                'name'=>'Soni Tv',
                "price"=>"500",
                "description"=>"A tv with much more feature",
                "category"=>"tv",
                "rating" =>"5",
                "image"=>"https://4.imimg.com/data4/PM/KH/MY-34794816/lcd-500x500.png"
            ],
            [
                'name'=>"Dubliners: Centennial Edition (Penguin Classics Deluxe Edition)",
                "price"=>"8",
                "description"=>"Special edition of Joyce's most famous work.",
                "category"=>"books",
                "rating" =>"5",
                "image"=>"https://images-na.ssl-images-amazon.com/images/I/51ySJimFL4L._SX331_BO1,204,203,200_.jpg"
            ],
             [
                'name'=>'The Best of Fyodor Dostoevsky',
                "price"=>"34.99",
                "description"=>"The best works of Fyodor Dostoevsky. Including The Idiot, Crime and Punishment, and many more.",
                "category"=>"books",
                "rating" =>"5",
                "image"=>"https://images-na.ssl-images-amazon.com/images/I/41Z15h9JmmL._SY498_BO1,204,203,200_.jpg"
             ],
             [
                'name'=>'Nintendo Switch',
                "price"=>"274.49",
                "description"=>"Nintendo Switch with Neon Blue and Neon Red Joy‑Con - HAC-001(-01)",
                "category"=>"gaming",
                "rating" =>"4",
                "image"=>"https://m.media-amazon.com/images/I/61-PblYntsL._AC_SX466_.jpg"
             ],
             [
                'name'=>"Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers",
                "price"=>"53.38",
                "description"=>"Upgraded Turntable Audio Sound| Includes Extra Stylus | Turquoise, Model Number: VSC-550BT-TQ",
                "rating" =>"4",
                "category"=>"music",
                "image"=>"https://m.media-amazon.com/images/I/71ZL0B3kwhS._AC_SX679_.jpg"

             ]
        ]);
    }
}
