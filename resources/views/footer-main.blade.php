@yield('bot-content')
@if(isset($scripts))
    @foreach($scripts as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach
@endif
<script src="{{ asset('assets/admin/js/admin.js') }}"></script>
</body>
</html>
