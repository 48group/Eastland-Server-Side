<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!--Import materialize.css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link href="css/jquery-editable.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/select2.css"/>
    <link type="text/css" rel="stylesheet" href="css/custom.css" />
    <link type="text/css" rel="stylesheet" href="css/panel.css" />
    <!-- x editable plugins -->
        <!-- <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'> -->
    {{--<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Poiret+One' rel='stylesheet' type='text/css'>--}}
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>

<body class="font-sourcesans">
<!-- main navbar -->
<header>
    <!-- <nav class="blue-grey lighten-5">



    </nav> -->
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
            <a href="{{ url('/shopOwner/detail') }}" class="menu" id="detailHref"><i class="mdi-action-description small left"></i>Details</a>
        </li>
        <li>
            <a href="{{ url('/shopOwner/photos') }}" class="menu" id="photosHref"><i class="mdi-image-photo-library small left"></i>Shop Photo</a>
        </li>
        <li>
            <a href="{{ url('/shopOwner/items') }}" class="menu" id="itemsHref"><i class="mdi-action-list small left"></i>Items</a>
        </li>
        <li>
            <a href="{{ url('/shopOwner/sale') }}" class="menu" id="saleHref"><i class="mdi-social-pages small left"></i>Sale</a>
        </li>
        <li>
            <a href="{{ url('/shopOwner/salePhoto') }}" class="menu" id="salePhotoHref"><i class="mdi-image-photo-library small left"></i>Sale Photo</a>
        </li>
        <li>
            <a href="{{url('shopOwner/shopOwnerProfile')}}" id="shopOwnerProfileHref" class="menu"><i class="material-icons small left">perm_identity</i>ShopOwner Profile</a>
        </li>
        <li>
            <a href="{{ url('/auth/logout') }}"><i class="mdi-action-exit-to-app small left"></i>Logout</a>
        </li>
    </ul>
</header>
<!-- end of main navbar -->