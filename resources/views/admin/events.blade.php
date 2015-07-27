<!-- main container -->
<main>
    <!-- side bar -->
    @if($event != null)
        <section>
            <div class="row">
                <div class="col s12">
                    <h2 class="grey-text text-lighten-4">Events</h2>
                </div>
            </div>
            <div class="row white">
                <div class="col s12">
                    <table class="striped">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Shop Name</th>
                            <th>Event Category</th>
                            <th>start Date</th>
                            <th>End Date</th>
                            <th>Time</th>
                            <th>Place</th>
                            <th>Picture</th>
                            <th>Event Option</th>
                            <th>Picture Option</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($event as $events)
                            <tr>
                                <td>{{$events->name}}</td>
                                <td>{{$events->shop}}</td>
                                <td>{{$events->category}}</td>
                                <td>{{$events->startDate}}</td>
                                <td>{{$events->endDate}}</td>
                                <td>{{$events->time}}</td>
                                <td>{{$events->place}}</td>
                                @if($events->picture == null)
                                    <td><img class="activator" src="images/items/4.gif" width="50" height="50"></td>
                                @else
                                    <td><img class="activator" src="{{asset('/img/events/'.$events->picture)}}" width="50" height="50"/></td>
                                @endif
                                <td>
                                    <a href="#eventEditModal" class="modal-trigger editEvent" data-id="{{$events->id}}"><i class="material-icons blue-text">edit</i></a>
                                    <a href="#eventDeleteModal" class="modal-trigger deleteEvent" data-id="{{$events->id}}"><i class="material-icons red-text">delete</i></a>
                                </td>
                                <td>
                                    <a href="#addEventImage" class="modal-trigger addImage" data-id="{{$events->id}}"><i class="material-icons blue-text">add</i></a>
                                    <a href="#deleteEventImage" class="modal-trigger deleteImage" data-id="{{$events->id}}" @if($events->picture == null)style="display: none"@endif ><i class="material-icons red-text">delete</i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @else
        <div class="row">
            <div class="col s12">
                <h1 class="grey-text text-lighten-4 center">No Event Available</h1>
            </div>
        </div>
    @endif
</main>
<!-- end of main container -->
<!-- sale add modal -->
<!-- Modal Structure -->
<div id="eventAddModal" class="modal modal-fixed-footer grey-text text-darken-3">
    <div class="modal-content">
        <h4>Add Event</h4>
        <div class="row">
            <div class="input-field col m6 s12">
                <input id="addEventName" name="addEventName" type="text" class="validate">
                <label class="active" for="addEventName">Name</label>
                <span id="addEventNameError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input id="addEventPlace" name="addEventPlace" type="text" class="validate">
                <label class="active" for="addEventPlace">Place</label>
                <span id="addEventPlaceError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <select id="addEventCat" name="addEventCat">
                    <option label="Sale"  value="sale">Sale(For special shop)</option>
                    <option label="Event"  value="event">Event(For whole shopping center)</option>
                </select>
                <label>Category</label>
                <span id="addEventCatError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <select id="addEventShopId" name="addEventShopId">
                    @if($shop != null)
                        @foreach($shop as $shops)
                            <option label="{{$shops->name}}"  value="{{$shops->id}}">{{$shops->name}}</option>
                        @endforeach
                    @else
                        <option label=""  value=""></option>
                   @endif
                </select>
                <label>Shop</label>
                <span id="addEventShopIdError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m12 s12">
                <textarea id="addEventInfo" name="addEventInfo" class="materialize-textarea"></textarea>
                <label for="addEventInfo">Description</label>
                <span id="addEventInfoError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input type="date" id="addEventStartDate" name="addEventStartDate" class="datepicker">
                <label class="active" for="addEventStartDate">Start Date</label>
                <span id="addEventStartDateError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input type="date" id="addEventEndDate" name="addEventEndDate" class="datepicker">
                <label class="active" for="addEventEndDate">End Date</label>
                <span id="addEventEndDateError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input type="text" id="addEventTime" name="addEventTime" class="datepicker">
                <label class="active" for="addEventTime">Time</label>
                <span id="addEventTimeError" class="red-text"></span>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action waves-effect waves-light blue darken-2 btn submit">Save</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-light red darken-2 btn m-cancel-btn">Cancel</a>
    </div>
</div>
<!-- end of add item modal -->
<!-- end of main container -->
<!-- sale add modal -->
<!-- Modal Structure -->
<div id="eventDeleteModal" class="modal grey-text text-darken-3 modal-small">
    <div class="modal-content">
        <h4>Add you sure you want to delete this Event!?</h4>
    </div>
    <div class="modal-footer">
        <input type="button" value="Delete" class="deleteEventSub waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>
