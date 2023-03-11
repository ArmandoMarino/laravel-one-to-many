@extends('layouts.app')

@section('title', 'Types')

@section('content')
<header class="d-flex align-items-center justify-content-between">
  <h1>Types List</h1>
  {{-- LINK TO CREATE --}}
  <a href="{{route('admin.types.create')}}" class="btn btn-small btn-warning">Create new Type</a>
</header>

{{-- TABLE --}}
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Label</th>
        <th scope="col">Color</th>
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
        <th>Control Panel</th>
      </tr>
    </thead>

    <tbody>
        @forelse($types as $type)
        <tr>
            <th scope="row">{{$type->id }}</th>
            <td>{{$type->label }}</td>
            <td style="background-color : {{$type->color}}"></td>
            <td>{{$type->created_at }}</td>
            <td>{{$type->updated_at }}</td>
            <td class="d-flex">
                {{-- BOTTON TO types EDIT --}}
                <a class="btn btn-warning mx-2" href="{{route('admin.types.edit', $type->id)}}">
                  <i class=" fa-solid fa-pencil"></i>
                </a>

                {{-- BUTTON DELETE --}}
                <form action="{{route('admin.types.destroy', $type->id)}}" method="POST" class="delete-form" data-entity='type'>
                  @method('DELETE')
                  {{-- TOKEN --}}
                  @csrf
                  <button type="submit" class="btn btn-small btn-danger" >
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
            </td>
          </tr>
        @empty
        <tr>
            <td scope='row' colspan="5">No Types found</td>
        </tr>
        @endforelse
    </tbody>
  </table>

  {{-- <div class="row">
    @foreach ($types as  $type)
    <div class="col">
      <h3>{{$type->label }}</h3>
      <p> ({{ count($type->types) }}) </p>
      Per ogni Type nel types come type
      @foreach ($type->types as  $type)
         <a href="{{route('admin.types.show', $type->id )}}">{{ $type->title }}</a> 
      @endforeach
    </div>
    @endforeach
  </div> --}}

  {{-- PAGINATION se type ha la pagination  --}}
  <div class="d-flex">
    @if($types->hasPages())
      {{$types->links() }}
    @endif
  </div>
@endsection

