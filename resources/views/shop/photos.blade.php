<!-- main container -->
<main>
    <!-- side bar -->
    <section>
        <div class="row">
            <div class="col s12">
                <h2 class="grey-text text-lighten-4">Shop Photo</h2>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                @if($shop->picture != null)
                    <img class="activator" src="{{ asset('/img/shop/' . $shop->picture) }}" width="600" height="500"/>
                @else
                    <img class="materialboxed" width="650" src="images/items/4.gif">
                @endif
            </div>
        </div>
    </section>
</main>
<!-- end of main container -->
<!-- Photos add modal -->
<!-- Modal Structure -->
<form action="" method="post" enctype="multipart/form-data" id="addShopImageForm">
    <div id="addImageModal" class="modal grey-text text-darken-3 modal-medium">
        <div class="modal-content">
            <h4>Add photo</h4>
            <div class="row">
                <label for="addShopImage">file</label><br/>
                <input type="file" name="picture" id="addShopImage" accept="image/jpg"/><br/>
                <span id="addShopImageError" class="red-text"></span>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action waves-effect waves-light blue darken-2 btn addShopImage">Save</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-light red darken-2 btn m-cancel-btn">Cancel</a>
        </div>
    </div>
</form>
<!-- end of add item modal -->
<!-- end of main container -->
<!-- sale add modal -->
<!-- Modal Structure -->
<div id="deleteImageModal" class="modal grey-text text-darken-3 modal-small">
    <div class="modal-content">
        <h4>Add you sure you want to delete this photo!?</h4>
    </div>
    <div class="modal-footer">
        <input type="button" value="Delete" class="deleteImageSubmit waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
<!-- end of add item modal -->

<!-- action btn -->
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red modal-trigger addImage" href="#addImageModal" data-id="{{$shop->id}}">
        <i class="large material-icons">add</i>
    </a>
    <ul>
        <li>
            <a class="btn-floating red item-delete modal-trigger deleteImage" @if($shop->picture == null)style="display: none"@endif href="#deleteImageModal" data-id="{{$shop->id}}">
                <i class="material-icons">delete</i>
            </a>
        </li>
    </ul>
</div>
<!-- end of action btn -->

<script>
    $('.modal-trigger').leanModal();

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
            url: 'shopOwner/addShopImage/' + id,
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
                var href = $('#photosHref').attr('href');
                $('.wrap').load(href);
                return false;
            }
        })
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
            url: 'shopOwner/deleteShopImage/' + id,
            cache: false,
            "_token": "{{ csrf_token() }}",
            error: function (jqXHR, textStatus, errorThrown) {
                return false;
            },
            success: function () {
                Materialize.toast('Image has been deleted', 4000);
                var href = $('#photosHref').attr('href');
                $('.wrap').load(href);
                return false;
            }
        })
        //end del image shop

    });
</script>