<!-- end of add item modal -->
<!-- sale edit modal -->
<!-- Modal Structure -->
<div id="eventEditModal" class="modal modal-fixed-footer grey-text text-darken-3">
    <div class="modal-content">
        <h4>Edit event</h4>
        <div class="row">
            <div class="input-field col m6 s12">
                <input id="editEventName" name="editEventName" type="text" class="validate">
                <label class="active" for="editEventName">Name</label>
                <span id="editEventNameError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <textarea id="editEventInfo" name="editEventInfo" class="materialize-textarea"></textarea>
                <label for="editEventInfo">Description</label>
                <span id="editEventInfoError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                Category
                <select id="editEventCat" name="editEventCat" class="js-example-tags item-tag">
                    <option label="Sale"  value="sale">Sale(For special shop)</option>
                    <option label="Event"  value="event">Event(For whole shopping center)</option>
                </select>
                <span id="addEventCatError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                Shop
                <select id="editEventShopId" name="editEventShopId" class="js-example-tags item-tag">
                    @if($shop != null)
                        @foreach($shop as $shops)
                            <option label="{{$shops->name}}"  value="{{$shops->id}}">{{$shops->name}}</option>
                        @endforeach
                    @else
                        <option label=""  value=""></option>
                    @endif
                </select>
                <span id="editEventShopIdError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input id="editEventPlace" name="editEventPlace" type="text" class="validate">
                <label class="active" for="editEventPlace">Place</label>
                <span id="editEventPlaceError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input type="date" id="editEventStartDate" name="editEventStartDate" class="datepicker">
                <label class="active" for="editEventStartDate">Start Date</label>
                <span id="editEventStartDateError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input type="date" id="editEventEndDate" name="editEventEndDate" class="datepicker">
                <label class="active" for="editEventEndDate">End Date</label>
                <span id="editEventEndDateError" class="red-text"></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <input type="text" id="editEventTime" name="editEventTime" class="datepicker">
                <label class="active" for="editEventTime">Time</label>
                <span id="editEventTimeError" class="red-text"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action waves-effect waves-light blue darken-2 btn editEventSub">Save</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-light red darken-2 btn m-cancel-btn">Cancel</a>
    </div>
</div>
<!-- end of sale edit modal -->


<form action="" method="post" enctype="multipart/form-data" id="addEventImageForm">
    <div id="addEventImage" class="modal grey-text text-darken-3 modal-medium">
        <div class="modal-content">
            <h4>Add photo</h4>
            <div class="row">
                <label for="addEventImage">file</label><br/>
                <input type="file" name="picture" id="addEventImage" accept="image/jpg"/><br/>
                <span id="addEventImageError" class="red-text"></span>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action waves-effect waves-light blue darken-2 btn addEventImage">Save</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-light red darken-2 btn m-cancel-btn">Cancel</a>
        </div>
    </div>
</form>

<div id="deleteEventImage" class="modal grey-text text-darken-3 modal-small">
    <div class="modal-content">
        <h4>Add you sure you want to delete this image!?</h4>
    </div>
    <div class="modal-footer">
        <input type="button" value="Delete" class="deleteImageSub waves-effect waves-light blue darken-2 btn"/>
        <input type="button" value="Cancel" class="modal-close waves-effect waves-light red darken-2 btn m-cancel-btn"/>
    </div>
</div>

<!-- action btn -->
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red modal-trigger" href="#eventAddModal">
        <i class="large material-icons">add</i>
    </a>
</div>
<!-- end of action btn -->
<!-- main footer -->




<script>
    $('.modal-trigger').leanModal();
    $('select').material_select();
</script>

