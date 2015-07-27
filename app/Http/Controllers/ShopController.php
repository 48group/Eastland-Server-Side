<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller {

	public function shopById($id)
    {
        $shops = DB::table('shops')
            ->where('id' ,  '=' , $id )
            ->select('id','name','info','picture','place')
            ->get();
        foreach($shops as $shop)
        if($shop->picture != null)
        {
            $shop->picture = '/img/shop/' . $shop->picture;
        }
        $shop = [];
        array_push($shop , $shops);
        $shopCat = [];
        foreach($shops as $shop)
        {
            $cat = DB::table('cat')
                ->join('shop_cat' , 'cat.id' , '=' , 'shop_cat.catId')
                ->where('shop_cat.shopId' ,  '=' , $id )
                ->select('cat.name')->get();
            $shop->categories = $cat;
            array_push($shopCat , $shop );
        }
        if($shops)
        {
            return response()->json($shops);
        }
        else
        {
            return response()->json(['errorMessage' => ['the shop does not exist']],404);
        }
    }

    public function shopByCategory($category)
    {
        $cat = DB::table('cat')
            ->where('name' , $category)
            ->select('id')->first();
        $shop = DB::table('shops')
            ->join('shop_cat' , 'shops.id' , '=' , 'shop_cat.shopId')
            ->where('shop_cat.catId' , '=' , $cat->id)
            ->select('shops.id','shops.name','shops.picture')
            ->get();
        foreach($shop as $s)
        {
            if($s->picture)
            {
                $s->picture = '/img/shop/' . $s->picture;
            }
        }
        $shops = [];
        array_push($shops , $shop);
        if($shop)
        {
            return response()->json($shop);
        }
        else
        {
            return response()->json(['errorMessage' => ['no shop with this cat found']],404);
        }
    }


    //get event which is for whole of the shopping center
    public function events()
    {
        $event = DB::table('events')->get();
        foreach($event as $e)
        {
            if($e->picture)
            {
                $e->picture = '/img/events/' . $e->picture;
            }
        }
        $events = [];
        array_push($events , $event );
        if($event)
        {
            return response()->json($event);
        }
        else
        {
            return response()->json(['errorMessage' => 'No event'],404);
        }
    }

    public function shops()
    {
        $shops = DB::table('shops')
            ->select
            (
                'shops.id' , 'shops.name' , 'shops.webSite' , 'shops.instagram',
                'shops.facebook' , 'shops.phone1' , 'shops.phone2' , 'shops.place',
                'shops.info' , 'shops.picture'
            )
            ->get();
        foreach($shops as $s)
        {
            if($s->picture)
            {
                $s->picture = '/img/shop/' . $s->picture;
            }
        }
        $shop = [];
        array_push($shop , $shops );
        $shopCat = [];
        foreach($shops as $shop)
        {
            $cat = DB::table('cat')
                ->join('shop_cat' , 'cat.id' , '=' , 'shop_cat.catId')
                ->where('shop_cat.shopId' ,  '=' , $shop->id )
                ->select('cat.name')->get();
            $shop->categories = $cat;
            array_push($shopCat , $shop );
        }
        if($shop)
        {
            return response()->json($shopCat);
        }
        else
        {
            return response()->json(['errorMessage' => 'No shop available'],404);
        }
    }

    public function shopItems($shopId)
    {
        $items = DB::table('items')
            ->where('shopId' , '=' , $shopId)
            ->select('items.id' , 'items.name' , 'items.price' , 'items.info' , 'items.picture')
            ->get();
        foreach($items as $i)
        {
            if($i->picture)
            {
                $i->picture = '/img/items/' . $i->picture;
            }
        }
        $item = [];
        array_push($item , $items );
        if($items)
        {
            return response()->json($items);
        }
        else
        {
            return response()->json(['errorMessage' => 'No Item available'],404);
        }
    }

    public function lastModification()
    {
        $lastModification = DB::table('lastModification')->select('lastModification.date')->first();
        if($lastModification)
        {
            return response()->json($lastModification);
        }
        else
        {
            return response()->json(['errorMessage' => 'lastModification not found'],404);
        }
    }


}
