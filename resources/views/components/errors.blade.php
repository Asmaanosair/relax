@if ($errors->any())
    <div class="alert alert-danger mt-4">
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    </div>
@endif
