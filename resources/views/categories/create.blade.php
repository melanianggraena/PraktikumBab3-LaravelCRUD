{{-- resources/views/categories/create.blade.php --}}

@extends('layouts.master')

@section('title', 'Tambah Kategori')

@section('content')

{{-- ===================================== --}}
{{-- CHALLENGE #5                          --}}
{{-- View Create menggunakan Layout Master --}}
{{-- ===================================== --}}

<div class="container">

```
<div class="d-flex justify-content-between align-items-center mb-4">

    <h4 class="fw-bold">
        Tambah Kategori
    </h4>

    <a href="{{ route('categories.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>

</div>

@if ($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

<div class="card shadow-sm border-0">

    <div class="card-body">

        <form action="{{ route('categories.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    required
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Slug
                </label>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    class="form-control"
                    value="{{ old('slug') }}"
                    required
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-control"
                >{{ old('description') }}</textarea>

            </div>

            <div class="form-check mb-3">

                <input
                    type="checkbox"
                    class="form-check-input"
                    name="is_active"
                    value="1"
                    checked
                >

                <label class="form-check-label">
                    Aktif
                </label>

            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Simpan
            </button>

        </form>

    </div>

</div>
```

</div>

@endsection

{{-- ===================================== --}}
{{-- CHALLENGE #5                          --}}
{{-- Slug Otomatis dengan JavaScript       --}}
{{-- ===================================== --}}

@push('scripts')

<script>

document.getElementById('name').addEventListener('keyup', function () {

    let slug = this.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');

    document.getElementById('slug').value = slug;

});

</script>

@endpush