<script>
    $(document).ready(function() {
        //add event
        $('.submit').click(function (event) {
            event.preventDefault();
            var formData = {
                name: $('input[name=addEventName]').val(),
                info: $('textarea[name=addEventInfo]').val(),
                startDate: $('input[name=addEventStartDate]').val(),
                endDate: $('input[name=addEventEndDate]').val(),
                time: $('input[name=addEventTime]').val(),
                shopId: $('select[name=addEventShopId]').val(),
                category: $('select[name=addEventCat]').val(),
                place: $('input[name=addEventPlace]').val()
            }
            $.ajax({
                type: 'POST',
                url: 'admin/createEvent',
                data: formData,
                cache: false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function (index, value) {
                            $('#addEventNameError').html(errors['name']);
                            $('#addEventPlaceError').html(errors['place']);
                            $('#addEventShopIdError').html(errors['shopId']);
                            $('#addEventInfoError').html(errors['info']);
                            $('#addEventStartDateError').html(errors['startDate']);
                            $('#addEventEndDateError').html(errors['endDate']);
                            $('#addEventCatError').html(errors['category']);
                        });
                    }
                    return false;
                },
                success: function () {
                    Materialize.toast('New event has been added!', 4000);
                    var href = $('#eventsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            });
            $('#addEventNameError').html('');
            $('#addEventPlaceError').html('');
            $('#addEventShopIdError').html('');
            $('#addEventInfoError').html('');
            $('#addEventStartDateError').html('');
            $('#addEventEndDateError').html('');
            $('#addEventCatError').html('');
        });
        //end add event


        //add image
        $('.addImage').click(function () {
            id = $(this).attr('data-id');
        });
        $('.addEventImage').click(function (e) {
            e.preventDefault();
            var formData = new FormData($('#addEventImageForm')[0]);
            $.ajax({
                type: 'POST',
                data: formData,
                cache: false,
                "_token": "{{ csrf_token() }}",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                url: 'admin/addEventImage/' + id,
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function (index, value) {
                            $('#addEventImageError').html(errors['picture']);
                        });
                    }
                    return false;
                },
                success: function () {
                    Materialize.toast('Event Image added!', 4000);
                    var href = $('#eventsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            });
            $('#addEventImageError').html('');
        });
        //end add image


        //del event image
        $('.deleteImage').on('click', function () {
            id = $(this).attr('data-id');
        });
        $('.deleteImageSub').click(function (event) {
            console.log(id);
            event.preventDefault();
            $.ajax({
                type: 'GET',
                url: 'admin/deleteEventImage/' + id,
                cache: false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    return false;
                },
                success: function () {
                    Materialize.toast('Image has been deleted', 4000);
                    var href = $('#eventsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            });
        });
        //end del event image


        //edit event
        $('.editEvent').click(function () {
            id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: 'admin/getEvent/' + id,
                success: function (res) {
                    $('#editEventName').val(res['name']);
                    $('#editEventInfo').val(res['info']);

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

                    $('#editEventStartDate').val(startDate);
                    $('#editEventEndDate').val(endDate);
                    $('#editEventPlace').val(res['place']);
                    $('#editEventCat').val(res['category']).change();
                    $('#editEventShopId').val(res['shopId']).change();
                    $('#editEventTime').val(res['time']);
                }
            })
        })

        $('.editEventSub').click(function (event) {
            event.preventDefault();
            var formData = {
                name: $('input[name=editEventName]').val(),
                startDate: $('input[name=editEventStartDate]').val(),
                endDate: $('input[name=editEventEndDate]').val(),
                info: $('textarea[name=editEventInfo]').val(),
                shopId: $('select[name=editEventShopId]').val(),
                category: $('select[name=editEventCat]').val(),
                place: $('input[name=editEventPlace]').val()
            }
            $.ajax({
                type: 'POST',
                url: 'admin/editEvent/' + id,
                data: formData,
                cache: false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 422) {
                        var errors = JSON.parse(jqXHR.responseText);
                        $.each(errors, function () {
                            $('#editEventNameError').html(errors['name']);
                            $('#editEventPlaceError').html(errors['place']);
                            $('#editEventInfoError').html(errors['info']);
                            $('#editEventCatError').html(errors['category']);
                            $('#editEventShopIdError').html(errors['shopId']);
                            $('#editEventStartDateError').html(errors['startDate']);
                            $('#editEventEndDateError').html(errors['endDate']);
                        });
                    }
                    return false;
                },
                success: function () {
                    Materialize.toast('The event has been edited', 4000);
                    var href = $('#eventsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            });
            $('#editEventNameError').html('');
            $('#editEventPlaceError').html('');
            $('#editEventInfoError').html('');
            $('#editEventCatError').html('');
            $('#editEventShopIdError').html('');
            $('#editEventStartDateError').html('');
            $('#editEventEndDateError').html('');
        });
//     end edit sale


        //del event
        $('.deleteEvent').click(function () {
            id = $(this).attr('data-id');
            console.log(id);
        });
        $('.deleteEventSub').click(function (event) {
            event.preventDefault();
            $.ajax({
                type: 'get',
                url: 'admin/deleteEvent/' + id,
                cache: false,
                "_token": "{{ csrf_token() }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    return false;
                },
                success: function () {
                    Materialize.toast('Event has been deleted', 4000);
                    var href = $('#eventsHref').attr('href');
                    $('.wrap').load(href);
                    return false;
                }
            })
        });
    });
    //end del event


    $(".js-example-tags").select2({
        tags: true
    });
</script>