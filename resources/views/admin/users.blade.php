<!-- main container -->
<main>
    <!-- side bar -->
    @if($user)
            <section class="admin-users">
                <div class="row">
                    <div class="col s12">
                        <h2 class="grey-text text-lighten-4">Users</h2>
                    </div>
                </div>
                @foreach($user as $users)
                    <div class="row">
                        <div class="col s12">
                            <ul class="collection">
                                <li class="collection-item avatar">
                                    <i class="material-icons circle small">perm_identity</i>
                                    <span class="title">{{$users->name}}</span>
                                    <p>{{$users->email}} <br>
                                        {{$users->type}} <br>
                                        <a href="#userChangePass" class="modal-trigger editPassBtn" data-id="{{$users->id}}">change Password</a><br/>
                                    </p>
                                    <a href="#userEditModal" class="secondary-content modal-trigger editUserBtn" data-id="{{$users->id}}"><i class="material-icons">edit</i></a>
                                    <a href="#userDeleteModal" class="third-content modal-trigger deleteUser" data-id="{{$users->id}}"><i class="material-icons red-text">delete</i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </section>
        @endforeach
    @else
        <div class="row">
            <div class="col s12">
                <h2 class="grey-text text-lighten-4 center">NO User Available</h2>
            </div>
        </div>
    @endif




    <!-- user add modal -->
    <!-- Modal Structure -->
    <div id="userAddModal" class="modal modal-fixed-footer grey-text text-darken-3">
        <div class="modal-content">
            <h4>Add new user</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input  id="addUserName" name="addUserName" type="text" class="validate">
                    <label class="active" for="addUserName">Username</label>
                    <span id="addUserNameError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input value="" id="addUserEmail" name="addUserEmail" type="text" class="validate">
                    <label class="active" for="addUserEmail">Email</label>
                    <span id="addUserEmailError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input value="" id="addUserPassword" name="addUserPassword" type="password" class="validate">
                    <label class="active" for="addUserPassword">Password</label>
                    <span id="addUserPasswordError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input value="" id="addUserConfirmPassword" name="addUserConfirmPassword" type="password" class="validate">
                    <label class="active" for="addUserConfirmPassword">Confirm Password</label>
                    <span id="addUserConfirmPasswordError" class="red-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    Role <br/>
                    <select id="addUserType" name="addUserType" class="js-example-tags item-tag">
                        <option label="shop Owner" value="shopOwner">Shop Owner</option>
                        <option label="Admin" value="admin">Admin</option>
                        <option label="User"  value="user">User</option>
                    </select>
                    <span id="addUserTypeError" class="red-text"></span>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
        </div>
        <div class="modal-footer">
            <input type="button" value="Save" class="addUserBtn waves-effect waves-light blue darken-2 btn"/>
            <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
        </div>
    </div>

    <!-- end of edit modal -->
    <!-- user edit modal -->
    <!-- Modal Structure -->
        <div id="userEditModal" class="modal modal-fixed-footer grey-text text-darken-3">
            <div class="modal-content">
                <h4>Edit User Info</h4>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input value="" id="editUserName" name="editUserName" type="text" class="validate">
                        <label class="active" for="editUserName">Username</label>
                        <span id="editUserNameError" class="red-text"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input value="" id="editUserEmail" name="editUserEmail" type="text" class="validate">
                        <label class="active" for="editUserEmail">Email</label>
                        <span id="editUserEmailError" class="red-text"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12">
                        Role
                        <select id="editUserType" name="editUserType" class="js-example-tags item-tag">
                            <option label="shop Owner" value="shopOwner">Shop Owner</option>
                            <option label="Admin" value="admin">Admin</option>
                            <option label="User"  value="user">User</option>
                        </select>
                        <span id="editUserTypeError" class="red-text"></span>
                    </div>

                </div>
                <br>
                <br>
                <br>
                <br>
            </div>
            <div class="modal-footer">
                <input type="button" value="Save" class="editUserSub waves-effect waves-light blue darken-2 btn"/>
                <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
            </div>
        </div>

    <!-- end of user edit modal -->


    <!-- action btn -->
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red modal-trigger" href="#userAddModal">
            <i class="large material-icons">add</i>
        </a>
    </div>
    <!-- end of action btn -->



    <!-- user change pass modal -->
    <!-- Modal Structure -->
    <form action="" method="post" id="editPassForm">
        <div id="userChangePass" class="modal modal-fixed-footer grey-text text-darken-3">
            <div class="modal-content">
                <h4>User Change Password</h4>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input value="" id="editUserNewPassword" name="editUserNewPassword" type="password" class="validate">
                        <label class="active" for="editUserNewPassword">New Password</label>
                        <span id="editUserNewPasswordError" class="red-text"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input value="" id="editUserConfirmPassword" name="editUserConfirmPassword" type="password" class="validate">
                        <label class="active" for="editUserConfirmPassword">Confirm Password</label>
                        <span id="editUserConfirmPasswordError" class="red-text"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" value="Save" class="editPassSub waves-effect waves-light blue darken-2 btn"/>
                <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
            </div>
        </div>
    </form>
    <!-- end of user change pass modal -->

    <!-- Modal Structure -->
    <div id="userDeleteModal" class="modal grey-text text-darken-3 modal-small">
        <div class="modal-content">
            <h4>Add you sure you want to delete this User!?</h4>
        </div>
        <div class="modal-footer">
            <input type="button" value="Delete" class="deleteUserSubmit waves-effect waves-light blue darken-2 btn"/>
            <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
        </div>
    </div>
    <!-- end of user delete modal -->
