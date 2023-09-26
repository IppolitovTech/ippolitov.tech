@extends('pages.admin.header')
<div class="container mt-2">
    <div class="col-lg-12 margin-tb">
        <div>
            <h2>{{ ucfirst($table) }} List</h2>
        </div>
        <div class="row  mb-3">
            <div class="col">
                <a class="btn btn-primary" href="{{ route($table . '.create') }}"> Create {{ ucfirst($table) }}</a>
            </div>
            <div class="col text-end">
                <a class="btn btn-primary" href="{{ route('admin') }}"> Back</a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('success') }}
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            @foreach($fields as $field)
            @if ($field=='text')
            @elseif ($field=='img')
            <th width="250px">{{ ucfirst($field) }}</th>
            @else
            <th>{{ ucfirst($field) }}</th>
            @endif
            @endforeach
            <th width="180px">Actions</th>
        </tr>
        @foreach($data['items'] as $item)
        <tr>
            @foreach($fields as $field)
            @if ($field=='img')
            <td>
                <div style="background: url('{{ $item->img }}') top/cover no-repeat;" class="crud-image">
            </td>
            @elseif ($field=='text')
            @else
            <td>{{ $item->$field }}</td>
            @endif
            @endforeach
            <td>
                <form action="{{ route($table . '.destroy', $item->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route($table . '.edit', $item->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="pagination-container">{{ $data['items']->links() }}</div>
</div>
@extends('pages.admin.footer')