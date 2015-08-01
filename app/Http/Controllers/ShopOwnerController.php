<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Item;
use App\Shop;
use App\TradingHour;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Event;

class ShopOwnerController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('shop');
    }


    public function upload($file , $path)
    {
        if (Input::file('picture')->isValid()) {
            $destinationPath = public_path() . '/img/'.$path;
            $extension = Input::file('picture')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . rand(10, 100) . '.' . $extension; // renameing image
            Input::file('picture')->move($destinationPath, $fileName); // uploading file to given path
            return $fileName;
        }
        else
        {
            return false;
        }
    }

    public function shop()
    {
        return view('shop.shop');
    }

    public function shopOwnerProfile()
    {
        $id = Auth::user()->id;
        $shopOwner = DB::table('users')
            ->where('id' , '=' , $id )
            ->select('users.id' , 'users.name' , 'users.email' , 'users.type')
            ->first();
        return view('shop.shopOwnerProfile' , compact('shopOwner'));
    }

    public function getUser($id)
    {
        $user = User::find($id);
        return json_encode($user);
    }

    public function editUser($id ,Requests\editUserRequest $request)
    {
        if($request->ajax())
        {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
        }
    }


    public function editPassShopOwner(Requests\AdminPasswordRequest $request , $id)
    {
        if($request->ajax())
        {
            $hashedPassword = DB::table('users')->where('id' , '=' , $id)->select('users.password')->first();
            $hashedPassword = $hashedPassword->password;
            if(!Hash::check($request->oldPassword , $hashedPassword))
            {
                $error=[ 'Old Password is Wrong'];
                $json = ['oldPassword' => $error];
                return response()->json($json,422);
            }
            $user = User::find($id);
            $user->password = $request->password;
            $user->save();
        }
    }


    public function detail()
    {
        $shop = DB::table('shops')
            ->join('users' , 'shops.userId' , '=' ,'users.id')
            ->where('shops.userId' , Auth::user()->id)
            ->select
            (
                'shops.name' , 'shops.id' , 'shops.place' , 'shops.webSite' , 'shops.phone2',
                'shops.info' , 'shops.instagram', 'shops.phone1' , 'shops.email' , 'shops.bestParking' ,
                'shops.giftCard'
            )
            ->first();
        if($shop)
        {
            $trading = DB::table('shops')
                ->join('trading_hours' , 'shops.id' , '=' , 'trading_hours.shopId')
                ->where('shops.id' , '=' , $shop->id)
                ->select('trading_hours.monday' , 'trading_hours.tuesday' , 'trading_hours.wednesday',
                        'trading_hours.thursday' , 'trading_hours.friday' , 'trading_hours.saturday',
                        'trading_hours.sunday')
                ->get();
        }
        $cat = DB::table('cat')->select('name' , 'id')->get();
        return view('shop.detail' , compact('shop' , 'cat' , 'trading'));
    }

    public function getShop($id)
    {
        $shop = Shop::find($id);
        $shopCat = DB::table('cat')
            ->join('shop_cat' , 'cat.id' , '=' , 'shop_cat.catId')
            ->where('shop_cat.shopId' ,  '=' , $id )
            ->select('cat.name' , 'cat.id')->get();
        $trading = DB::table('trading_hours')
            ->where('trading_hours.shopId' ,  '=' , $id )
            ->join('shops' , 'trading_hours.shopId' , '=' , 'shops.id')
            ->select(
                'trading_hours.monday' , 'trading_hours.tuesday' , 'trading_hours.wednesday',
                'trading_hours.thursday' , 'trading_hours.friday' ,'trading_hours.saturday',
                'trading_hours.sunday'
            )
            ->get();
        return json_encode(array($shop , $shopCat ,$trading) );
    }


    public function editDetail(Requests\detailRequest $request , $id)
    {
        if($request->ajax())
        {
            $shop = Shop::find($id);
            $shop->name = $request->name;
            $shop->place = $request->place;
            $shop->webSite = $request->webSite;
            $shop->instagram = $request->instagram;
            $shop->facebook = $request->facebook;
            $shop->webSite = $request->webSite;
            $shop->email = $request->email;
            $shop->bestParking = $request->bestParking;
            $shop->giftCard = $request->giftCard;
            $shop->phone1 = $request->phone1;
            $shop->phone2 = $request->phone2;
            $shop->info = $request->info;
            $shop->cat()->sync($request->catId);
            $shop->save();
            TradingHour::where('shopId' , '=' , $id)->update(array(
                'monday' => $request->monday,
                'tuesday' => $request->tuesday,
                'wednesday' => $request->wednesday,
                'thursday' => $request->thursday,
                'friday' => $request->friday,
                'saturday' => $request->saturday,
                'sunday' => $request->sunday,
            ));
            DB::table('last_modifications')->truncate();
            DB::table('last_modifications')->insert(['date' => Carbon::now()]);
        }
    }

    public function photos()
    {
        $shop = DB::table('shops')
            ->join('users' , 'shops.userId' , '=' ,'users.id')
            ->where('shops.userId' , Auth::user()->id)
            ->select('shops.id' , 'shops.picture')
            ->first();
        return view('shop.photos' , compact('shop'));
    }

    public function addShopImage(Requests\ImageRequest $request, $id)
    {
        if($request->ajax())
        {
            $file = $request->file('picture');
            if($file)
            {
                $fileName = $this->upload($file , 'shop');
                $shop = Shop::find($id);
                $shop->picture = $fileName;
                $shop->save();
            }
            DB::table('last_modifications')->truncate();
            DB::table('last_modifications')->insert(['date' => Carbon::now()]);
        }
    }


    public function deleteShopImage($id)
    {
        $picture = DB::table('shops')->where('id' , '=' , $id)->select('shops.picture')->first();
        $picture = $picture->picture;
        File::delete('img/shop/'.$picture);
        DB::table('shops')->where('id' , '=' , $id)->update(array('picture' => ''));
        DB::table('last_modifications')->truncate();
        DB::table('last_modifications')->insert(['date' => Carbon::now()]);
    }


    public function sale()
    {
        $sale = DB::table('events')
            ->leftjoin('shops' , 'events.shopId' , '=' , 'shops.id')
            ->join('users' , 'shops.userId' , '=' , 'users.id')
            ->where('shops.userId' , '=' , Auth::user()->id)
            ->select
            (
                'events.startDate' , 'events.endDate' , 'events.name' , 'events.id' , 'events.name' , 'events.place' ,
                'shops.name as shop' , 'events.picture' , 'events.shopId' ,
                'events.info' , 'events.id'
            )
            ->first();
        if($sale)
        {
            if($sale->endDate < Carbon::now())
            {
                DB::table('events')
                    ->leftjoin('shops' , 'events.shopId' , '=' , 'shops.id')
                    ->join('users' , 'shops.userId' , '=' , 'users.id')
                    ->where('shops.userId' , '=' , Auth::user()->id)->delete();
            }
        }
        $shop = DB::table('shops')
            ->join('users' , 'shops.userId' , '=' ,'users.id')
            ->where('shops.userId' , Auth::user()->id)
            ->select('shops.id')
            ->first();
        return view('shop.sale' , compact('sale' , 'shop'));
    }


    public function addSale(Requests\EventRequest $request , Event $event)
    {
        if($request->ajax()){
            DB::table('events')->where('shopId' , '=' , $request->shopId)->delete();
            $event->startDate = $request->startDate;
            $event->endDate = $request->endDate;
            $event->time = $request->time;
            $event->name = $request->name;
            $event->info = $request->info;
            $event->place = $request->place;
            $event->category = $request->category;
            $event->shopId = $request->shopId;
            $event->save();
        }
    }

    public function getSale($id)
    {
        $sale = Event::find($id);
        return json_encode($sale);
    }

    public function editSale($id , Requests\EventRequest $request)
    {
        if($request->ajax())
        {
            $event = Event::find($id);
            $event->startDate = $request->startDate;
            $event->endDate = $request->endDate;
            $event->name = $request->name;
            $event->info = $request->info;
            $event->place = $request->place;
            $event->picture = $request->picture;
            $event->category = $request->category;
            $event->shopId = $request->shopId;
            $event->save();
        }
    }


    public function deleteSale($id)
    {
        $event = Event::find($id);
        $event->delete();
    }

    public function salePhoto()
    {
        $sale = DB::table('events')
            ->leftjoin('shops' , 'events.shopId' , '=' , 'shops.id')
            ->join('users' , 'shops.userId' , '=' , 'users.id')
            ->where('shops.userId' , '=' , Auth::user()->id)
            ->select('events.picture' , 'events.id')
            ->first();
        return view('shop.salePhoto' , compact('sale'));
    }

    public function addSaleImage(Requests\ImageRequest $request, $id)
    {
        if($request->ajax())
        {
            $file = $request->file('picture');
            if($file)
            {
                $fileName = $this->upload($file , 'events');
                $event = Event::find($id);
                $event->picture = $fileName;
                $event->save();
            }
        }
    }


    public function deleteSaleImage($id)
    {
        $picture = DB::table('events')->where('id' , '=' , $id)->select('events.picture')->first();
        $picture = $picture->picture;
        File::delete('img/events/'.$picture);
        DB::table('events')->where('id' , '=' , $id)->update(array('picture' => ''));
    }


    public function items()
    {
        $item = DB::table('items')
            ->join('shops' , 'items.shopId' , '=' ,'shops.id')
            ->where('shops.userId' , Auth::user()->id)
            ->select
            (
                'items.name' , 'items.id' , 'items.price' , 'shops.name as shop' , 'shops.id as shopId',
                'items.picture' , 'items.info' , 'items.updated_at'
            )
            ->orderBy('updated_at', 'desc')
            ->get();

        $shop = DB::table('shops')
            ->join('users' , 'shops.userId' , '=' ,'users.id')
            ->where('shops.userId' , Auth::user()->id)
            ->select('shops.id')
            ->first();
        return view('shop.items' , compact('item' , 'shop'));
    }


    public function createItem(Requests\ItemRequest $request , Item $item)
    {
        if($request->ajax())
        {
            $item->name = $request->name;
            $item->info = $request->info;
            $item->price = $request->price;
            $item->shopId = $request->shopId;
            $item->save();
        }
    }



    public function addItemImage(Requests\ImageRequest $request, $id)
    {
        if($request->ajax())
        {
            $file = $request->file('picture');
            if($file)
            {
                $fileName = $this->upload($file , 'items');
                $item = Item::find($id);
                $item->picture = $fileName;
                $item->save();
            }
        }
    }

    public function deleteItemImage($id)
    {
        $picture = DB::table('items')->where('id' , '=' , $id)->select('items.picture')->first();
        $picture = $picture->picture;
        File::delete('img/items/'.$picture);
        DB::table('items')->where('id' , '=' , $id)->update(array('picture' => ''));
    }


    public function getItem($id)
    {
        $item = Item::find($id);
        return json_encode($item);
    }


    public function editItem(Requests\ItemRequest $request , $id)
    {
       if($request->ajax())
       {
           $item = Item::find($id);
           $item->name = $request->name;
           $item->price = $request->price;
           $item->info = $request->info;
           $item->picture = $request->picture;
           $item->shopId = $request->shopId;
           $item->save();
       }
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);
        $item->delete();
    }

}
