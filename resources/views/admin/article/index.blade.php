@extends('admin.layouts.main.app')

@section('content')
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-2 mt-3">
                            <a href="{{ route('show.article.form') }}" class="btn btn-dark btn-sm d-flex align-items-center justify-content-center w-80">
                                <span>Tambah</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <form action="#">
                                @foreach (['category', 'author'] as $filter)
                                    @if (request($filter))
                                        <input type="hidden" name="{{ $filter }}" value="{{ request($filter) }}">
                                    @endif
                                @endforeach
                                <div class="search-container">
                                    <input type="text" class="search-input" placeholder="cari informasi" id="search" name="search" required autocomplete="off">
                                    <button class="search-button" type="submit">
                                        <i class="fas fa-search"></i>
                                        <span>Cari</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabel Desktop -->
            <div class="card shadow d-none d-md-block">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">Daftar informasi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                @if ($articles->isNotEmpty())
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 37%">Judul</th>
                                        <th style="width: 15%">Kategori</th>
                                        <th style="width: 15%">Tgl. Posting</th>
                                        <th style="width: 12%">Admin</th>
                                        <th style="width: 16%">Aksi</th>
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                <?php $i = 1 ; ?>
                                @forelse ($articles as $article)
                                    <tr>
                                        <td class="align-middle"><?= $i++; ?></td>
                                        <td class="align-middle"><b>{{ \Illuminate\Support\Str::limit($article->title, 30) }}</b></td>
                                        <td class="align-middle bg-{{ $article->article_category->color }}">
                                            <a href="/admin/info-list?category={{ $article->article_category->slug }}">
                                                @if (isset($article->article_category->name))
                                                {{ $article->article_category->name }}
                                                @else
                                                    <span class="text-muted">kategori tidak ditemukan</span>
                                                @endif
                                                
                                            </a>
                                        </td>
                                        <td class="align-middle"><?= (new DateTime($article->created_at))->format('d F Y'); ?></td>
                                        <td class="align-middle">
                                            <a href="/admin/info-list?admin={{ $article->author->name }}">
                                                {{ $article->author->name }}
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <a href="{{ route('show.article.form', $article->slug) }}" class="btn btn-warning btn-sm" title="Edit informasi" data-bs-toggle="tooltip">
                                                    <i class="fas fa-edit"></i>
                                                </a> | <form id="form-delete-{{ $article->slug }}" action="{{ route('article.delete', $article->slug) }}" method="POST" class="d-inline">
                                                        @csrf 
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="button" class="btn-delete btn btn-danger btn-sm" title="Hapus informasi" data-bs-toggle="tooltip" data-id="{{ $article->slug }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <div class="col-12 text-center py-5">
                                            <i class="material-symbols-rounded text-muted mb-3 fs-1">article</i>
                                            <p class="mb-0 text-muted">Tidak ada informasi ditemukan.</p>
                                        </div>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                    {{ $articles->links() }}
            </div>
@endsection