<!-- main container -->
<main>
    <!-- side bar -->
    @if($shop != null)
    <section class="shop-items">
        <!-- row begin -->
        <div class="row">
            <div class="col s12">
                <h2 class="grey-text text-lighten-4">Shops</h2>
            </div>
        </div>
        <div class="row">
            @foreach($shop as $shops)
            <div class="col m3 s6">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <a href="#addShopImage" class="modal-trigger addImage" data-id="{{$shops->id}}"><i class="material-icons blue-text">add</i></a>
                        <a href="#deleteShopImage" class="modal-trigger deleteImage" @if($shops->picture == null)style="display: none"@endif  data-id="{{$shops->id}}"><i class="material-icons red-text">delete</i></a>
                        @if($shops->picture == null)
                            <img class="activator" src="images/items/4.gif">
                        @else
                            <img class="activator" src="{{ asset('/img/shop/' . $shops->picture) }}"/>
                        @endif
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">{{$shops->name}}</span><br/>
                        <span class="card-title activator grey-text text-darken-4">{{$shops->shopOwner}}</span><br/>
                        <span class="card-title activator grey-text text-darken-4">{{$shops->phone1}}</span>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Description <i class="mdi-navigation-close right"></i></span>
                        <p>{{$shops->info}}</p>
                    </div>
                    <div class="card-delete">
                        <a class="btn-floating red action-edit blue modal-trigger editShop" href="#itemEditModal" data-id="{{$shops->id}}"><i class="material-icons">mode_edit</i></a>
                        <a class="btn-floating red action-delete modal-trigger deleteBtn @if($shops == null)disabled @endif" href="#shopDeleteModal" data-id="{{$shops->id}}"><i class="material-icons">delete</i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- end of row -->
    </section>

    @else
        <div class="row">
            <div class="col s12">
                <h1 class="grey-text text-lighten-4 center">No Shop Available</h1>
            </div>
        </div>
    @endif
    <!-- action btn -->
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red modal-trigger" href="#itemAddModal">
            <i class="large material-icons">add</i>
        </a>
        <ul>
            <li><a class="btn-floating orange item-refresh"><i class="material-icons">close</i></a></li>
            <li><a class="btn-floating blue item-edit"><i class="material-icons">edit</i></a></li>
            <li><a class="btn-floating red item-delete"><i class="material-icons">delete</i></a></li>
        </ul>
    </div>
    <!-- end of action btn -->
</main>
<!-- end of main container -->
<form action="" method="post" enctype="multipart/form-data" id="addShopImageForm">
    <div id="addShopImage" class="modal grey-text text-darken-3 modal-medium">
        <div class="modal-content">
            <h4>Add photo</h4>
            <div class="row">
                <label for="addShopImage">file</label><br/>
                <input type="file" name="picture" id="addShopImage" accept="image/jpg"/><br/>
                <span id="addShopImageError" class="red-text"></span>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" value="Save" class="addShopImage waves-effect waves-light blue darken-2 btn"/>
            <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
        </div>
    </div>
</form>


<!-- add item modal -->
<!-- Modal Structure -->

