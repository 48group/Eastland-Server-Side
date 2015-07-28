<?php namespace App\Http\Controllers;

use App\Cat;
use App\Event;
use App\Http\Requests;
use App\Phone;
use App\Shop;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function upload($file , $path)
    {
        if (Facades\Input::file('picture')->isValid()) {
            $destinationPath = public_path() . '/img/'.$path;
            $extension = Facades\Input::file('picture')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . rand(10, 100) . '.' . $extension; // renameing image
            Facades\Input::file('picture')->move($destinationPath, $fileName); // uploading file to given path
            return $fileName;
        }
        else
        {
            return false;
        }
    }

    public function adminProfile()
    {
        $admin = DB::table('users')
            ->where('type' , '=' , 'admin' )
            ->select('users.id' , 'users.name' , 'users.email' , 'users.type')
            ->first();
        return view('admin.adminProfile' , compact('admin'));
    }

	public function admin()
    {
        return view('admin.admin');
    }

    public function users()
    {
        $user = DB::table('users')
            ->where('type' , '=' , 'shopOwner' )
            ->select('users.id' , 'users.name' , 'users.email' , 'users.type')
            ->get();
        $umberOfUsers = User::count();
        return view('admin.users' , compact('user','umberOfUsers'));
    }

    public function addUser(Requests\UserRequest $request , User $user)
    {
        if($request->ajax()) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->type = $request->type;
            $user->save();
        }
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
            $user->type = $request->type;
            $user->save();
        }
    }


    public function editPassUser(Requests\PasswordRequest $request , $id)
    {
        if($request->ajax())
        {
            $user = User::find($id);
            $user->password = $request->password;
            $user->save();
        }
    }

    public function editPassAdmin(Requests\AdminPasswordRequest $request , $id)
    {
        if($request->ajax())
        {
            $hashedPassword = DB::table('users')->where('id' , '=' , $id)->select('users.password')->first();
            $hashedPassword = $hashedPassword->password;
            if(!Facades\Hash::check($request->oldPassword , $hashedPassword))
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

    public function editEmailUser(Requests\EmailRequest $request , $id)
    {
        if($request->ajax())
        {
            $user = User::find($id);
            $user->email = $request->email;
            $user->save();
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
    }


    public function shops()
    {
        $shop = DB::table('shops')
            ->leftjoin('users' , 'shops.userId' , '=' , 'users.id')
            ->select
                (
                    'shops.name' , 'shops.id' , 'users.name as shopOwner' , 'users.id as userId',
                    'shops.picture' , 'shops.info' , 'shops.place' , 'shops.updated_at',
                    'shops.phone1' , 'shops.phone2' , 'shops.email'
                )
            ->orderBy('updated_at', 'desc')
            ->get();

        $cat = DB::table('cat')->select('name' , 'id')->get();
        $user = User::where('type' , '=' , 'shopOwner')->select('name' , 'id')->get();
        $trading = DB::table('shops')
            ->join('trading_hours' , 'shops.id' , '=' , 'trading_hours.shopId')
            ->select('trading_hours.id' , 'trading_hours.tradingHours')
            ->get();
        return view('admin.shops' , compact('shop' , 'user' , 'cat' , 'trading' ));
    }

    public function createShop(Requests\ShopRequest $request, Shop $shop)
    {
        if ($request->ajax()) {
            $id = DB::table('shops')->insertGetId([
                    'name' => $request->name ,
                    'info' => $request->info,
                    'place' => $request->place,
                    'instagram' => $request->instagram,
                    'facebook' => $request->facebook,
                    'userId' => $request->userId,
                    'bestParking' => $request->bestParking,
                    'giftCard' => $request->giftCard,
                    'phone1' => $request->phone1,
                    'phone2' => $request->phone2,
                ]
            );
            foreach ($request->catId as $catId)
            {
                DB::table('shop_cat')->insert(['shopId' => $id , 'catId' => $catId]);
            }
            foreach ($request->tradingHours as $tradingHour)
            {
                DB::table('trading_hours')->insert(['shopId' => $id , 'tradingHours' => $tradingHour]);
            }
            DB::table('last_modifications')->truncate();
            DB::table('last_modifications')->insert(['date' => Carbon::now()]);
        }
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
        Facades\File::delete('img/shop/'.$picture);
        DB::table('shops')->where('id' , '=' , $id)->update(array('picture' => ''));
        DB::table('last_modifications')->truncate();
        DB::table('last_modifications')->insert(['date' => Carbon::now()]);
    }

    public function getShop($id)
    {
        $shops = DB::table('shops')
            ->where('shops.id' ,  '=' , $id )
            ->select('shops.id','shops.name','shops.info','shops.picture',
                'shops.place','shops.userId','shops.phone1','shops.phone2' , 'shops.giftCard')
            ->get();
        $shopCat = [];
        foreach($shops as $shop)
        {
            $cat = DB::table('cat')
                ->join('shop_cat' , 'cat.id' , '=' , 'shop_cat.catId')
                ->where('shop_cat.shopId' ,  '=' , $id )
                ->select('cat.id')->get();
            $shop->category = $cat;
            $trading = DB::table('trading_hours')
                ->join('shops' , 'trading_hours.shopId' , '=' , 'shops.id')
                ->where('trading_hours.shopId' ,  '=' , $id )
                ->select('trading_hours.tradingHours')
                ->get();
            $shop->tradingHours = $trading;
            array_push($shopCat , $shop );
        }
        return response()->json($shopCat);
    }

    public function editShop(Requests\ShopRequest $request , $id)
    {
        if($request->ajax())
        {
            $shop = Shop::find($id);
            $shop->name = $request->name;
            $shop->place = $request->place;
            $shop->info = $request->info;
            $shop->userId = $request->userId;
            $shop->instagram = $request->instagram;
            $shop->facebook = $request->facebook;
            $shop->phone1 = $request->phone1;
            $shop->phone2 = $request->phone2;
            $shop->save();
            DB::table('shop_cat')->where('shopId' , '=' , $id)->delete();
            foreach ($request->catId as $catIds)
            {
                DB::table('shop_cat')->insert(['shopId' => $id , 'catId' => $catIds]);
            }
            DB::table('trading_hours')->where('shopId' , '=' , $id)->delete();
            foreach ($request->tradingHours as $tradingHour)
            {
                DB::table('trading_hours')->insert(['shopId' => $id , 'tradingHours' => $tradingHour]);
            }
            DB::table('last_modifications')->truncate();
            DB::table('last_modifications')->insert(['date' => Carbon::now()]);
        }

    }

    public function deleteShop($id)
    {
        $shop = Shop::find($id);
        $shop->delete();
        DB::table('last_modifications')->truncate();
        DB::table('last_modifications')->insert(['date' => Carbon::now()]);
    }


    public function category()
    {
        $cat = Cat::latest('updated_at')->get();
        return view('admin.categories' , compact('cat'));
    }

    public function addCategory(Requests\CategoryRequest $request , Cat $cat)
    {
        if($request->ajax())
        {
            $cat->name = $request->name;
            $cat->save();
        }
    }


    public function getCategory($id)
    {
        $cat = Cat::find($id);
        return json_encode($cat);
    }


    public function editCategory(Requests\CategoryRequest $request , $id)
    {
        if($request->ajax())
        {
            $cat = Cat::find($id);
            $cat->name = $request->name;
            $cat->save();
        }
    }

    public function deleteCategory($id)
    {
        $cat = Cat::find($id);
        $cat->delete();
    }


    public function events()
    {
        $event = DB::table('events')
            ->leftjoin('shops' , 'events.shopId' , '=' , 'shops.id')
            ->select
            (
                'events.startDate' , 'events.endDate' , 'events.id' , 'events.name' , 'events.place' , 'shops.name as shop' ,
                'events.picture' , 'events.category' , 'events.info' , 'events.time'
            )
            ->orderBy('startDate', 'desc')
            ->get();
        $shop = DB::table('shops')
            ->select('shops.name' , 'shops.id')
            ->get();
        if($event)
        {
            foreach($event as $events)
            {
                if($events->endDate < Carbon::now())
                {
                    DB::table('events')
                        ->leftjoin('shops' , 'events.shopId' , '=' , 'shops.id')->delete();
                }
            }
        }
        return view('admin.events' , compact('event' , 'shop'));
    }


    public function createEvent(Requests\EventRequest $request , Event $event)
    {
        if($request->ajax())
        {
            if($request->category == 'sale')
            {
                DB::table('events')->where('shopId' , '=' , $request->shopId)->delete();
            }
            $event->startDate = $request->startDate;
            $event->endDate = $request->endDate;
            $event->name = $request->name;
            $event->info = $request->info;
            $event->place = $request->place;
            $event->category = $request->category;
            $event->shopId = $request->shopId;
            $event->time = $request->time;
            $event->save();
        }
    }

    public function getEvent($id)
    {
        $event = Event::find($id);
        return json_encode($event);
    }

    public function editEvent(Requests\EventRequest $request , $id)
    {
        if($request->ajax())
        {
            $event = Event::find($id);
            $event->startDate = $request->startDate;
            $event->endDate = $request->endDate;
            $event->name = $request->name;
            $event->info = $request->info;
            $event->place = $request->place;
            $event->category = $request->category;
            $event->shopId = $request->shopId;
            $event->save();
        }
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->delete();
    }


    public function addEventImage($id , Requests\ImageRequest $request)
    {
        if($request->ajax())
        {
            $file = $request->file('picture');
            if($file)
            {
                $newNamePrefix = time() . '_';
                $manipulator = new ImageManipulator($_FILES['fileToUpload']['tmp_name']);
                $width  = $manipulator->getWidth();
                $height = $manipulator->getHeight();
                $centreX = round($width / 2);
                $centreY = round($height / 2);
                // our dimensions will be 200x130
                $x1 = $centreX - 100; // 200 / 2
                $y1 = $centreY - 65; // 130 / 2

                $x2 = $centreX + 100; // 200 / 2
                $y2 = $centreY + 65; // 130 / 2

                // center cropping to 200x130
                $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                // saving file to uploads folder
                $manipulator->save('uploads/' . $newNamePrefix . $_FILES['fileToUpload']['name']);
                $fileName = $this->upload($file , 'events');
                $event = Event::find($id);
                $event->picture = $fileName;
                $event->save();
            }
        }
    }

    public function deleteEventImage($id)
    {
        $picture = DB::table('events')->where('id' , '=' , $id)->select('events.picture')->first();
        $picture = $picture->picture;
        Facades\File::delete('img/events/'.$picture);
        DB::table('events')->where('id' , '=' , $id)->update(array('picture' => ''));
    }


}
