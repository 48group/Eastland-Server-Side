<main>
    @if($admin)
        <section class="admin-users">
            <div class="row">
                <div class="col s12">
                    <h2 class="grey-text text-lighten-4">Admin Profile</h2>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle small">perm_identity</i>
                            <span class="title">{{$admin->name}}</span>
                            <p>{{$admin->email}} <br>
                                {{$admin->type}} <br>
                                <a href="#userChangePass" class="modal-trigger editPassBtn" data-id="{{$admin->id}}">change Password</a><br/>
                            </p>
                            <a href="#userEditModal" class="secondary-content modal-trigger editUserBtn" data-id="{{$admin->id}}"><i class="material-icons">edit</i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    @endif
</main>


<div id="userEditModal" class="modal modal-fixed-footer grey-text text-darken-3">
    <div class="modal-content">
        <h4>Edit Admin Info</h4>
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



<form action="" method="post" id="editPassForm">
    <div id="userChangePass" class="modal modal-fixed-footer grey-text text-darken-3">
        <div class="modal-content">
            <h4>Admin Change Password</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input value="" id="editUserOldPassword" name="editUserOldPassword" type="password" class="validate">
                    <label class="active" for="editUserOldPassword">Old Password</label>
                    <span id="editUserOldPasswordError" class="red-text"></span>
                </div>
            </div>
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


<script>
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



    //edit admin
    $('.editUserBtn').click(function () {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: 'admin/getUser/' + id,
            success: function (res) {
                $('#editUserName').val(res['name']);
                $('#editUserEmail').val(res['email']);
            }
        })
    });

    $('.editUserSub').click( function(event){
        event.preventDefault();
        id = $('.editUserBtn').attr('data-id');
        var formData = {
            name: $('input[name=editUserName]').val(),
            email: $('input[name=editUserEmail]').val(),
            type :'admin'
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
                    });
                }
                return false;
            },
            success: function ()
            {
                Materialize.toast('The Admin user has been edited', 4000);
                var href = $('#adminProfileHref').attr('href');
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
    });
    //end edit admin



    //edit admin pass
    $('.editPassBtn').click(function(){
        id = $(this).attr('data-id');
    })
    $('.editPassSub').click( function(event){
        event.preventDefault();
        var formData = {
            password: $('input[name=editUserNewPassword]').val(),
            oldPassword: $('input[name=editUserOldPassword]').val(),
            password_confirmation : $('input[name=editUserConfirmPassword]').val()
        }
        $.ajax({
            type: 'POST',
            url: 'admin/editPassAdmin/'+ id ,
            data: formData,
            cache    : false,
            "_token": "{{ csrf_token() }}",
            error: function (jqXHR, textStatus, errorThrown)
            {
                if (jqXHR.status == 422) {
                    var errors = JSON.parse(jqXHR.responseText);
                    $.each(errors, function () {
                        $('#editUserNewPasswordError').html(errors['password']);
                        $('#editUserOldPasswordError').html(errors['oldPassword']);
                    });
                }
                return false;
            },
            success: function ()
            {
                Materialize.toast('The password has been changed', 4000);
                var href = $('#adminProfileHref').attr('href');
                $('.wrap').load(href);
            }
        }).done(function(){
            $('.editPassSub').attr("disabled", "disabled");
        })
        .fail(function() {
            $('.editPassSub').removeAttr("disabled");
        });
        $('#editUserNewPasswordError').html('');
        $('#editUserOldPasswordError').html('');
    });
    //end edit admin pass
</script>