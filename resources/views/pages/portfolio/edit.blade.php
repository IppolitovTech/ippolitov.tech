<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Edit</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('portfolio.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('portfolio.update',$portfolio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                @foreach(array_keys($portfolio->getAttributes()) as $item)
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{$item}}:</strong>
                        @if ($item == 'text')
                        <textarea id="summernote" name="{{ $item }}" class="form-control long-text" placeholder="{{ $item }}">{{ $portfolio->$item }}</textarea>
                        @else
                        <input type="text" name="{{ $item }}" value="{{ $portfolio->$item }}" class="form-control" placeholder="{{ $item }}">
                        @endif
                    </div>
                </div>
                @endforeach

                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
</body>

</html>
@extends('pages.portfolio.styleAndSummernoteForPortfolio')
