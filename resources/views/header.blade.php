<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ asset('js/common.js')}}"></script>
    <title>{{ __('adplexity.text_heading_title') }}</title>
</head>
<body>
<div class="container py-2">
    <div class="row">
        <div class="col-sm-12 text-center card bg-light">
            <h1>{{ __('adplexity.text_heading_title') }}</h1>
        </div>
    </div>

    <!-- Errors -->
    @if($errors->any())
        <div class="row py-2">
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Success -->
    @if(session()->has('message'))
        <div class="row py-2">
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif

    <!-- Buttons and quick add form -->
    <div class="row py-2">
        <div class="col-sm-8">
            <a href="{{ route('downloads.index_web') }}" type="button" class="btn btn-primary"><i class="fa fa-home"></i> {{ __('adplexity.text_home') }}</a>
            <a href="/docs" target="_blank" type="button" class="btn btn-primary"><i class="fa fa-home"></i> {{ __('adplexity.text_api_docs') }}</a>
        </div>
        <div class="col-sm-4">
            <form id="newDownloadForm" action="{{ route('downloads.store_web') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" id="downloadQuickAdd" name="url" class="form-control" placeholder="{{ __('adplexity.input_url') }}" aria-label="{{ __('adplexity.text_new_download') }}" aria-describedby="btnGroupAddon" value="">
                    <div class="input-group-append">
                        <div class="input-group-text" id="btnGroupAddon">
                            <button data-endpoint="{{ route('downloads.store_web') }}" type="submit" class="btn btn-primary" id="downloadQuickAddButton">{{ __('adplexity.button_add') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

