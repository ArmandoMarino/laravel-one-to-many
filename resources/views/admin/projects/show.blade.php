@extends('layouts.app')

@section('title', $project->title)

@section('content')

<header>
    <h1>{{ $project->title }}</h1>
</header>
<div class="clearfix">
    {{-- IMAGE if perche l'immagino puo anche non esserci --}}
    @if($project->image)
    {{-- la stampo da asset che punta in Public mettendo il prefisso del path --}}
    <img class="float-start" src="{{asset('storage/'. $project->image)}}" alt="{{$project->slug}}">
    @endif
    <p>{{ $project->description }}</p>
    <div class="d-flex justify-content-between" >
        <div>
            <p>Created at : <i><time>{{$project->created_at}} </time></i></p>
            <p>Updated at :  <i><time>{{$project->updated_at}} </time></i></p>
            <p>Status : <strong>{{ $project->is_published ? 'Published' : 'Draft'}}</strong></p>
            <p>Type : {{ $project->type?->label ? $project->type->label : 'Undefined'}}</p>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4" >
        {{-- BOTTON TO PROJECTS INDEX --}}
        <a class="btn btn-secondary me-2" href="{{route('admin.projects.index')}}">
            <i class="me-2 fa-solid fa-left-long"></i> Back
        </a>

        {{-- BOTTON TO PROJECTS EDIT --}}
        <a class="btn btn-warning me-2" href="{{route('admin.projects.edit', $project->id)}}">
            <i class="me-2 fa-solid fa-pencil"></i> Edit
        </a>

        {{-- BOTTON PUBLISH --}}
        <form method="POST" action="{{route('admin.projects.toggle', $project->id)}}">
            @method('PATCH')
            @csrf
            <button type="submit" class="btn me-2 btn-outline-{{$project->is_published ? 'danger' : 'success'}}">
                {{$project->is_published ? 'Put on Drafs' : 'Publish'}}
            </button>
          </form>

        <form action="{{route('admin.projects.destroy', $project->id)}}" class="delete-form" method="POST" data-entity='Project'>
            {{-- Method DELETE --}}
            @method('DELETE')
            {{-- TOKEN --}}
            @csrf
            <button type="submit" class="btn btn-small btn-danger" >
              <i class="fa-solid fa-trash me-2"></i> Delete Project
            </button>
          </form>
    </div>
</div>

@endsection

