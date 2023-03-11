{{-- IF EXIST in create (model)update else store --}}
{{-- novalidate FOR CONTROL with CONTROLLER --}}
{{-- enctype="multipart/form-data" nei form quando voglio mandare dei file --}}

@if($type->exists)
<form method="POST" action=" {{route('admin.types.update', $type->id)}}" class="mt-4" novalidate>
@method('PUT')
@else
<form method="POST" action=" {{route('admin.types.store')}}" class="mt-4" novalidate>
@endif
    
    @csrf
    <div class="row">
        {{-- LABEL --}}
        <div class="col-md-4">
            <div class="mb-3">
                <label for="label" class="form-label">Label</label>
                <input placeholder="Insert label here..." name="label" type="text" class="form-control @error('label') is-invalid @enderror" id="label" value="{{ old('label', $type->label)}}" minlength="5" maxlength="50" required>
            </div>
        </div>

        {{-- COLOR --}}
        <div class="col-md-4">
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="color" name="color" class="form-control" id="color" value="{{ old('color', $type->color) }}">
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">

        <div>
            {{-- BUTTON UPDATE --}}
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-floppy-disk"></i>
                Save
            </button>
            {{-- LINK TO INDEX --}}
            <a href="{{route('admin.types.index')}}" class="btn btn-small btn-secondary">
                <i class="fa-solid fa-left-long"></i>
                Back
            </a>
        </div>
       
    </div>
</form>
