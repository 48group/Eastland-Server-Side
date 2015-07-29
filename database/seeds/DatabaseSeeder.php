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
        $this->call('ShopTableSeeder');
        $this->call('CatTableSeeder');
        $this->call('Shop_catTableSeeder');
        $this->call('trading_hoursTableSeeder');
        $this->command->info('User table seeded!');
        $this->command->info('Cat table seeded!');
        $this->command->info('Shop table seeded!');
        $this->command->info('Shop_cat table seeded!');
        $this->command->info('trading_hours table seeded!');
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

class ShopTableSeeder extends CsvSeeder {

    public function __construct()
    {
        $this->table = 'shops';
        $this->csv_delimiter = ',';
        $this->filename = base_path().'/database/seeds/csv/shops.xlsx';
        $this->mapping = [
            0 => 'id',
            1 => 'name',
            2 => 'place',
            3 => 'phone1',
            4 => 'info',
            5 => 'giftCard',
            6 => 'bestParking',
            7 => 'webSite',
            8 => 'facebook',
            9 => 'instagram',
            10 => 'email',
            11 => 'phone2',
            12 => 'tradingHours',
            13 => 'picture',
            14 => 'categories',
            15 => 'userId',
        ];
    }
    public function run()
    {
        DB::disableQueryLog();
        DB::table('shops')->delete();
        parent::run();
    }
}

class CatTableSeeder extends CsvSeeder {

    public function __construct()
    {
        $this->table = 'cat';
        $this->csv_delimiter = ',';
        $this->filename = base_path().'/database/seeds/csv/categories.csv';
        $this->mapping = [
            0 => 'id',
            1 => 'name',
        ];
    }
    public function run()
    {
        DB::disableQueryLog();
        DB::table('cat')->delete();
        parent::run();
    }
}


class Shop_catTableSeeder extends CsvSeeder {

    public function __construct()
    {
        $this->table = 'shop_cat';
        $this->csv_delimiter = ',';
        $this->filename = base_path().'/database/seeds/csv/shop_cat.csv';
        $this->mapping = [
            0 => 'id',
            1 => 'catId',
            2 => 'shopId'
        ];
    }
    public function run()
    {
        DB::disableQueryLog();
        DB::table('shop_cat')->delete();
        parent::run();
    }
}


class Trading_hoursTableSeeder extends CsvSeeder {

    public function __construct()
    {
        $this->table = 'trading_hours';
        $this->csv_delimiter = ',';
        $this->filename = base_path().'/database/seeds/csv/trading_hours.xlsx';
        $this->mapping = [
            0 => 'id',
            1 => 'tradingHours',
            2 => 'shopId'
        ];
    }
    public function run()
    {
        DB::disableQueryLog();
        DB::table('trading_hours')->delete();
        parent::run();
    }
}