<form action="" method="post" enctype="multipart/form-data">
    <div id="itemAddModal" class="modal modal-fixed-footer grey-text text-darken-3">
        <div class="modal-content">
            <h4>Add Shop</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input id="addShopName" name="addShopName" type="text" class="validate">
                    <label class="active" for="addShopName">Shop Name</label><br/>
                    <span id="addShopNameError" class="red-text"></span>
                </div>
            </div>
            @if($user)
                <div class="row">
                    <div class="input-field col m12 s12">
                        <p>Shop Owner: </p>
                        <select class="js-example-tags" name="userId" id="userId">
                            @foreach($user as $users)
                                <option value="{{$users->id}}">{{$users->name}}</option>
                            @endforeach
                        </select>
                        <span id="addShopUserIdError" class="red-text"></span>
                    </div>
                </div>
            @endif
            @if($cat != null)
                <div class="row">
                    <div class="input-field col m12 s12">
                        <p>Category: </p>
                        <select class="js-example-tags item-tag catId" multiple="multiple" name="catId" id="catId">
                            @foreach($cat as $cats)
                                <option value="{{$cats->id}}">{{$cats->name}}</option>
                            @endforeach
                        </select>
                        <span id="addShopCatIdError" class="red-text"></span>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="input-field col m6 s12">
                    <input  id="addShopWebsite" name="addShopWebsite" type="text" class="validate">
                    <label class="active" for="addShopWebsite">Website</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input  id="addShopEmail" name="addShopEmail" type="text" class="validate">
                    <label class="active" for="addShopEmail">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input  id="addShopFacebook" name="addShopFacebook" type="text" class="validate">
                    <label class="active" for="addShopFacebook">Facebook</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input  id="addShopPhone1" name="addShopPhone1" type="text" class="validate">
                    <label class="active" for="addShopPhone1">Phone1</label>
                    <br/><span id="addShopPhone1Error" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input  id="addShopPhone2" name="addShopPhone2" type="text" class="validate">
                    <label class="active" for="addShopPhone2">Phone2</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input  id="addShopBestParking" name="addShopBestParking" type="text" class="validate">
                    <label class="active" for="addShopBestParking">bestParking</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <p>Trading Hours: </p>
                    Monday:
                    <input type="text" name="monday" id="monday"/><br/>
                    Tuesday:
                    <input type="text" name="tuesday" id="tuesday"/><br/>
                    Wednesday:
                    <input type="text" name="wednesday" id="wednesday"/><br/>
                    Thursday:
                    <input type="text" name="thursday" id="thursday"/><br/>
                    Friday:
                    <input type="text" name="friday" id="friday"/><br/>
                    Saturday:
                    <input type="text" name="saturday" id="saturday"/><br/>
                    Sunday:
                    <input type="text" name="sunday" id="sunday"/><br/>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m12 s12">
                    <p>giftCard: </p>
                    <select class="js-example-tags item-tag" name="addShopGiftCard" id="addShopGiftCard">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input  id="addShopPlace" name="addShopPlace" type="text" class="validate">
                    <label class="active" for="addShopPlace">Place</label>
                    <span id="addShopPlaceError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m12 s12">
                    <textarea id="addShopInfo" name="addShopInfo" class="materialize-textarea"></textarea>
                    <label for="addShopInfo">Description</label>
                    <br/><span id="addShopInfoError" class="red-text"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" value="Save" class="addShopBtn waves-effect waves-light blue darken-2 btn"/>
            <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
        </div>
    </div>
</form>
<!-- end of add item modal -->
<!-- edit item modal -->



<!-- Modal Structure -->
<div id="itemEditModal" class="modal modal-fixed-footer grey-text text-darken-3">
    <div class="modal-content">
        <h4>Edit Shop</h4>
        <div class="row">
            <div class="input-field col m6 s12">
                <input id="editShopName" name="editShopName" type="text" class="validate">
                <label class="active" for="editShopName">Shop Name</label>
                <span id="editShopNameError" class="red-text"></span>
            </div>
        </div>
        @if($user)
            <div class="row">
                <div class="input-field col m12 s12">
                    <p>Shop Owner: </p>
                    <select name="editShopUserId" id="editShopUserId" class="js-example-tags item-tag">
                        @foreach($user as $users)
                            <option value="{{$users->id}}">{{$users->name}}</option>
                        @endforeach
                    </select>
                    <span id="editShopUserIdError" class="red-text"></span>
                </div>
            </div>
        @endif
        @if($cat != null)
            <div class="row">
                <div class="input-field col m12 s12">
                    <p>Category: </p>
                    <select class="js-example-tags item-tag" multiple="multiple" name="editShopCatId" id="editShopCatId">
                        @foreach($cat as $cats)
                            <option value="{{$cats->id}}">{{$cats->name}}</option>
                        @endforeach
                    </select>
                    <br/><span id="editShopCatIdError" class="red-text"></span>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="input-field col m6 s12">
                <input  id="editShopWebsite" name="editShopWebsite" type="text" class="validate">
                <label class="active" for="editShopWebsite">Website</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input  id="editShopEmail" name="editShopEmail" type="text" class="validate">
                <label class="active" for="editShopEmail">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input  id="editShopFacebook" name="editShopFacebook" type="text" class="validate">
                <label class="active" for="editShopFacebook">Facebook</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input  id="editShopPhone1" name="editShopPhone1" type="text" class="validate">
                <label class="active" for="editShopPhone1">Phone1</label>
                <br/><span id="editShopPhone1Error" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input  id="editShopPhone2" name="editShopPhone2" type="text" class="validate">
                <label class="active" for="editShopPhone2">Phone2</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input  id="editShopBestParking" name="editShopBestParking" type="text" class="validate">
                <label class="active" for="editShopBestParking">bestParking</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <p>Trading Hours: </p>
                Monday:
                <input type="text" name="editMonday" id="editMonday"/><br/>
                Tuesday:
                <input type="text" name="editTuesday" id="editTuesday"/><br/>
                Wednesday:
                <input type="text" name="editWednesday" id="editWednesday"/><br/>
                Thursday:
                <input type="text" name="editThursday" id="editThursday"/><br/>
                Friday:
                <input type="text" name="editFriday" id="editFriday"/><br/>
                Saturday:
                <input type="text" name="editSaturday" id="editSaturday"/><br/>
                Sunday:
                <input type="text" name="editSunday" id="editSunday"/><br/>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m12 s12">
                <p>giftCard: </p>
                <select class="js-example-tags item-tag" name="editShopGiftCard" id="editShopGiftCard">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input  id="editShopPlace" name="editShopPlace" type="text" class="validate">
                <label class="active" for="editShopPlace">Place</label>
                <span id="editShopPlaceError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m12 s12">
                <textarea id="editShopInfo" name="editShopInfo" class="materialize-textarea"></textarea>
                <label for="editShopInfo">Description</label>
                <span id="editShopInfoError" class="red-text"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="Save" class="editShopSub waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
