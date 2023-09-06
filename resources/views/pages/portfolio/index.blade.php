<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Portfolio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Portfolio</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{route('portfolio.create')}}"> Create portfolio</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <table class="table table-bordered">
            <tr>
                @foreach($fields as $item)
                @if ($item=='text')
                @else
                <th>{{$item}}</th>
                @endif
                @endforeach
                <th width="280px">Action</th>
            </tr>
            @foreach ($portfolio as $item)
            <tr>
                @foreach($fields as $itemFields)

                @if ($itemFields=='img')
                <td><img src="{{ $item->img }}" style="width:350px; height:350px"></td>
                @elseif ($itemFields=='text')
                @else
                <td>{{ $item->$itemFields }}</td>
                @endif
                @endforeach
                <td>
                    <form action="{{route('portfolio.destroy',$item->id)}}" method="Post">
                        <a class="btn btn-primary" href="{{route('portfolio.edit',$item->id)}}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $portfolio->links() !!}
</body>
<style>
    span.relative.z-0.inline-flex.shadow-sm.rounded-md {
        display: none;
    }
    td{
        width:50px;
    }
</style>

</html>