@if (session('msg-sucesso', '') !== '')
    <div class="alert alert-success">
        {{ session('msg-sucesso') }}
    </div>
@endif

@if (session('msg-erro', '') !== '')
    <div class="alert alert-danger">
        {{ session('msg-erro') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif