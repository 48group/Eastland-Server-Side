<!-- main container -->

    <main>
        @if($shop != null)
        <!-- side bar -->
        <section class="shop-details">
            <div class="row">
                <div class="col s12">
                    <h2 class="grey-text text-lighten-4">Details</h2>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="mdi-communication-location-on circle red"></i>
                            <span class="title"><p>{{$shop->name}}</p></span>
                            <p>{{$shop->place}}</p>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-av-web circle red"></i>
                            <span class="title">Social Networks</span>
                            <p>{{$shop->webSite}} <br/>
                                {{$shop->instagram}}
                                {{$shop->email}}
                            </p>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-communication-phone circle red"></i>
                            <span class="title">Phone</span>
                            <p>{{$shop->phone1}}<br>
                                {{$shop->phone2}}
                            </p>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-action-description circle red"></i>
                            <p>Best Parking <br>
                                {{$shop->bestParking}}
                            </p>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-action-description circle red"></i>
                            <p>Gift Card <br>
                                {{$shop->giftCard}}
                            </p>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-action-description circle red"></i>
                            <p>Description <br>
                                {{$shop->info}}
                            </p>
                        </li>
                        @if($trading != null)
                            <li class="collection-item avatar">
                                <i class="mdi-action-description circle red"></i>
                                <p>Trading Hours <br>
                                    @foreach($trading as $t)
                                        Monday: {{$t->monday}}<br/>
                                        Tuesday: {{$t->tuesday}}<br/>
                                        Wednesday: {{$t->wednesday}}<br/>
                                        Thursday: {{$t->thursday}}<br/>
                                        Friday: {{$t->friday}}<br/>
                                        Saturday: {{$t->saturday}}<br/>
                                        Sunday: {{$t->sunday}}<br/>
                                    @endforeach
                                </p>
                            </li>
                        @endif
                        <li class="collection-item avatar">
                            <i class="mdi-action-description circle red"></i>
                            <?php
                            $shopCat = DB::table('cat')
                                    ->join('shop_cat' , 'cat.id' , '=' , 'shop_cat.catId')
                                    ->where('shop_cat.shopId' ,  '=' , $shop->id )
                                    ->select('cat.name')->get();
                            ?>
                            @if($shopCat != null)
                                Shop Categories <br/>
                                @foreach($shopCat as $shopCats)
                                    {{$shopCats->name}}<br/>
                                @endforeach
                            @else
                                <p>No category</p>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- action btn -->
        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
            <a class="btn-floating btn-large red modal-trigger editDetailBtn" href="#editModal" data-id="{{$shop->id}}">
                <i class="large material-icons">mode_edit</i>
            </a>
        </div>
        <!-- end of action btn -->
        <!-- edit modal -->
        <!-- Modal Structure -->
        <form action="" method="post" id="editDetailForm">
            <div id="editModal" class="modal modal-fixed-footer grey-text text-darken-3">
                <div class="modal-content">
                    <h4>Edit your details</h4>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input value="" id="shopName" name="shopName" type="text" class="validate">
                            <label class="active" for="shopName" data-error="wrong" data-success="right">Shop Name</label>
                            <span id="shopNameError" class="red-text"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input value="" id="shopPlace" name="shopPlace" type="text" class="validate">
                            <label class="active" for="shopPlace">location</label>
                            <span id="shopPlaceError" class="red-text"></span>
                        </div>
                    </div>
                    @if($cat != null)
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <p>Category: </p>
                                <select class="js-example-tags item-tag" multiple="multiple" name="catId" id="catId">
                                    @foreach($cat as $cats)
                                        <option value="{{$cats->id}}">{{$cats->name}}</option>
                                    @endforeach
                                </select>
                                <span id="editShopCatIdError" class="red-text"></span>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input value="" id="shopWebsite" name="shopWebsite" type="text" class="validate">
                            <label class="active" for="shopWebsite">website</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input value="" id="shopEmail" name="shopEmail" type="text" class="validate">
                            <label class="active" for="shopEmail">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input value="" id="shopInstagram" name="shopInstagram" type="text" class="validate">
                            <label class="active" for="shopInstagram">instagram</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input value="" id="shopFacebook" name="shopFacebook" type="text" class="validate">
                            <label class="active" for="shopFacebook">facebook</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input value="" id="shopPhone1" name="shopPhone1" type="text" class="validate">
                            <label class="active" for="shopFacebook">Phone 1</label>
                            <span id="shopPhone1Error" class="red-text"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input value="" id="shopPhone2" name="shopPhone2" type="text" class="validate">
                            <label class="active" for="shopPhone2">Phone 2</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12 s12">
                            <textarea id="shopInfo" name="shopInfo" class="materialize-textarea"></textarea>
                            <label for="shopInfo">Description</label>
                            <span id="shopInfoError" class="red-text"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input  id="editShopBestParking" name="editShopBestParking" type="text" class="validate">
                            <label class="active" for="editShopBestParking">bestParking</label>
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
                </div>
                <div class="modal-footer">
                    <input type="button" value="Save" class="submit waves-effect waves-light blue darken-2 btn"/>
                    <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
                </div>

            </div>
        </form>
        @else
            <br/><br/><br/>
            <div class="row">
                <div class="col s12">
                    <h1 class="grey-text text-lighten-4 center">No Shop Defined For You</h1>
                </div>
            </div>
        @endif
        <!-- end of edit modal -->
    </main>
