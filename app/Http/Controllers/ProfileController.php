<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller {

    public function __construct()
    {

    }

    public function profile($token)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $userId = $userId->userId;
        $user = DB::table('users')
            ->select('id','name','email','picture','saleAlert')
            ->where('id', $userId)
            ->first();
        if($user->picture)
        {
            $user->picture = '/img/profile/' . $user->picture;
        }
        $profile = [];
        array_push($profile , $user );
        if($user)
        {
            return response()->json($profile);
        }
        else
        {
            return response()->json(['errorMessage' => 'user not found'],404);
        }
    }


    public function setUserPic($token)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $userId = $userId->userId;
        $file = array('image' => Input::file('image'));
        $rules = array('image' => 'required|image|max:200',);
        $validator = Validator::make($file, $rules);
        if ($validator->fails())
        {
            $error = $validator->errors()->all();
            return response()->json(['errorMessage' => $error],404);
        }
        else
        {
            if (Input::file('image')->isValid())
            {
                $destinationPath = public_path() . '/img/profile';
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileName = 'image' . $userId . '.'.$extension;
                Input::file('image')->move($destinationPath, $fileName);
                $user = User::find($userId);
                if($user->picture != null)
                {
                    $picture = DB::table('users')->where('id' , '=' , $userId)->select('users.picture')->first();
                    $picture = $picture->picture;
                    File::delete('img/profile/'.$picture);
                    DB::table('users')->where('id' , '=' , $userId)->update(array('picture' => ''));
                }
                $user->picture = $fileName;
                $user->save();
                return response()->json(['message' => 'file uploaded']);
            }
            else
            {
                return response()->json(['errorMessage' => 'upload failed'],404);
            }
        }
    }


    public function deleteUserPic($token)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $picture = DB::table('users')->where('id' , '=' , $userId->userId)->select('users.picture')->first();
        $picture = $picture->picture;
        File::delete('img/profile/'.$picture);
        DB::table('users')->where('id' , '=' , $userId->userId)->update(array('picture' => ''));
        return response()->json(['message' => 'file has been deleted']);
    }


    public function shoppingList($token)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $userId = $userId->userId;
        $shoppingList = DB::table('shopping_lists')
            ->where('userId' , $userId)
            ->select('shopping_lists.id' , 'shopping_lists.name')
            ->get();
        if($shoppingList)
        {
            return response()->json($shoppingList);
        }
        else
        {
            return response()->json(['errorMessage' => 'shopping list not found'],404);
        }
    }


        public function shoppingListItems($shoppingListId , $token)
        {
            $userId = DB::table('tokens')
                ->where('token' , '=' , $token)
                ->select('tokens.userId')
                ->first();
            $user = DB::table('shopping_lists')
                ->where('userId' , '=' , $userId->userId)
                ->select('shopping_lists.id')
                ->get();
            $arr = [];
            foreach($user as $u)
            {
                $u->id = (string)$u->id;
                array_push($arr , $u->id);
            }
            if(in_array($shoppingListId, $arr , true))
            {
                $shoppingListItems = DB::table('item_shopping_list')
                    ->where('shoppingListId', $shoppingListId)
                    ->join('items' , 'item_shopping_list.itemId' , '=' , 'items.id' )
                    ->select('items.id','items.name','items.picture','items.price','items.info','items.shopId')
                    ->get();
                if($shoppingListItems)
                {
                    foreach($shoppingListItems as $item)
                    {
                        if($item->picture != null)
                        {
                            $item->picture = '/img/items/' . $item->picture;
                        }
                    }
                    $shoppingListItem = [];
                    array_push($shoppingListItem , $shoppingListItems);
                    if($shoppingListItems)
                    {
                        return response()->json($shoppingListItem);
                    }
                }
                else
                {
                    return response()->json(['errorMessage' => 'not found'],404);
                }
            }
            else
            {
                return response()->json(['errorMessage' => 'not found'],404);
            }
        }



    public function createShoppingList($token ,Request $request)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $input = $request->json()->all();
        $validator = Validator::make($input, [
            'listName' => 'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return response()->json(['errorMessage' => $error], 404);
        }
        $listName = $input['listName'];
        DB::table('shopping_lists')->insert(['name' => $listName , 'userId' => $userId->userId]);
        return response()->json(['message' => 'list has been created']);
    }


    public function addShoppingListItem($shoppingListId ,$token , Request $request)
    {
        $input = $request->json()->all();
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $shoppingList = DB::table('shopping_lists')
            ->where('id', '=' , $shoppingListId)
            ->where('userId' , '=' , $userId->userId)
            ->select('shopping_lists.id')
            ->first();
        if($shoppingList)
        {
            foreach($input as $item)
            {
                $oldItem = DB::table('item_shopping_list')->where('itemId' , '=' , $item['id'])->first();
                if($oldItem)
                {
                }
                else
                {
                    DB::table('item_shopping_list')
                        ->insert(['itemId' => $item['id'] , 'shoppingListId' => $shoppingListId ]);
                }
            }
            return response()->json(['message' => 'items has been added']);
        }

    }


    public function deleteShoppingList($shoppingListId , $token)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $list = DB::table('shopping_lists')
            ->where('id' , '=' , $shoppingListId)
            ->where('userId' , '=' , $userId->userId)
            ->delete();
        if($list == 1)
        {
            return response()->json(['message' => 'list has been deleted']);
        }
        else
        {
            return response()->json(['error message' => 'list not found']);
        }

    }

    public  function deleteShoppingListItem($shoppingListId , $token,Request $request)
    {
        $input = $request->json()->all();
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $shoppingList = DB::table('shopping_lists')
            ->where('id', '=' , $shoppingListId)
            ->where('userId' , '=' , $userId->userId)
            ->select('shopping_lists.id')
            ->first();
        if($shoppingList)
        {
            foreach($input as $item)
            {
                DB::table('item_shopping_list')
                    ->where('shoppingListId' , '=' , $shoppingListId)
                    ->where('itemId' , '=' , $item['id'])
                    ->delete();
            }
            return response()->json(['message' => 'Item from list has been deleted']);
        }
        else
        {
            return response()->json(['error message' => 'List not found']);
        }

    }


    public function editProfile($token , Request $request)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $userId = $userId->userId;
        $input = $request->json()->all();
        $validEmail = DB::table('users')
            ->whereNotIn('id' , [$userId])
            ->where('email' , $input['email'])
            ->first();
        if($validEmail)
        {
            return response()->json(['errorMessage' => 'email must be unique'],404);
        }
        $validator = Validator::make($input, [
            'name'      => 'required',
            'email'     => 'required|email',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return response()->json(['errorMessage' => $error],404);
        }
        $user = User::find($userId);
        $user->fill($input);
        $user->save();
        return response()->json(['message' => 'user has been updated']);
    }

    public function editPassword($token , Request $request)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $userId = $userId->userId;
        $input = $request->json()->all();
        $validator = Validator::make($input, [
            'oldPassword'      => 'required',
            'password'     => 'required|min:6|confirmed|different:oldPassword',
        ]);
        if ($validator->fails())
        {
            $error = $validator->errors()->all();
            return response()->json(['errorMessage' => $error],404);
        }
        $hashedPassword = DB::table('users')->where('id' , '=' , $userId)->select('users.password')->first();
        $hashedPassword = $hashedPassword->password;
        if(!Hash::check($input['oldPassword'] , $hashedPassword))
        {
            $error = 'Old Password is Wrong';
            return response()->json(['errorMessage' => $error],404);
        }
        $user = User::find($userId);
        $user->password = $input['password'];
        $user->save();
        return response()->json(['message' => 'user Password has been updated']);
    }

    //fave a shop for auth user
    public function fave($shopId , $token)
    {
        $shop = DB::table('shops')->where('id' , $shopId)->get();
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        if($shop)
        {
            DB::table('shop_user')->insert(array('shopId' => $shopId , 'userId' => $userId->userId ));
            return response()->json(['message' => 'your fave shop has been inserted']);
        }
        else
        {
            return response()->json(["errorMessage" => "your fave shop has been failed"],404);
        }
    }



    //unFave a shop for auth user
    public function unFave($shopId , $token)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $result = DB::table('shop_user')
            ->where('shopId' , $shopId)
            ->where('userId' , $userId->userId)
            ->delete();
        if($result != 0 )
        {
            return response()->json(['message' => 'your fave shop has been deleted']);
        }
        else
        {
            return response()->json(["errorMessage" => "this shop does not exist"],404);
        }
    }


    //get user faves list
    public function faves($token)
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $result = DB::table('shop_user')
            ->where('shop_user.userId' , '=' , $userId->userId)
            ->join('shops' , 'shop_user.shopId' , '=' , 'shops.id')
            ->select('shops.id')
            ->get();
        if($result)
        {
            return response()->json($result);
        }
        return response()->json(["errorMessage" => "request has been failed"],404);
    }



    //get users fave shops events
    public function sales($token )
    {
        $userId = DB::table('tokens')
            ->where('token' , '=' , $token)
            ->select('tokens.userId')
            ->first();
        $sale = DB::table('events')
            ->where('userId' , $userId->userId)
            ->join('shop_user', 'shop_user.shopId', '=' , 'events.shopId')
            ->select('events.id' , 'events.startDate' , 'events.endDate' ,
                'events.place' , 'events.info' , 'events.category' ,
                'events.shopId' , 'events.picture')
            ->get();
        if($sale)
        {
            foreach($sale as $s)
            {
                if($s->picture)
                {
                    $s->picture = '/img/events/' . $s->picture;
                }
            }
        }
        $sales = [];
        array_push($sales , $sale );
        if($sale)
        {
            return response()->json($sales);
        }
        else
        {
            return response()->json(['errorMessage' => 'no sale'],404);
        }
    }

}
