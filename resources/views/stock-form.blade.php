<!DOCTYPE html>
<html>
<head>
    @include('partials.head')
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="mt-5 card">
        <div class="card-body">
            <h2>Hiren Buhecha - XM - PHP Exercise - v21.0.5</h2>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (isset($data))
            @include('partials.historical-chart')
    @endif

    @unless(isset($data))
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('form.submit') }}">
                    @csrf
                    @include('partials.form-fields')
                </form>
            </div>
        </div>
    @endunless
</div>
@include('partials.footer-scripts')
</body>
</html>
