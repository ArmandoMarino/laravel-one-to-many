@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<header class="d-flex align-items-center justify-content-between">
  <h1>Projects List</h1>
  {{-- LINK TO CREATE --}}
  <a href="{{route('admin.projects.create')}}" class="btn btn-small btn-warning">Create new Project</a>
</header>

{{-- TABLE --}}
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Slug</th>
        <th scope="col">Type</th>
        <th scope="col">Status</th>
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
        <th>Control Panel</th>
      </tr>
    </thead>

    <tbody>
        @forelse($projects as $project)
        <tr>
            <th scope="row">{{$project->id }}</th>
            <td>{{$project->title }}</td>
            <td>{{$project->slug }}</td>
            {{--! Il ? NULLSAFE OPERATOR che impesice la rottura in caso di dato NULL dal DB --}}
            <td>{{$project->type?->label}}</td>
            <td>
              <form method="POST" action="{{route('admin.projects.toggle', $project->id)}}">
                @method('PATCH')
                @csrf
                <button type="submit" class="btn">
                  <i class="fa-solid fa-toggle-{{$project->is_published ? 'on' : 'off'}}  {{$project->is_published ? 'text-success' : 'text-danger'}} " ></i>
                </button>
              </form>
            </td>
            {{-- <td>{{$project->is_published ? 'Published' : 'Not Published' }}</td> --}}
            <td>{{$project->created_at }}</td>
            <td>{{$project->updated_at }}</td>
            <td class="d-flex">
                {{-- ROUTE TO SHOW --}}
                <a class="btn btn-small btn-primary" href="{{route('admin.projects.show', $project->id)}}">
                    <i class="fa-solid fa-eye"></i>
                </a>

                {{-- BOTTON TO PROJECTS EDIT --}}
                <a class="btn btn-warning mx-2" href="{{route('admin.projects.edit', $project->id)}}">
                  <i class=" fa-solid fa-pencil"></i>
                </a>

                {{-- BUTTON DELETE --}}
                <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" class="delete-form" data-entity='Project'>
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
            <td scope='row' colspan="5">Non ci sono Progetti</td>
        </tr>
        @endforelse
    </tbody>
  </table>

  {{-- PAGINATION se project ha la pagination  --}}
  <div class="d-flex">
    @if($projects->hasPages())
      {{$projects->links() }}
    @endif
  </div>
@endsection