</main>
<!-- end of main container -->
<!-- main footer -->
<!-- end of main footer -->


<script type="text/javascript">
    $(document).ready(function(){

        $('.modal-trigger').leanModal();
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
//        $('select').material_select();
    });


    //add user
    $('.addUserBtn').click(function (e) {
        e.preventDefault();
        var formData = {
            name: $('input[name=addUserName]').val(),
            email: $('input[name=addUserEmail]').val(),
            password: $('input[name=addUserPassword]').val(),
            password_confirmation : $('input[name=addUserConfirmPassword]').val(),
            type: $('select[name=addUserType]').val()
        }
        $.ajax({
            type: 'POST',
            url: 'admin/addUser',
            data: formData,
            "_token": "{{ csrf_token() }}",
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                    var errors = JSON.parse(jqXHR.responseText);
                    $.each(errors, function () {
                        $('#addUserNameError').html(errors['name']);
                        $('#addUserPasswordError').html(errors['password']);
                        $('#addUserConfirmPasswordError').html(errors['password_confirmation']);
                        $('#addUserEmailError').html(errors['email']);
                        $('#addUserTypeError').html(errors['type']);
                    });
                    return false;
                }
            },
            success: function () {
                Materialize.toast('User has been added!', 4000);
                var href = $('#usersHref').attr('href');
                $('.wrap').load(href);
            }
        }).done(function(){
            $('.addUserBtn').attr("disabled", "disabled");
        })
        .fail(function() {
            $('.addUserBtn').removeAttr("disabled");
        });
        $('#addUserNameError').html('');
        $('#addUserPasswordError').html('');
        $('#addUserConfirmPasswordError').html('');
        $('#addUserEmailError').html('');
        $('#addUserTypeError').html('');
    });
//    end add user


    //edit user
    $('.editUserBtn').click(function () {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: 'admin/getUser/' + id,
            success: function (res) {
                $('#editUserName').val(res['name']);
                $('#editUserEmail').val(res['email']);
                $('#editUserType').val(res['type']).change();
            }
        })
    });


    $('.editUserBtn').click(function(){
        id = $(this).attr('data-id');
    })

    $('.editUserSub').click( function(event){
        event.preventDefault();
        var formData = {
            name: $('input[name=editUserName]').val(),
            email: $('input[name=editUserEmail]').val(),
            type: $('select[name=editUserType]').val()
        }
        $.ajax({
            type: 'POST',
            url: 'admin/editUser/'+ id ,
            data: formData,
            cache    : false,
            "_token": "{{ csrf_token() }}",
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                    var errors = JSON.parse(jqXHR.responseText);
                    $.each(errors, function () {
                        $('#editUserNameError').html(errors['name']);
                        $('#editUserEmailError').html(errors['email']);
                        $('#editUserTypeError').html(errors['type']);
                    });
                }
                $(this).attr('disabled', false);
                return false;
            },
            success: function ()
            {
                Materialize.toast('The user has been edited', 4000);
                var href = $('#usersHref').attr('href');
                $('.wrap').load(href);
            }
        }).done(function(){
            $('.editUserSub').attr("disabled", "disabled");
        })
        .fail(function() {
            $('.editUserSub').removeAttr("disabled");
        });
        $('#editUserNameError').html('');
        $('#editUserEmailError').html('');
        $('#editUserTypeError').html('');
    });
    //end edit user

    //edit user pass
    $('.editPassBtn').click(function(){
        id = $(this).attr('data-id');
    })
    $('.editPassSub').click( function(event){
        event.preventDefault();
        var formData = {
            password: $('input[name=editUserNewPassword]').val(),
            password_confirmation : $('input[name=editUserConfirmPassword]').val()
        }
        $.ajax({
            type: 'POST',
            url: 'admin/editPassUser/'+ id ,
            data: formData,
            cache    : false,
            "_token": "{{ csrf_token() }}",
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                    var errors = JSON.parse(jqXHR.responseText);
                    $.each(errors, function () {
                        $('#editUserOldPasswordError').html('old pass incorrect');
                        $('#editUserNewPasswordError').html(errors['password']);
                    });
                }
                return false;
            },
            success: function ()
            {
                Materialize.toast('The password has been changed', 4000);
                var href = $('#usersHref').attr('href');
                $('.wrap').load(href);
                return false;
            }
        }).done(function(){
            $('.editPassSub').attr("disabled", "disabled");
        })
        .fail(function() {
            $('.editPassSub').removeAttr("disabled");
        });
        $('#editUserNewPasswordError').html('');
    });
    //end edit user pass


    //del user
    $('.deleteUser').on('click' , function(event){
        event.preventDefault();
        id = $(this).attr('data-id');
    });
    $('.deleteUserSubmit').click( function(event){
        event.preventDefault();
        $.ajax({
            type: 'get',
            url: 'admin/deleteUser/'+ id ,
            cache    : false,
            "_token": "{{ csrf_token() }}",
            error: function (jqXHR, textStatus, errorThrown)
            {
                return false;
            },
            success: function ()
            {
                Materialize.toast('User has been deleted', 4000);
                var href = $('#usersHref').attr('href');
                $('.wrap').load(href);
                return false;
            }
        }).done(function(){
            $('.deleteUserSubmit').attr("disabled", "disabled");
        })
        .fail(function() {
            $('.deleteUserSubmit').removeAttr("disabled");
        });
    });
    //end del user

    $(".js-example-tags").select2({
        placeholder: 'choose category',
        tags: true,
        tokenSeparators: [',', ' ']
    });
</script>


