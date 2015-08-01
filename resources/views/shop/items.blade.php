<!-- main container -->
<main>
    <!-- side bar -->

    <section class="shop-items">
        <!-- row begin -->
        <div class="row">
            <div class="col s12">
                <h2 class="grey-text text-lighten-4">Items</h2>
            </div>
        </div>
        <div class="row">
            @if($item != null)
                @foreach($item as $items)
                    <div class="col m3 s6">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <a href="#addItemImage" class="modal-trigger addImage" data-id="{{$items->id}}"><i class="material-icons blue-text">add</i></a>
                                <a href="#deleteItemImage" class="modal-trigger deleteImage" @if($items->picture == null)style="display: none"@endif  data-id="{{$items->id}}"><i class="material-icons red-text">delete</i></a>
                                @if($items->picture == null)
                                    <img class="activator" src="images/items/4.gif">
                                @else
                                    <img class="activator" src="{{ asset('/img/items/' . $items->picture) }}"/>
                                @endif
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">{{$items->name}}</span>
                                <p>{{$items->price}} $</p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">Description <i class="mdi-navigation-close right"></i></span>
                                <p>{{$items->info}}</p>
                            </div>
                            <div class="card-delete">
                                <a class="btn-floating red action-edit blue modal-trigger" href="#itemEditModal"><i class="material-icons editItem"  data-id="{{$items->id}}">mode_edit</i></a>
                                <a class="btn-floating red action-delete modal-trigger deleteBtn @if($items == null)disabled @endif" href="#itemDeleteModal" data-id="{{$items->id}}"><i class="material-icons">delete</i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col s12">
                        <h1 class="grey-text text-lighten-4 center">No Items Available</h1>
                    </div>
                </div>
            @endif
        </div>
        <!-- end of row -->
    </section>
    <!-- action btn -->
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red modal-trigger addItemBtn" href="#itemAddModal">
            <i class="large material-icons">add</i>
        </a>
        <ul>
            <li><a class="btn-floating orange item-refresh @if($item == null)disabled @endif"><i class="material-icons">close</i></a></li>
            <li><a class="btn-floating blue item-edit @if($item == null)disabled @endif"><i class="material-icons">edit</i></a></li>
            <li><a class="btn-floating red item-delete @if($item == null)disabled @endif"><i class="material-icons">delete</i></a></li>
        </ul>
    </div>
    <!-- end of action btn -->
</main>
<!-- end of main container -->

<!-- add item modal -->
<!-- Modal Structure -->
<form action="" method="post" id="addItemForm">
    <div id="itemAddModal" class="modal modal-fixed-footer grey-text text-darken-3">
        <div class="modal-content">
            <h4>Add Item</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input id="itemName" name="itemName" type="text" class="validate">
                    <label class="active" for="itemName">Item</label>
                    <span id="itemNameError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input id="itemPrice" name="itemPrice" type="text" class="validate">
                    <label class="active" for="itemPrice">Price</label>
                    <span id="itemPriceError" class="red-text"></span>
                </div>
            </div>
            <input value="@if($shop != null){{$shop->id}}@endif" id="shopId" name="shopId" type="hidden" class="validate">
            <div class="row">
                <div class="input-field col m12 s12">
                    <textarea id="itemInfo" name="itemInfo" class="materialize-textarea"></textarea>
                    <label for="itemInfo">Description</label>
                    <span id="itemInfoError" class="red-text"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" value="Save" class="submit waves-effect waves-light blue darken-2 btn"/>
            <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
        </div>
    </div>
</form>
<!-- end of add item modal -->


<form action="" method="post" enctype="multipart/form-data" id="addItemImageForm">
    <div id="addItemImage" class="modal grey-text text-darken-3 modal-medium">
        <div class="modal-content">
            <h4>Add photo</h4>
            <div class="row">
                <label for="addItemImage">file</label><br/>
                <input type="file" name="picture" id="addItemImage" accept="image/jpg"/><br/>
                <span id="addItemImageError" class="red-text"></span>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" value="Save" class="addItemImage waves-effect waves-light blue darken-2 btn"/>
            <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
        </div>
    </div>
</form>




<div id="deleteItemImage" class="modal grey-text text-darken-3 modal-small">
    <div class="modal-content">
        <h4>Add you sure you want to delete this item's image!?</h4>
    </div>
    <div class="modal-footer">
        <input type="button" value="Delete" class="deleteImageSubmit waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>



{{--delete item modal--}}
<div id="itemDeleteModal" class="modal grey-text text-darken-3 modal-small">
    <div class="modal-content">
        <h4>Are you sure you want to delete this item!?</h4>
    </div>
    <div class="modal-footer">
        <input type="button" value="Delete" class="deleteItem waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
{{--end delete item modal--}}

