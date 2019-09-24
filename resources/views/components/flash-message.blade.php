@if (Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif

@if (Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif

@if (Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('warning') }}</strong>
    </div>
@endif

@if (Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('info') }}</strong>
    </div>
@endif

{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--        Please check the form below for errors--}}
{{--    </div>--}}
{{--@endif--}}
