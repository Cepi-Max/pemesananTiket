<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- bootstrap icon 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">-->
    <!-- CDN Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('admin/assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
    <!-- style.css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- include summernote css/js-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: #f8f9fa;
    }
    .form-container {
        max-width: 1500px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }
    .form-title {
        font-size: 24px;
        font-weight: 500;
        margin-bottom: 20px;
    }
    .form-label {
        font-size: 16px;
        margin-bottom: 5px;
    }
    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
    .custom-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 12px 12px;
        padding-right: 2rem !important;
    }
    .custom-select::-ms-expand {
        display: none;
    }
    .custom-textarea {
        height: 470px; /* Atur tinggi sesuai kebutuhan */
        min-height: 150px; /* Tinggi minimum */
    }

    .image-preview {
        max-width: 400px;
        max-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        overflow: hidden;
        background-color: #f9f9f9;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }
    input::placeholder {
        font-style: italic;
    }
    textarea::placeholder {
        font-style: italic;
    }
    .image-preview:hover .overlay {
        opacity: 1 !important;
    }
</style>

<body>
    @include('admin.layouts.main.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <div class="container-fluid py-2">

            <div class="form-container">
                <div class="form-title d-flex justify-content-between align-items-center border-bottom pb-2 mb-3 text-dark">
                    <span>PPID Desa Pemali</span>
                </div>
                
                <form action="{{ $ppid ?  route('ppid.update', $ppid->id) : route('ppid.save') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    @method('PUT')
            
                    <div class="col-12">
                        <label class="form-label fw-semibold">Profil PPID</label>
                        <textarea name="profil" class="visi-misi-sejarah-desa-ppid-summernote form-control" rows="4">{{ old('profil', $ppid->profil) }}</textarea>
                    </div>
            
                    <div class="col-12">
                        <label class="form-label fw-semibold">Visi dan Misi</label>
                        <textarea name="visi_misi" class="visi-misi-sejarah-desa-ppid-summernote form-control @error('visi_misi') is-invalid @enderror" rows="4">{{ old('visi_misi', $ppid->visi_misi) }}</textarea>
                        @error('visi_misi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-12">
                        @php
                            $imagePath = $ppid &&  $ppid->gambar_struktur_organisasi 
                                ? asset('storage/images/publicImg/ppid/ppidImg/' . $ppid->gambar_struktur_organisasi) 
                                : asset('storage/images/publicImg/ppid/ppidImg/default.png');
                        @endphp
                        <label class="form-label fw-semibold">Struktur Organisasi (Gambar)</label><br>
                        <input type="file" name="gambar_struktur_organisasi" id="preview_image" class="form-control mb-2 @error('gambar_struktur_organisasi') is-invalid @enderror" style="display: none;">
                        
                        <div class="position-relative image-preview" style="cursor: pointer;" id="imagePreview">
                            <img src="{{ $imagePath }}" alt="" id="imagePreviewImg" class="img-fluid rounded" style="{{ $ppid ? 'display: block;' : 'display: none;' }} max-width: 400px;" title="Klik untuk ganti gambar">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-50 text-white opacity-0"
                                        style="border-radius: 0.375rem; transition: 0.3s;">
                                <i class="material-symbols-rounded text-muted mb-3 fs-1">edit</i></i>
                                <small>Klik untuk ganti gambar</small>
                            </div>
                        </div>
                        @error('gambar_struktur_organisasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
            
                    <div class="col-12">
                        <label class="form-label fw-semibold">File Regulasi (PDF)</label><br>
                        @php
                            use Illuminate\Support\Facades\Storage;
                        
                            $filePath = 'pdf/ppid/' . $ppid->file_regulasi;
                            $fileExists = Storage::disk('public')->exists($filePath);
                        @endphp
                        
                        @if($fileExists)
                            <a href="{{ route('ppid.preview', $ppid->id) }}" target="_blank" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Preview
                            </a>
                            <a href="{{ route('ppid.download', $ppid->id) }}" class="btn btn-success btn-sm">
                                <i class="bi bi-download"></i> Download
                            </a>
                        @else
                            {{-- <small>masukkan file!</small> --}}
                        @endif
                        <input type="file" name="file_regulasi" class="form-control @error('file_regulasi') is-invalid @enderror">
                        @error('file_regulasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-12">
                        <label class="form-label fw-semibold">Regulasi PPID</label><br>
                        <textarea name="regulasi_ppid" class="visi-misi-sejarah-desa-ppid-summernote form-control @error('regulasi_ppid') is-invalid @enderror" rows="4">{{ old('regulasi_ppid', $ppid->regulasi_ppid) }}</textarea>
                        @error('regulasi_ppid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-12">
                        <label class="form-label fw-semibold">Maklumat Pelayanan</label>
                        <textarea name="maklumat" class="visi-misi-sejarah-desa-ppid-summernote form-control @error('maklumat') is-invalid @enderror" rows="4">{{ old('maklumat', $ppid->maklumat) }}</textarea>
                        @error('maklumat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-12">
                        <label class="form-label fw-semibold">Alamat PPID</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat', $ppid->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kontak PPID</label>
                        <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror" value="{{ old('kontak', $ppid->kontak) }}">
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="aktif" {{ $ppid->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ $ppid->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-dark">Simpan</button>
                    </div>
                </form>
            </div>

        </div>

    </main>
</body>

<!-- Core JS yang aman -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- Summernote dan jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Select the input and preview elements
    const fileInput = document.getElementById('preview_image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('imagePreviewImg');

    // Triger input gambar-sejarah
    document.getElementById('imagePreview').addEventListener('click', function () {
        document.getElementById('preview_image').click();
    });
    // Add event listener for file input
    fileInput.addEventListener('change', function () {
        const file = this.files[0]; // Get the selected file

        if (file) {
            const reader = new FileReader();

            // Load the file and set the image source
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block'; // Show the image
            };

            reader.readAsDataURL(file); // Read the file as a Data URL
        } else {
            // If no file is selected, hide the image
            previewImg.style.display = 'none';
            previewImg.src = '';
        }
    });
</script>
</html>

