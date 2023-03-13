{{-- IF EXIST in create (model)update else store --}}
{{-- novalidate FOR CONTROL with CONTROLLER --}}
{{-- enctype="multipart/form-data" nei form quando voglio mandare dei file --}}

@if($project->exists)
<form method="POST" action=" {{route('admin.projects.update', $project->id)}}" class="mt-4" enctype="multipart/form-data" novalidate>
@method('PUT')
@else
<form method="POST" action=" {{route('admin.projects.store')}}" class="mt-4" enctype="multipart/form-data" novalidate>
@endif
    
    @csrf
    <div class="row">
        {{-- TITLE --}}
        <div class="col-md-4">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input placeholder="Insert Title here..." name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $project->title)}}" minlength="5" maxlength="50" required>
            </div>
        </div>

        {{-- SLUG --}}
        <div class="col-md-4">
            <div class="mb-3">
                <label for="slug" class="form-label">Slug's Title</label>
                <input type="text" class="form-control" id="slug" value="{{ Str::slug(old('title', $project->title),'-')}}" disabled>
            </div>
        </div>

        {{-- IMAGE URL --}}
        {{-- <div class="col-md-6">
            <div class="mb-3">
                <label for="image" class="form-label">Add image</label>
                <input placeholder="Insert URL image here..." name="image" type="url" class="form-control @error('image') is-invalid @enderror" id="image" value="{{old('image', $project->image)}}" required>
            </div>
        </div> --}}

        {{-- TYPE --}}
        <div class="col-md-4">
            <label for="type_id" class="form-label">Type</label>
            <select name="type_id" class="form-select" id="type_id">
                <option value="">Undefined</option>
                @foreach ($types as  $type)
                    {{-- Controllo se la relazione tra gli id è uguale per farla rimanere selezionata --}}
                    <option @if(old('type_id', $project->type?->id) == $type->id) selected @endif value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- UPLOAD IMG --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label for="image" class="form-label">Upload image</label>
                <input name="image" type="file" class="form-control" id="image">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <img id="image-preview" src="{{$project->image ? asset('storage/' . $project->image) : 'https://picsum.photos/536/354'}}" alt="{{$project->slug}}">
            </div>
        </div>
    </div>

    <div class="row">
        {{-- DESCRIPTION --}}
        <div class="col">
            <div class="col-md-12">
                <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea placeholder="Insert description here..." name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3"> {{old('description',$project->description)}}</textarea>
                </div>
            </div> 
            
            <div class="col-md-12">
                
            </div> 

        </div>


    </div>

    <div class="d-flex justify-content-between">
        {{-- CHECKBOX PUBLISH --}}
        <div class="form-check form-switch">
            <input name="is_published" class="form-check-input" type="checkbox" role="switch" id="is_published" 
            {{-- L'IF lo facciamo sul checked dentro l'input per l'old --}}
            @if (old('is_published', $project->is_published)) checked @endif>

            <label class="form-check-label" for="is_published">Published</label>
        </div>

        <div>
            {{-- BUTTON UPDATE --}}
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-floppy-disk"></i>
                Save
            </button>
            {{-- LINK TO INDEX --}}
            <a href="{{route('admin.projects.index')}}" class="btn btn-small btn-secondary">
                <i class="fa-solid fa-left-long"></i>
                Back
            </a>
        </div>
       
    </div>
</form>


@section('scripts')

{{--------------------- SLUG ---------------------------}}
<script>
// Prendiamo gli input dal form
const slugInput = document.getElementById('slug');
const titleInput = document.getElementById('title');

// Metto un event listener sul title con il Blur ovvero dopo aver tolto il focus dal title si renderizza
titleInput.addEventListener('blur',() => {
    slugInput.value = titleInput.value.toLowerCase().split(' ').join('-');
});
</script>

{{--------------------- PREVIEW ---------------------------}}
<script>
// Prendiamo gli elementi dal dom
const placeHolder = 'https://picsum.photos/536/354';
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('image-preview');

// Ascolto il cambio del caricamento file
imageInput.addEventListener('change', () =>{
// Controolo se ho caricato il file e con imageInput.files (array) vedo se ci sono files
if(imageInput.files && imageInput.files[0]){
// il reader sarà (assegno) una funzione che lo legge un file
let reader = new FileReader();
// faccio leggere il file come URL (il file in questione)
reader.readAsDataURL(imageInput.files[0]);
// Quando sarà pronto con il metodo onLoad  e gli assegno il risultato della lettura (e)
reader.onload = (e) => {
    imagePreview.src = e.target.result;
}

} else imagePreview.setAttribute('src', placeHolder);
});
</script>
@endsection