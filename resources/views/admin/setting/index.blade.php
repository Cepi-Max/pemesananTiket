@extends('admin.layouts.main.app')

@section('title', 'Halaman Utama')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="form-container container">
  <div class="form-title d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
      <span>Pengaturan Banner</span>
  </div>
  <form action="{{ $bannerImg ?  route('bannerSettingUpdate', $bannerImg->id) : route('bannerSettingSave') }}" method="post" enctype="multipart/form-data">
      @csrf
      @php
          $imagePath1 = $bannerImg && $bannerImg->image1 
              ? asset('storage/images/general/bannerImg/' . $bannerImg->image1) 
              : asset('storage/images/general/bannerImg/default.svg');
          $imagePath2 = $bannerImg && $bannerImg->image2 
              ? asset('storage/images/general/bannerImg/' . $bannerImg->image2) 
              : asset('storage/images/general/bannerImg/default.svg');
          $imagePath3 = $bannerImg && $bannerImg->image3 
              ? asset('storage/images/general/bannerImg/' . $bannerImg->image3) 
              : asset('storage/images/general/bannerImg/default.svg');
      @endphp
      <div class="inputan d-flex justify-content-between">
          <div class="col-md-4">
              <div class="mb-3 w-90">
                  <label for="image1" class="form-label">Gambar banner pertama</label>
                  <input type="file" class="form-control @error('image1') is-invalid @enderror" id="preview_image1" name="image1">
                  @error('image1')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
              </div>
              <div class="image-preview w-90" id="imagePreview1">
                  <img src="{{ $imagePath1 }}" alt="Image Preview" id="imagePreviewImg1" style="{{ $bannerImg ? 'display: block;' : 'display: none;' }}"> 
              </div>
          </div>
          <div class="col-md-4">
              <div class="mb-3 w-90">
                  <label for="image2" class="form-label">Gambar banner kedua</label>
                  <input type="file" class="form-control @error('image2') is-invalid @enderror" id="preview_image2" name="image2">
                  @error('image2')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
              </div>
              <div class="image-preview w-90" id="imagePreview2">
                  <img src="{{ $imagePath2 }}" alt="Image Preview" id="imagePreviewImg2" style="{{ $bannerImg ? 'display: block;' : 'display: none;' }}"> 
              </div>
          </div>
          <div class="col-md-4">
              <div class="mb-3 w-90">
                  <label for="image3" class="form-label">Gambar banner ketiga</label>
                  <input type="file" class="form-control @error('image3') is-invalid @enderror" id="preview_image3" name="image3">
                  @error('image3')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
              </div>
              <div class="image-preview w-90" id="imagePreview3">
                  <img src="{{ $imagePath3 }}" alt="Image Preview" id="imagePreviewImg3" style="{{ $bannerImg ? 'display: block;' : 'display: none;' }}"> 
              </div>
          </div>
      </div>
      <div class="d-flex justify-content-between mt-3">
          
          <button type="submit" class="btn btn-dark">Simpan</button>
      </div>
  </form>
</div>

<script>
    document.querySelectorAll('input[type="file"]').forEach(function (input) {
        input.addEventListener('change', function () {
            const file = this.files[0];
            const imgPreview = document.getElementById(
                'imagePreviewImg' + this.id.replace('preview_image', '')
            );

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imgPreview.style.display = 'none';
                imgPreview.src = '';
            }
        });
    });
</script>

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
        width: 200px;
        height: 200px;
        border: 2px dashed #ddd;
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
    }
</style>

@endsection