<!-- end of edit item modal -->


<!-- Modal Structure -->
<div id="deleteShopImage" class="modal grey-text text-darken-3 modal-small">
    <div class="modal-content">
        <h4>Add you sure you want to delete this image!?</h4>
    </div>
    <div class="modal-footer">
        <input type="button" value="Delete" class="deleteImageSubmit waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
<!-- end of shop image delete modal -->


{{--delete shop modal--}}
<div id="shopDeleteModal" class="modal grey-text text-darken-3 modal-small">
    <div class="modal-content">
        <h4>Are you sure you want to delete this shop!?</h4>
    </div>
    <div class="modal-footer">
        <input type="button" value="Delete" class="deleteShop waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
{{--end delete shop modal--}}

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

<script type="text/javascript">
    $(document).ready(function() {
        //add shop
        $('.addShopBtn').click(function (event) {
            event.preventDefault();
            var formData = {
                name: $('input[name=addShopName]').val(),
                userId: $('select[name=userId]').val(),
                info: $('textarea[name=addShopInfo]').val(),
                picture: $('input[name=picture]').val(),
                catId: $('select[name=catId]').val(),
                saturday : $('input[name=saturday]').val(),
                sunday : $('input[name=sunday]').val(),
                monday : $('input[name=monday]').val(),
                tuesday : $('input[name=tuesday]').val(),
                wednesday : $('input[name=wednesday]').val(),
                thursday : $('input[name=thursday]').val(),
                friday : $('input[name=friday]').val(),
                webSite: $('input[name=addShopWebSite]').val(),
                email: $('input[name=addShopEmail]').val(),
                instagram: $('input[name=addShopInstagram]').val(),
                facebook: $('input[name=addShopFacebook]').val(),
                phone1: $('input[name=addShopPhone1]').val(),
                phone2: $('input[name=addShopPhone2]').val(),
                bestParking: $('input[name=addShopBestParking]').val(),
                giftCard: $('select[name=addShopGiftCard]').val(),
                place: $('input[name=addShopPlace]').val(),
                giftCard: $('select[name=addShopGiftCard]').val()
            }
            $.ajax({
                type: 'POST',
                url: 'admin/createShop',
                data: formData,
                cache: false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $('#addShopNameError').html(errors['name']);
                        $('#addUserIdError').html(errors['userId']);
                        $('#addShopCatIdError').html(errors['catId']);
                        $('#addShopPhone1Error').html(errors['phone1']);
                        $('#addShopPlaceError').html(errors['place']);
                        $('#addShopUserIdError').html(errors['userId']);
                    }
                },
                success: function () {
                    Materialize.toast('Shop added!', 4000);
                    var href = $('#shopsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            }).done(function(){
                $('.addShopBtn').attr("disabled", "disabled");
            })
            .fail(function() {
                $('.addShopBtn').removeAttr("disabled");
            });
            $('#addShopNameError').html('');
            $('#addUserIdError').html('');
            $('#addShopCatIdError').html('');
            $('#addShopPhone1Error').html('');
            $('#addShopPlaceError').html('');
            $('#addShopUserIdError').html('');
        });
        //end add shop


        //add shop image
        $('.addImage').click(function () {
            id = $(this).attr('data-id');
        });
        $('.addShopImage').click(function (e) {
            e.preventDefault();
            var formData = new FormData($('#addShopImageForm')[0]);
            $.ajax({
                type: 'POST',
                data: formData,
                cache: false,
                "_token": "{{ csrf_token() }}",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                url: 'admin/addShopImage/' + id,
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function (index, value) {
                            $('#addShopImageError').html(errors['picture']);
                        });
                    }
                    return false;
                },
                success: function () {
                    Materialize.toast('Shop Image added!', 4000);
                    var href = $('#shopsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            }).done(function(){
                $('.addShopImage').attr("disabled", "disabled");
            })
            .fail(function() {
                $('.addShopImage').removeAttr("disabled");
            });
        });
        //end add shop image


        //del image shop
        $('.deleteImage').click(function () {
            id = $(this).attr('data-id');
        });
        $('.deleteImageSubmit').click(function (event) {
            event.preventDefault();
            $.ajax({
                type: 'GET',
                url: 'admin/deleteShopImage/' + id,
                cache: false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    return false;
                },
                success: function () {
                    Materialize.toast('Image has been deleted', 4000);
                    var href = $('#shopsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            }).done(function(){
                $('.deleteImageSubmit').attr("disabled", "disabled");
            })
            .fail(function() {
                $('.deleteImageSubmit').removeAttr("disabled");
            });
            //end del image shop

        });


        //del shop
        $('.deleteBtn').click(function () {
            id = $(this).attr('data-id');
        });
        $('.deleteShop').click(function (event) {
            event.preventDefault();
            $(this).attr('disabled', 'disabled');
            $.ajax({
                type: 'get',
                url: 'admin/deleteShop/' + id,
                cache: false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown) {

                },
                success: function () {
                    Materialize.toast('Shop has been deleted!', 4000);
                    var href = $('#shopsHref').attr('href');
                    $('.wrap').load(href);
                }
            }).done(function(){
                $('.deleteShop').attr("disabled", "disabled");
            })
            .fail(function() {
                $('.deleteShop').removeAttr("disabled");
            });
            return false;
        });
//        end del shop


        //edit shop
        $('.editShop').click(function () {
            id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: 'admin/getShop/' + id,
                success: function (res) {
                    $('#editShopName').val(res['name']);
                    $('#editShopPlace').val(res['place']);
                    $('#editShopInfo').val(res['info']);
                    $('#editShopWebsite').val(res['webSite']);
                    $('#editShopBestParking').val(res['bestParking']);
                    $('#editShopEmail').val(res['email']);
                    $('#editShopFacebook').val(res['facebook']);
                    $('#editShopPhone1').val(res['phone1']);
                    $('#editShopPhone2').val(res['phone2']);
                    $('#editMonday').val(res['tradingHours'][0]['monday']);
                    $('#editTuesday').val(res['tradingHours'][0]['tuesday']);
                    $('#editWednesday').val(res['tradingHours'][0]['monday']);
                    $('#editThursday').val(res['tradingHours'][0]['wednesday']);
                    $('#editFriday').val(res['tradingHours'][0]['friday']);
                    $('#editSaturday').val(res['tradingHours'][0]['saturday']);
                    $('#editSunday').val(res['tradingHours'][0]['sunday']);
                    $('#editShopUserId').val(res['userId']).change();
                    $('#editShopGiftCard').val(res['giftCard']).change();
                    var i = 0;
                    var temp = [];
                    $.each(res['category'] , function(){
                        temp[i] = res['category'][i]['id'];
                        i++;
                    });
                    $('#editShopCatId').select2('val' , temp);
                }
            });
        })
        $('.editShopSub').click(function (event) {
            event.preventDefault();
            var formData = {
                name: $('input[name=editShopName]').val(),
                webSite: $('input[name=editShopWebsite]').val(),
                email: $('input[name=editShopEmail]').val(),
                facebook: $('input[name=editShopFacebook]').val(),
                phone1: $('input[name=editShopPhone1]').val(),
                phone2: $('input[name=editShopPhone2]').val(),
                place: $('input[name=editShopPlace]').val(),
                bestParking: $('input[name=editShopBestParking]').val(),
                info: $('textarea[name=editShopInfo]').val(),
                userId: $('select[name=editShopUserId]').val(),
                catId: $('select[name=editShopCatId]').val(),
                monday: $('input[name=editMonday]').val(),
                tuesday: $('input[name=editTuesday]').val(),
                wednesday: $('input[name=editWednesday]').val(),
                thursday: $('input[name=editThursday]').val(),
                friday: $('input[name=editFirday]').val(),
                saturday: $('input[name=editSaturday]').val(),
                sunday: $('input[name=editSunday]').val(),
                giftCard : $('select[name=editShopGiftCard]').val()
            }
            $.ajax({
                type: 'POST',
                url: 'admin/editShop/' + id,
                data: formData,
                cache: false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $('#editShopNameError').html(errors['name']);
                        $('#editShopUserIdError').html(errors['userId']);
                        $('#editShopCatIdError').html(errors['catId']);
                        $('#editShopPhone1Error').html(errors['phone1']);
                        $('#editShopPlaceError').html(errors['place']);
                    }
                    return false;
                },
                success: function () {
                    Materialize.toast('The shop has been edited', 4000);
                    var href = $('#shopsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            }).done(function(){
                $('.editShopSub').attr("disabled", "disabled");
            })
            .fail(function() {
                $('.editShopSub').removeAttr("disabled");
            });
            $('#editShopNameError').html('');
            $('#editShopUserIdError').html('');
            $('#editShopCatIdError').html('');
            $('#editShopPhone1Error').html('');
            $('#editShopPlaceError').html('');
        });
        //end edit shop

        $(".js-example-tags").select2({
            tags: true,
            tokenSeparators: [',' , ' '],
            placeholder : 'choose category'
        });

    });
</script>






