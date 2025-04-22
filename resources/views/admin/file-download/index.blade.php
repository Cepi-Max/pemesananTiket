@extends('admin.layouts.main.app')

@section('content')
            <div class="form-container">
                <div class="form-title d-flex justify-content-between align-items-center border-bottom pb-2 mb-3 text-dark">
                    <span>File yg dapat didownload</span>
                </div>
                
                <form action="{{ $DownloadAbleFile ? route('downloadfile.update', $DownloadAbleFile->id) : route('DownloadAbleFile.save') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                
                    @php
                        use Illuminate\Support\Facades\Storage;
                        $files = [
                            'jadwal_penerbangan' => 'files/DownloadAbleFile/' . $DownloadAbleFile->jadwal_penerbangan,
                            'brosur_pariwisata' => 'files/DownloadAbleFile/' . $DownloadAbleFile->brosur_pariwisata,
                            'syarat_ketentuan' => 'files/DownloadAbleFile/' . $DownloadAbleFile->syarat_ketentuan
                        ];
                
                        $fileExists = [];
                        foreach ($files as $key => $filePath) {
                            $fileExists[$key] = Storage::disk('public')->exists($filePath);
                        }
                    @endphp
                
                    @foreach ($files as $fileInputName => $filePath)
                        <div class="col-12">
                            <label class="form-label fw-semibold">File {{ ucwords(str_replace('_', ' ', $fileInputName)) }} (PDF)</label><br>
                            @if($fileExists[$fileInputName])
                                <a href="{{ route('downloadfile.preview', $fileInputName) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Preview
                                </a>
                                <a href="{{ route('downloadfile.download', $fileInputName) }}" class="btn btn-success btn-sm">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            @endif
                            <input type="file" name="{{ $fileInputName }}" class="form-control @error($fileInputName) is-invalid @enderror">
                            @error($fileInputName)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-dark">Simpan</button>
                    </div>
                </form>
                
            </div>

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
@endsection

