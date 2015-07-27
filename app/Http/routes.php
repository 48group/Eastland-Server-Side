<?php

Route::post('user/register' , 'UserController@register');
Route::post('user/login' , 'UserController@login');
Route::get('user/logout/{token}/{deviceId}' , 'UserController@logout');

get('user/{token}',[
    'as'=>'user/{token}',
    'uses' => 'ProfileController@profile',
    'middleware' => 'user'
]);


post('setUserPic/{token}' ,[
    'as'=>'setUserPic/{token}',
    'uses' => 'ProfileController@setUserPic',
    'middleware' => 'user'
]);

get('deleteUserPic/{token}',[
    'as'=>'deleteUserPic/{token}',
    'uses' => 'ProfileController@deleteUserPic',
    'middleware' => 'user'
]);

get('shoppingList/{token}',[
    'as'=>' user/shoppingList/{token}' ,
    'uses'=>'ProfileController@shoppingList',
    'middleware' => 'user'
]);

get('shoppingList/{shoppingListId}/{token}',[
    'as'=>'shoppingList/{shoppingListId}/{token}' ,
    'uses'=>'ProfileController@shoppingListItems',
    'middleware' => 'user'
]);


post('createShoppingList/{token}',[
    'as'=>'user/createShoppingList/{token}' ,
    'uses'=>'ProfileController@createShoppingList',
    'middleware' => 'user'
]);

post('addShoppingListItem/{shoppingListId}/{token}',[
    'as'=>'addShoppingListItem/{shoppingListId}/{token}' ,
    'uses'=>'ProfileController@addShoppingListItem',
    'middleware' => 'user'
]);

get('deleteShoppingList/{shoppingListId}/{token}',[
    'as'=>'deleteShoppingList/{shoppingListId}/{token}' ,
    'uses'=>'ProfileController@deleteShoppingList',
    'middleware' => 'user'
]);

post('deleteShoppingListItem/{shoppingListId}/{token}',[
    'as'=>'deleteShoppingListItem/{shoppingListId}/{token}' ,
    'uses'=>'ProfileController@deleteShoppingListItem',
    'middleware' => 'user'
]);

get('shop/{id}' ,'ShopController@shopById')->where('id', '[0-9]+');
get('shop/events' , 'ShopController@events');
get('shops' , 'ShopController@shops');
get('shop/{category}' , 'ShopController@shopByCategory');
get('shopItems/{shopId}' , 'ShopController@shopItems');

post('user/edit/{token}' ,[
    'as' => 'user/edit/{token}',
    'uses' => 'ProfileController@editProfile',
    'middleware' => 'user'
]);

post('user/editPassword/{token}' ,[
    'as' => 'user/editPassword/{token}',
    'uses' => 'ProfileController@editPassword',
    'middleware' => 'user'
]);

get('user/fave/{shopId}/{token}' ,[
    'as' => 'user/fave/{shopId}/{token}' ,
    'uses' => 'ProfileController@fave',
    'middleware' => 'user'
]);

get('user/unfave/{shopId}/{token}' , [
    'as' => 'user/unfave/{shopId}/{token}' ,
    'uses' => 'ProfileController@unFave',
    'middleware' => 'user'
]);

get('user/faves/{token}' ,[
    'as' => 'user/faves/{token}' ,
    'uses' => 'ProfileController@faves',
    'middleware' => 'user'
]);

get('user/events/{token}' , [
    'as' => 'user/events/{token}' ,
    'uses' => 'ProfileController@sales',
    'middleware' => 'user'
]);

Route::get('shops/lastModification' , 'ShopController@lastModification');


//Panel Routes

//managers login
Route::get('/', 'Auth\AuthController@getLogin');
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

//admin homepage
Route::get('admin', 'AdminController@admin');
Route::get('admin/adminProfile', 'AdminController@adminProfile');

// admin Users Routes
Route::get('admin/users', 'AdminController@users');
Route::get('admin/getUser/{id}' , 'AdminController@getUser');
Route::post('admin/addUser', 'AdminController@addUser');
Route::post('admin/editUser/{id}', 'AdminController@editUser');
Route::post('admin/editPassUser/{id}', 'AdminController@editPassUser');
Route::post('admin/editPassAdmin/{id}', 'AdminController@editPassAdmin');
Route::post('admin/editEmailUser/{id}', 'AdminController@editEmailUser');
Route::get('admin/deleteUser/{id}', 'AdminController@deleteUser');
Route::get('userExists', 'AdminController@userExists');
Route::get('EditUserExists/{id}', 'AdminController@EditUserExists');
Route::get('deleteUser/{id}', 'AdminController@deleteUser');


