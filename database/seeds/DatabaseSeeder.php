<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Flynsarmy\CsvSeeder\CsvSeeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');
        $this->call('CatTableSeeder');
        $this->call('ShopTableSeeder');
//        $this->call('ExcelTableSeeder');
        $this->command->info('User table seeded!');
        $this->command->info('Cat table seeded!');
        $this->command->info('Shop table seeded!');
    }

}
class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        $user = App\User::create(
            array(
                'name' => 'admin',
                'type' => 'admin',
                'password' => '123456',
                'email' => 'admin@mail.com'
            ));
        $user = App\User::create(
            array(
                'name' => 'marzie',
                'type' => 'shopOwner',
                'password' => '123456',
                'email' => 'marzie@mail.com'
            ));
        $user = App\User::create(
            array(
                'name' => 'test',
                'type' => 'shopOwner',
                'password' => '123456',
                'email' => 'test@mail.com'
            ));
    }
}





class ShopTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('shops')->delete();

        $shop = App\Shop::create(
            array(
                'name' => 'Eastland Shopping Center',
            ));
    }
}


class CatTableSeeder extends Seeder {

    public function run()
    {
        DB::table('cat')->delete();
        $cats = [
            ['name' => 'Bags & Luggage'],
            ['name' => 'Books'],
            ['name' => 'Chemists & Medical'],
            ['name' => 'Cinemas'],
            ['name' => 'Discount / Variety Stores'],
            ['name' => 'Dry Cleaners & Alterations'],
            ['name' => 'Fashion - Accessories'],
            ['name' => 'Fashion - Family'],
            ['name' => 'Fashion - Female'],
            ['name' => 'Fashion - Footwear'],
            ['name' => 'Fashion - Kids'],
            ['name' => 'Fashion - Lingerie'],
            ['name' => 'Fashion - Male'],
            ['name' => 'Fitness'],
            ['name' => 'Food - Bakeries'],
            ['name' => 'Food - Butcher'],
            ['name' => 'Food - Cafes & Restaurants'],
            ['name' => 'Food - Foodcourt & Takeaway'],
            ['name' => 'Food - Fresh'],
            ['name' => 'Gifts, Cards & Stationery'],
            ['name' => 'Health, Hair & Beauty'],
            ['name' => 'Hobbies & Crafts'],
            ['name' => 'Homewares & Lifestyle'],
            ['name' => 'Ice Cream & Confectionery'],
            ['name' => 'Jewellery & Watches'],
            ['name' => 'Liquor'],
            ['name' => 'Mobile Phones, Communications & Electrical'],
            ['name' => 'Office Supplies'],
            ['name' => 'Optical'],
            ['name' => 'Post Office'],
            ['name' => 'Services'],
            ['name' => 'Sportswear & Equipment'],
            ['name' => 'Supermarkets'],
            ['name' => 'Toys & Games']
       ] ;
        \App\Cat::insert($cats);

    }

}

//class ExcelTableSeeder extends CsvSeeder {
//
//    public function __construct()
//    {
//        $this->table = 'cat';
//        $this->csv_delimiter = ',';
//        $this->filename = base_path().'/database/seeds/csv/category.csv';
//        $this->mapping = [
//            0 => 'id',
//            1 => 'name',
//        ];
//    }
//
//    public function run()
//    {
//        DB::disableQueryLog();
//        DB::table('cat')->delete();
//        parent::run();
//    }
//}