{{-- resources/views/categories/index.blade.php --}}

@extends('layouts.master')

@section('title', 'Daftar Kategori')

@section('content')

{{-- ===================================== --}}
{{-- CHALLENGE #5                         --}}
{{-- View Index menggunakan layouts.master --}}
{{-- ===================================== --}}

<div class="d-flex justify-content-between align-items-center mb-4">

```
<div>
    <h4 class="fw-bold mb-1">
        <i class="bi bi-tags text-primary me-2"></i>
        Daftar Kategori
    </h4>

    <p class="text-muted mb-0">
        Kelola seluruh kategori produk
    </p>
</div>

<a href="{{ route('categories.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg me-1"></i>
    Tambah Kategori
</a>
```

</div>

<div class="card border-0 shadow-sm">

```
<div class="card-body p-0">

    <div class="table-responsive">

        <table class="table table-hover mb-0">

            <thead class="table-light">
                <tr>
                    <th class="px-4">#</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Jumlah Produk</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse ($categories as $category)

                <tr>

                    <td class="px-4">
                        {{ $categories->firstItem() + $loop->index }}
                    </td>

                    <td>
                        <strong>{{ $category->name }}</strong>
                    </td>

                    <td>
                        <span class="text-muted">
                            {{ $category->slug }}
                        </span>
                    </td>

                    <td class="text-center">

                        {{-- CHALLENGE #2 --}}
                        {{-- scopeActive() digunakan di model --}}

                        @if($category->is_active)
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                Nonaktif
                            </span>
                        @endif

                    </td>

                    <td class="text-center">

                        <span class="badge bg-info">
                            {{ $category->products()->count() }}
                        </span>

                    </td>

                    <td class="text-center">

                        <div class="d-flex justify-content-center gap-2">

                            <a
                                href="{{ route('categories.edit', $category) }}"
                                class="btn btn-sm btn-warning"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            {{-- ===================================== --}}
                            {{-- CHALLENGE #7                         --}}
                            {{-- Bootstrap Modal Konfirmasi Hapus     --}}
                            {{-- ===================================== --}}

                            <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $category->id }}"
                            >
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>

                    </td>

                </tr>

                {{-- ===================================== --}}
                {{-- CHALLENGE #7                         --}}
                {{-- Bootstrap Modal Delete               --}}
                {{-- ===================================== --}}

                <div
                    class="modal fade"
                    id="deleteModal{{ $category->id }}"
                    tabindex="-1"
                >
                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title">
                                    Konfirmasi Hapus
                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                ></button>

                            </div>

                            <div class="modal-body">

                                Apakah Anda yakin ingin menghapus kategori:

                                <strong>
                                    {{ $category->name }}
                                </strong> ?

                            </div>

                            <div class="modal-footer">

                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Batal
                                </button>

                                <form
                                    action="{{ route('categories.destroy', $category) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >
                                        Ya, Hapus
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>

            @empty

                <tr>
                    <td
                        colspan="6"
                        class="text-center py-5 text-muted"
                    >
                        Tidak ada data kategori.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="card-footer bg-white">

    {{ $categories->links('pagination::bootstrap-5') }}

</div>
```

</div>

@endsection