//admin shop routes
Route::get('admin/shops', 'AdminController@shops');
Route::post('admin/createShop', 'AdminController@createShop');
Route::get('admin/getShop/{id}', 'AdminController@getShop');
Route::post('admin/editShop/{id}', 'AdminController@editShop');
Route::get('admin/deleteShop/{id}', 'AdminController@deleteShop');
Route::post('admin/addShopImage/{id}', 'AdminController@addShopImage');
Route::get('admin/deleteShopImage/{id}', 'AdminController@deleteShopImage');



//admin categories routes
Route::get('admin/categories', 'AdminController@category');
Route::post('admin/addCategory', 'AdminController@addCategory');
Route::get('admin/getCategory/{id}', 'AdminController@getCategory');
Route::post('admin/editCategory/{id}', 'AdminController@editCategory');
Route::get('admin/deleteCategory/{id}', 'AdminController@deleteCategory');


//admin events routes
Route::get('admin/events', 'AdminController@events');
Route::post('admin/createEvent', 'AdminController@createEvent');
Route::get('admin/getEvent/{id}', 'AdminController@getEvent');
Route::post('admin/editEvent/{id}', 'AdminController@editEvent');
Route::get('admin/deleteEvent/{id}', 'AdminController@deleteEvent');
Route::post('admin/addEventImage/{id}', 'AdminController@addEventImage');
Route::get('admin/deleteEventImage/{id}', 'AdminController@deleteEventImage');


//home of shopOwner
Route::get('shopOwner', 'ShopOwnerController@shop');
Route::get('shopOwner/shopOwnerProfile', 'ShopOwnerController@shopOwnerProfile');
Route::get('shopOwner/getUser/{id}' , 'ShopOwnerController@getUser');
Route::post('shopOwner/editUser/{id}', 'ShopOwnerController@editUser');
Route::post('shopOwner/editPassShopOwner/{id}', 'ShopOwnerController@editPassShopOwner');




//shopOwners shop Routes
Route::get('shopOwner/getShop/{id}' , 'ShopOwnerController@getShop');
Route::get('shopOwner/getCat/{id}' , 'ShopOwnerController@getCat');
Route::get('shopOwner/detail', 'ShopOwnerController@detail');
Route::post('shopOwner/editDetail/{id}' , 'ShopOwnerController@editDetail');


//shopOwner items routes
Route::get('shopOwner/items', 'ShopOwnerController@items');
Route::post('shopOwner/createItem', 'ShopOwnerController@createItem');
Route::get('shopOwner/getItem/{id}', 'ShopOwnerController@getItem');
Route::post('shopOwner/editItem/{id}', 'ShopOwnerController@editItem');
Route::get('shopOwner/deleteItem/{id}', 'ShopOwnerController@deleteItem');
Route::post('shopOwner/addItemImage/{id}', 'ShopOwnerController@addItemImage');
Route::get('shopOwner/deleteItemImage/{id}', 'ShopOwnerController@deleteItemImage');



//shopOwner shop photos Routes
Route::get('shopOwner/photos', 'ShopOwnerController@photos');
Route::post('shopOwner/addShopImage/{id}', 'ShopOwnerController@addShopImage');
Route::get('shopOwner/deleteShopImage/{id}', 'ShopOwnerController@deleteShopImage');



//shopOwner sale Route
Route::get('shopOwner/sale', 'ShopOwnerController@sale');
Route::post('shopOwner/addSale', 'ShopOwnerController@addSale');
Route::get('shopOwner/getSale/{id}', 'ShopOwnerController@getSale');
Route::post('shopOwner/editSale/{id}', 'ShopOwnerController@editSale');
Route::get('shopOwner/deleteSale/{id}', 'ShopOwnerController@deleteSale');


//shopOwner shop photos Routes
Route::get('shopOwner/salePhoto', 'ShopOwnerController@salePhoto');
Route::post('shopOwner/addSaleImage/{id}', 'ShopOwnerController@addSaleImage');
Route::get('shopOwner/deleteSaleImage/{id}', 'ShopOwnerController@deleteSaleImage');



