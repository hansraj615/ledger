<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @if ($message = Session::get('success'))
            <script>
                $(function(){
                    toastr.success('{!! $message !!}');
                });
            </script>
        @endif

        @if ($message = Session::get('error'))
            <script>
                $(function(){
                    toastr.error('{!! $message !!}');
                });
            </script>
        @endif

        @if ($errors->any())
        
            @php $message='<ul>'; @endphp
                @foreach ($errors->all() as $error)
                    @php $message=$message.'<li>'.$error.'</li>'; @endphp
                @endforeach
           @php $message=$message.'</ul>'; @endphp
           
            <script>
                $(function(){
                    toastr.error('{!! $message !!}');
                });
            </script>           
        @endif
    </div>
</div>