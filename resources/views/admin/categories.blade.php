<!-- main container -->
<main>
    <!-- side bar -->

    <section class="shop-items">
        <!-- row begin -->
        <div class="row">
            <div class="col s12">
                <h2 class="grey-text text-lighten-4">Categories</h2>
            </div>
        </div>
        <div class="row">
            @if($cat != null)
                <div class="col s12 m6 offset-m3 white">
                    <table class="striped">
                        <thead>
                        <tr>
                            <th data-field="name">Name</th>
                            <th data-field="edit">Edit</th>
                            <th data-field="edit">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cat as $cats)
                            <tr>
                                <td>{{$cats->name}}</td>
                                <td><a href="#categoryEditModal" class="modal-trigger editCat" data-id="{{$cats->id}}"><i class="material-icons blue-text">edit</i></a></td>
                                <td><a href="#categoryDeleteModal" class="modal-trigger deleteCat" data-id="{{$cats->id}}"><i class="material-icons red-text">delete</i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
           @else
                <div class="row">
                    <div class="col s12">
                        <h1 class="grey-text text-lighten-4 center">No Category Available</h1>
                    </div>
                </div>
           @endif
        </div>
    </section>
    <!-- action btn -->
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red modal-trigger" href="#categoryAddModal">
            <i class="large material-icons">add</i>
        </a>
    </div>
    <!-- end of action btn -->
</main>
<!-- end of main container -->

<!-- add item modal -->
<!-- Modal Structure -->
<div id="categoryAddModal" class="modal grey-text text-darken-3 modal-medium">
    <div class="modal-content">
        <h4>Add Category</h4>
        <div class="row">
            <div class="input-field col m6 s12">
                <input id="catName" name="catName" type="text" class="validate">
                <label class="active" for="catName">Name</label>
                <span id="addCatNameError" class="red-text"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="Save" class="addCatSubmit waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
<!-- end of add item modal -->
<!-- edit item modal -->
<!-- Modal Structure -->
<div id="categoryEditModal" class="modal grey-text text-darken-3 modal-medium">
    <div class="modal-content">
        <h4>Edit Category</h4>
        <div class="row">
            <div class="input-field col m6 s12">
                <input id="editCatName" name="editCatName" type="text" class="validate">
                <label class="active" for="editCatName">Name</label>
                <span id="editCatNameError" class="red-text"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="Save" class="editCatSub waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
<!-- end of edit item modal -->
<!-- shop delete modal -->
<!-- Modal Structure -->
<div id="categoryDeleteModal" class="modal grey-text text-darken-3 modal-small">
    <div class="modal-content">
        <h4>Add you sure you want to delete this Category!?</h4>
    </div>
    <div class="modal-footer">
        <input type="button" value="Delete" class="deleteCatSubmit waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
<!-- end of user delete modal -->


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


        //add Cat
        $('.addCatSubmit').click( function(event){
            event.preventDefault();
            var formData = {
                name: $('input[name=catName]').val()
            }
            $.ajax({
                type: 'POST',
                url: 'admin/addCategory',
                data: formData,
                cache    : false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function (index , value) {
                            $('#addCatNameError').html(errors['name']);
                        });
                    }
                    return false;
                },
                success: function ()
                {
                    Materialize.toast('New Category has been added!', 4000);
                    var href = $('#categoriesHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            });
            $('#addCatNameError').html('');
        });
        //end add Cat

        //edit cat
        $('.editCat').click(function () {
            id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: 'admin/getCategory/' + id,
                success: function (res) {
                    $('#editCatName').val(res['name']);
                }
            })
        });

        $('.editCatSub').click( function(event){
            event.preventDefault();
            var formData = {
                name: $('input[name=editCatName]').val()
            }
            $.ajax({
                type: 'POST',
                url: 'admin/editCategory/'+ id ,
                data: formData,
                cache    : false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function () {
                            $('#editCatNameError').html(errors['name']);
                        });
                    }
                    return false;
                },
                success: function ()
                {
                    Materialize.toast('The Category has been edited', 4000);
                    var href = $('#categoriesHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            });
            $('#editCatNameError').html('');
        });
        //end edit cat

        //del cat
        $('.deleteCatSubmit').click( function(event){
            event.preventDefault();
            id = $('.deleteCat').attr('data-id');
            $.ajax({
                type: 'get',
                url: 'admin/deleteCategory/'+ id ,
                cache    : false,
                "_token": "{{ csrf_token() }}",
                success: function ()
                {
                    Materialize.toast('Category has been deleted', 4000);
                    var href = $('#categoriesHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            })
        });
        //end del cat
    })
</script>