<!-- edit item modal -->
<!-- Modal Structure -->
<form action="" method="post" id="editItemForm">
    <div id="itemEditModal" class="modal modal-fixed-footer grey-text text-darken-3">
        <div class="modal-content">
            <h4>Edit @if($item != null){{$items->name}}@endif</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input id="editItemName" name="editItemName" type="text" class="validate">
                    <label class="active" for="itemName">Item name</label>
                    <span id="editItemNameError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input id="editItemPrice" value="" name="editItemPrice" type="text" class="validate">
                    <label class="active" for="itemPrice">Price</label>
                    <span id="editItemPriceError" class="red-text"></span>
                </div>
            </div>
            <input value="@if($item != null){{$items->shopId}}@endif" id="shopId" name="shopId" type="hidden" class="validate">
            <div class="row">
                <div class="input-field col m6 s12">
                    <textarea id="editItemInfo"  name="editItemInfo" class="materialize-textarea" value=""></textarea>
                    <label for="itemInfo">Description</label>
                    <span id="editItemInfoError" class="red-text"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" value="Save" class="editItemSub waves-effect waves-light blue darken-2 btn"/>
            <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
        </div>
    </div>
</form>
<!-- end of edit item modal -->


<script>
    $(document).ready(function(){
        $('.action-delete').hide();
        $('.action-edit').hide();
        $('.item-delete').click(function(){
            $('.action-delete').show();
        });
        $('.item-edit').click(function(){
            $('.action-edit').show();
        });
        $('.item-refresh').click(function(){
            $('.action-edit').hide();
            $('.action-delete').hide();
        })

        $('.modal-trigger').leanModal();
    })
</script>

<script>
    $(document).ready(function(){
        //add item
        $('.submit').click( function(event){
            event.preventDefault();
            var formData = {
                name: $('input[name=itemName]').val(),
                price: $('input[name=itemPrice]').val(),
                info: $('textarea[name=itemInfo]').val(),
                shopId: $('input[name=shopId]').val()
            }
            $.ajax({
                type: 'POST',
                url: 'shopOwner/createItem',
                data: formData,
                cache    : false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function () {
                            $('#itemNameError').html(errors['name'])
                            $('#itemInfoError').html(errors['info'])
                            $('#itemPriceError').html(errors['price'])
                        });
                    }
                    return false;
                },
                success: function ()
                {
                    Materialize.toast('Item added!', 4000);
                    var href = $('#itemsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            });
            $('#itemNameError').html('')
            $('#itemInfoError').html('')
            $('#itemPriceError').html('')
        });
//end add item


        //edit Item
        $('.editItem').click(function () {
        id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: 'shopOwner/getItem/' + id,
            success: function (res) {
                console.log(res['price'])
                $('#editItemName').val(res['name']);
                $('#editItemPrice').val(res['price']);
                $('#editItemInfo').val(res['info']);
            }
        })
    })

    $('.editItemSub').click( function(event){
        event.preventDefault();
        var formData = {
            name: $('input[name=editItemName]').val(),
            price: $('input[name=editItemPrice]').val(),
            info: $('textarea[name=editItemInfo]').val(),
            shopId: $('input[name=shopId]').val()
        }
        $.ajax({
            type: 'POST',
            url: 'shopOwner/editItem/'+ id ,
            data: formData,
            cache    : false,
            "_token": "{{ csrf_token() }}",
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                    var errors = JSON.parse(jqXHR.responseText);
                    $.each(errors, function () {
                        $('#editItemNameError').html(errors['name'])
                        $('#editItemInfoError').html(errors['info'])
                        $('#editItemPriceError').html(errors['price'])
                    });
                }
                return false;
            },
            success: function ()
            {
                Materialize.toast('Item has been edited!', 4000);
                var href = $('#itemsHref').attr('href');
                $('.wrap').load(href);
                return false;
            }
        });
        $('#editItemNameError').html('')
        $('#editItemInfoError').html('')
        $('#editItemPriceError').html('')
    });
//end edit item

    //del item
    $('.deleteBtn').click(function(){
        id = $(this).attr('data-id');
    });
    $('.deleteItem').click( function(event){
        event.preventDefault();
        $.ajax({
            type: 'get',
            url: 'shopOwner/deleteItem/'+ id ,
            cache    : false,
            "_token": "{{ csrf_token() }}",
            error: function (jqXHR, textStatus, errorThrown)
            {
                return false;
            },
            success: function ()
            {
                Materialize.toast('Item has been deleted!', 4000);
                var href = $('#itemsHref').attr('href');
                $('.wrap').load(href);
            }
        })
        return false;
    });
    //end del sale




        //add item image
        $('.addImage').click(function () {
            id = $(this).attr('data-id');
        });
        $('.addItemImage').click(function (e) {
            e.preventDefault();
            var formData = new FormData($('#addItemImageForm')[0]);
            $.ajax({
                type: 'POST',
                data: formData,
                cache: false,
                "_token": "{{ csrf_token() }}",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                url: 'shopOwner/addItemImage/' + id,
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function (index, value) {
                            $('#addItemImageError').html(errors['picture']);
                        });
                    }
                    return false;
                },
                success: function () {
                    Materialize.toast('Item Image added!', 4000);
                    var href = $('#itemsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            });
            $('#addItemImageError').html('');
        });
        //end add item image



        //del image item
        $('.deleteImage').click(function () {
            id = $(this).attr('data-id');
        });
        $('.deleteImageSubmit').click(function (event) {
            event.preventDefault();
            $(this).attr('disabled', 'disabled');
            $.ajax({
                type: 'GET',
                url: 'shopOwner/deleteItemImage/' + id,
                cache: false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    return false;
                },
                success: function () {
                    Materialize.toast('Image has been deleted', 4000);
                    var href = $('#itemsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            })
            //end del image shop

        });
    })
</script>


