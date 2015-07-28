<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!--Import materialize.css-->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link href="css/jquery-editable.css" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="css/custom.css" />
    <link type="text/css" rel="stylesheet" href="css/panel.css" />
    <link rel="stylesheet" href="css/select2.css"/>

    <!-- x editable plugins -->

    <!-- <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'> -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Poiret+One' rel='stylesheet' type='text/css'>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>

<body class="font-sourcesans">
<!-- main navbar -->
<header>
    <nav class="panel-header">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    </nav>
    <ul id="slide-out" class="side-nav fixed">
        <li class="logo">
            <a href="#">
                <img src="images/logo.png" class="responsive-img">
            </a>
        </li>
        <li>
            <a href="{{url('admin/users')}}" id="usersHref" class="menu"><i class="material-icons small left">perm_identity</i>Users</a>
        </li>
        <li>
            <a href="{{url('admin/shops')}}" id="shopsHref" class="menu"><i class="material-icons small left">shop</i>Shops</a>
        </li>
        <li>
            <a href="{{url('admin/categories')}}" id="categoriesHref" class="menu"><i class="material-icons small left">view_list</i>Catergories</a>
        </li>
        <li>
            <a href="{{url('admin/events')}}" id="eventsHref" class="menu"><i class="material-icons small left">event</i>Events</a>
        </li>
        <li>
            <a href="{{url('admin/adminProfile')}}" id="adminProfileHref" class="menu"><i class="material-icons small left">perm_identity</i>Admin Profile</a>
        </li>
        <li>
            <a href="{{url('/auth/logout')}}"><i class="mdi-action-exit-to-app small left"></i>Logout</a>
        </li>
    </ul>
</header>
<!-- end of main navbar -->