<!-- main container -->
<main>
    <!-- side bar -->
        <section>
            <div class="row">
                <div class="col s12">
                    <h2 class="grey-text text-lighten-4">Sale</h2>
                </div>
            </div>
            @if($sale != null)
            <div class="row">
                <div class="col s12">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="mdi-action-assignment circle red"></i>
                            <span class="title">{{$sale->name}}</span>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-action-description circle red"></i>
                            <span class="title">Description</span>
                            <p>{{$sale->info}}</p>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-action-event circle red"></i>
                            <span class="title">{{$sale->startDate}}</span>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-action-event circle red"></i>
                            <span class="title">{{$sale->endDate}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    @else
        <div class="row">
            <div class="col s12">
                <h1 class="grey-text text-lighten-4 center">No Sale Available</h1>
            </div>
        </div>
    @endif
</main>
<!-- end of main container -->
<!-- sale add modal -->
<!-- Modal Structure -->
<form action="" method="post" id="addSaleForm">
    <div id="saleAddModal" class="modal modal-fixed-footer grey-text text-darken-3">
        <div class="modal-content">
            <h4>Add Sale</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input id="saleName" name="saleName" type="text" class="validate">
                    <label class="active" for="saleName">Name</label>
                    <span id="saleNameError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input id="salePlace" name="salePlace" type="text" class="validate">
                    <label class="active" for="salePlace">Place</label>
                    <span id="salePlaceError" class="red-text"></span>
                </div>
            </div>
            <input value="{{$shop->id}}" id="shopId" name="shopId" type="hidden" class="validate">
            <input value="sale" id="saleCategory" name="saleCategory" type="hidden" class="validate">
            <div class="row">
                <div class="input-field col m12 s12">
                    <textarea id="saleInfo" name="saleInfo" class="materialize-textarea"></textarea>
                    <label for="saleInfo">Description</label>
                    <span id="saleInfoError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input type="date" id="saleStartDate" name="saleStartDate" class="datepicker">
                    <label class="active" for="saleStartDate">Start Date</label>
                    <span id="saleStartDateError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input type="date" id="saleEndDate" name="saleEndDate" class="datepicker">
                    <label class="active" for="saleEndDate">End Date</label>
                    <span id="saleEndDateError" class="red-text"></span>
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
<!-- end of main container -->
<!-- sale add modal -->
<!-- Modal Structure -->
<div id="saleDeleteModal" class="modal grey-text text-darken-3 modal-small">
    <div class="modal-content">
        <h4>Are you sure you want to delete this sale!?</h4>
    </div>
    <div class="modal-footer">
        <input type="button" value="Delete" class="deleteSale waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
<!-- end of add item modal -->
<!-- sale edit modal -->
<!-- Modal Structure -->
<form action="" method="post" id="editSaleForm">
    <div id="saleEditModal" class="modal modal-fixed-footer grey-text text-darken-3">
        <div class="modal-content">
            <h4>Edit Sale</h4>
            <input value="{{$shop->id}}" id="editShopId" name="editShopId" type="hidden" class="validate">
            <input value="sale" id="editSaleCategory" name="editSaleCategory" type="hidden" class="validate">
            <div class="row">
                <div class="input-field col m6 s12">
                    <input id="editSaleName" name="editSaleName" type="text" class="validate">
                    <label class="active" for="editSaleName">Name</label>
                    <span id="editSaleNameError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input id="editSalePlace" name="editSalePlace" type="text" class="validate">
                    <label class="active" for="editSalePlace">Place</label>
                    <span id="editSalePlaceError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <textarea id="editSaleInfo" name="editSaleInfo" class="materialize-textarea"></textarea>
                    <label for="editSaleInfo">Description</label>
                    <span id="editSaleInfoError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input type="date" id="editSaleStartDate" name="editSaleStartDate" class="datepicker">
                    <label class="active" for="editSaleStartDate">Start Date</label>
                    <span id="editSaleStartDateError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input type="date" id="editSaleEndDate" name="editSaleEndDate" class="datepicker">
                    <label class="active" for="editSaleEndDate">End Date</label>
                    <span id="editSaleEndDateError" class="red-text"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" value="Save" class="editSaleSub waves-effect waves-light blue darken-2 btn"/>
            <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
        </div>
    </div>
</form>
<!-- end of sale edit modal -->


<!-- action btn -->
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red modal-trigger" href="#saleAddModal">
        <i class="large material-icons">add</i>
    </a>
    <ul>
        <li><a class="btn-floating blue item-edit modal-trigger @if($sale == null)disabled @endif" href="#saleEditModal"><i class="material-icons editSale" data-id="@if($sale != null){{$sale->id}}@endif">edit</i></a></li>
        <li><a class="btn-floating red item-delete modal-trigger @if($sale == null)disabled @endif" href="#saleDeleteModal"><i class="material-icons">delete</i></a></li>
    </ul>
</div>
<!-- end of action btn -->

<script>
    $('.modal-trigger').leanModal();
</script>

<script>
    $(document).ready(function(){
       //add sale
        $('.submit').click( function(event){
            event.preventDefault();
                var formData = {
                    name: $('input[name=saleName]').val(),
                    info: $('textarea[name=saleInfo]').val(),
                    startDate: $('input[name=saleStartDate]').val(),
                    endDate: $('input[name=saleEndDate]').val(),
                    shopId: $('input[name=shopId]').val(),
                    category: $('input[name=saleCategory]').val(),
                    place: $('input[name=salePlace]').val()
                }
            $.ajax({
                type: 'POST',
                url: 'shopOwner/addSale',
                data: formData,
                cache    : false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function (index , value) {
                            $('#saleNameError').html(errors['name']);
                            $('#salePlaceError').html(errors['place']);
                            $('#saleInfoError').html(errors['info']);
                            $('#saleStartDateError').html(errors['startDate']);
                            $('#saleEndDateError').html(errors['endDate']);
                        });
                    }
                    return false;
                },
                success: function ()
                {
                    Materialize.toast('New sale has been added!', 4000);
                    var href = $('#saleHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            }).done(function(){
                $('.submit').attr("disabled", "disabled");
            })
            .fail(function() {
                $('.submit').removeAttr("disabled");
            });
            $('#saleNameError').html('');
            $('#salePlaceError').html('');
            $('#saleInfoError').html('');
            $('#saleStartDateError').html('');
            $('#saleEndDateError').html('');
        });
      //end add sale

     //edit sale
        $('.editSale').click(function () {
            id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: 'shopOwner/getSale/' + id,
                success: function (res) {
                    $('#editSaleName').val(res['name']);
                    $('#editSaleInfo').val(res['info']);

                    var d = new Date(res['startDate']),
                            month = '' + (d.getMonth() + 1),
                            day = '' + d.getDate(),
                            year = d.getFullYear();
                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;
                    startDate = [year, month, day].join('-');

                    var d = new Date(res['endDate']),
                            month = '' + (d.getMonth() + 1),
                            day = '' + d.getDate(),
                            year = d.getFullYear();
                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;
                    endDate = [year, month, day].join('-');

                    $('#editSaleStartDate').val(startDate);
                    $('#editSaleEndDate').val(endDate);
                    $('#editSalePlace').val(res['place']);
                    $('#editSaleCategory').val(res['category']);
                    $('#editShopId').val(res['shopId']);
                }
            })
        })

        $('.editSaleSub').click( function(event){
            event.preventDefault();
            var formData = {
                name: $('input[name=editSaleName]').val(),
                startDate: $('input[name=editSaleStartDate]').val(),
                endDate: $('input[name=editSaleEndDate]').val(),
                info: $('textarea[name=editSaleInfo]').val(),
                shopId: $('input[name=shopId]').val(),
                category: $('input[name=editSaleCategory]').val(),
                place: $('input[name=editSalePlace]').val()
            }
            $.ajax({
                type: 'POST',
                url: 'shopOwner/editSale/'+ id ,
                data: formData,
                cache    : false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function () {
                            $('#editSaleNameError').html(errors['name']);
                            $('#editSalePlaceError').html(errors['place']);
                            $('#editSaleInfoError').html(errors['info']);
                            $('#editSaleStartDateError').html(errors['startDate']);
                            $('#editSaleEndDateError').html(errors['endDate']);
                        });
                    }
                    return false;
                },
                success: function ()
                {
                    Materialize.toast('The sale has been edited', 4000);
                    var href = $('#saleHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            }).done(function(){
                $('.editSaleSub').attr("disabled", "disabled");
            })
            .fail(function() {
                $('.editSaleSub').removeAttr("disabled");
            });
            $('#editSaleNameError').html('');
            $('#editSalePlaceError').html('');
            $('#editSaleInfoError').html('');
            $('#editSaleStartDateError').html('');
            $('#editSaleEndDateError').html('');
        });
//     end edit sale


    //del sale
        $('.deleteSale').click( function(event){
            event.preventDefault();
            $(this).attr('disabled', 'disabled');
            id = $('.editSale').attr('data-id');
            $.ajax({
                type: 'get',
                url: 'shopOwner/deleteSale/'+ id ,
                cache    : false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown)
                {
                    return false;
                },
                success: function ()
                {
                    Materialize.toast('Sale has been deleted', 4000);
                    var href = $('#saleHref').attr('href');
                    $('.wrap').load(href);
                }
            }).done(function(){
                $('.deleteSale').attr("disabled", "disabled");
            })
            .fail(function() {
                $('.deleteSale').removeAttr("disabled");
            });
            return false;
        });
    //end del sale
    });
</script>