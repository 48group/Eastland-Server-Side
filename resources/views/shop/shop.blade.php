@include('shop.header')

<div id="preloader">
    <div class="box">loading</div>
</div>

<div class="wrap"></div>

@include('footer')

<script>
    $(document).ready(function(){
        var href = $('#detailHref').attr('href');
        $('.wrap').load(href);
    })
</script>