<!-- end of main container -->

<script>
    $('.modal-trigger').leanModal();
</script>

<script>
    $(document).ready(function() {
        $('.editDetailBtn').click(function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: 'shopOwner/getShop/' + id,
                success: function (res) {
                    console.log(res[2][0]);
                    $('#shopName').val(res[0]['name']);
                    $('#shopPlace').val(res[0]['place']);
                    $('#shopWebsite').val(res[0]['webSite']);
                    $('#shopEmail').val(res[0]['email']);
                    $('#shopInstagram').val(res[0]['instagram']);
                    $('#shopFacebook').val(res[0]['facebook']);
                    $('#shopPhone1').val(res[0]['phone1']);
                    $('#shopPhone2').val(res[0]['phone2']);
                    $('#shopInfo').val(res[0]['info']);
                    $('#editMonday').val(res[2][0]['monday']);
                    $('#editTuesday').val(res[2][0]['tuesday']);
                    $('#editWednesday').val(res[2][0]['monday']);
                    $('#editThursday').val(res[2][0]['wednesday']);
                    $('#editFriday').val(res[2][0]['friday']);
                    $('#editSaturday').val(res[2][0]['saturday']);
                    $('#editSunday').val(res[2][0]['sunday']);
                    $('#editShopBestParking').val(res[0]['bestParking']);
                    $('#editShopEmail').val(res[0]['email']);
                    $('#editShopGiftCard').val(res[0]['giftCard']).change();
                    var i = 0;
                    var temp = [];
                    $.each(res[1] , function(){
                        temp[i] = res[1][i]['id'];
                        i++;
                    });
                    $('#catId').select2('val' , temp);
                }
            })
        });

        $('.submit').click( function(event){
            event.preventDefault();
            var formData = {
                name: $('input[name=shopName]').val(),
                place: $('input[name=shopPlace]').val(),
                webSite: $('input[name=shopWebsite]').val(),
                email: $('input[name=shopEmail]').val(),
                instagram: $('input[name=shopInstagram]').val(),
                facebook: $('input[name=shopFacebook]').val(),
                phone1: $('input[name=shopPhone1]').val(),
                phone2: $('input[name=shopPhone2]').val(),
                info: $('textarea[name=shopInfo]').val(),
                catId: $('select[name=catId]').val(),
                monday: $('input[name=editMonday]').val(),
                tuesday: $('input[name=editTuesday]').val(),
                wednesday: $('input[name=editWednesday]').val(),
                thursday: $('input[name=editThursday]').val(),
                friday: $('input[name=editFirday]').val(),
                saturday: $('input[name=editSaturday]').val(),
                sunday: $('input[name=editSunday]').val(),
                bestParking: $('input[name=editShopBestParking]').val(),
                tradingHours: $('select[name=editShopTradingHours]').val(),
                giftCard : $('select[name=editShopGiftCard]').val()
            }
            var id = $('.editDetailBtn').attr('data-id');
            $.ajax({
                type: 'POST',
                url: 'shopOwner/editDetail/' + id ,
                data: formData,
                cache    : false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function () {
                            $('#shopNameError').html(errors['name'])
                            $('#shopPlaceError').html(errors['place'])
                            $('#shopPhone1Error').html(errors['phone1'])
                            $('#shopInfoError').html(errors['info'])
                            $('#editShopCatIdError').html(errors['catId'])
                        });

                    }
                    return false;
                },
                success: function ()
                {
                    Materialize.toast('Your shop detail has been updated', 4000);
                    var href = $('#detailHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            }).done(function(){
                $('.submit').attr("disabled", "disabled");
            })
            .fail(function() {
                $('.submit').removeAttr("disabled");
            });
            $('#shopNameError').html('');
            $('#shopPlaceError').html('');
            $('#shopPhone1Error').html('');
            $('#shopInfoError').html('');
            $('#editShopCatIdError').html('');
        });


        $(".js-example-tags").select2({
            placeholder: 'choose category',
            tags: true
        });


    });
</script>

