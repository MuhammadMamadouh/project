
@if(count($errors->all()) > 0)
    <div class="alert alert-danger message">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success message">
        <h4>{{ session('success') }}</h4>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger message">
        <h4>{{ session('error') }}</h4>
    </div>
@endif

@push('js')
    <script type="text/javascript">
        $(function () {
            $('.message').fadeOut(5000);
        })

    </script>
@endpush