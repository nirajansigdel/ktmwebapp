@extends('backend.layouts.master')


@section('content')
    <!-- Content Wrapper. Contains page content -->


    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif



    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    Back</button></a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.cover-images.store') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="title" class="form-control" id="title"
                    value="{{ old('title') }}" placeholder="Title">
            </div>

            <div class="form-group">
                <label for="image">Images (You can select multiple images at once)</label><span style="color:red; font-size:large"> *</span>
                <input type="file" name="images[]" class="form-control" id="image" multiple accept="image/*" onchange="previewImages(event)"
                    placeholder="image" required>
                <small class="form-text text-muted">You can select multiple images by holding Ctrl (Windows) or Cmd (Mac) while clicking, or drag and select multiple files.</small>
            </div>
            <div id="file-count" class="mt-2 text-info"></div>
            <div id="preview-container" class="row g-3 mt-3"></div>



        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>








    <script>
        const previewImages = e => {
            const container = document.getElementById('preview-container');
            const fileCountDiv = document.getElementById('file-count');
            
            container.innerHTML = ''; // Clear previous previews
            
            const files = e.target.files;
            const fileCount = files.length;
            
            // Update file count display
            if (fileCount > 0) {
                fileCountDiv.innerHTML = `<strong class="text-primary"><i class="fas fa-images"></i> ${fileCount} image(s) selected</strong>`;
            } else {
                fileCountDiv.innerHTML = '';
            }
            
            // Validate file sizes and preview
            let validFiles = 0;
            let invalidFiles = [];
            const maxSize = 1536 * 1024; // 1536KB = 1.5MB (matches controller validation)
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileSizeInMB = file.size / (1024 * 1024);
                
                // Check file size
                if (file.size > maxSize) {
                    invalidFiles.push(`"${file.name}" (${fileSizeInMB.toFixed(2)}MB - exceeds 1.5MB limit)`);
                    continue;
                }
                
                // Check file type
                if (!file.type.startsWith('image/')) {
                    invalidFiles.push(`"${file.name}" (not an image file)`);
                    continue;
                }
                
                validFiles++;
                
                // Create preview card using Bootstrap grid
                const fileIndex = i;
                const reader = new FileReader();
                reader.onload = (event) => {
                    // Create Bootstrap column
                    const col = document.createElement('div');
                    col.className = 'col-md-3 col-sm-4 col-6';
                    
                    // Create card wrapper
                    const card = document.createElement('div');
                    card.className = 'preview-card';
                    
                    // Image wrapper
                    const imgWrapper = document.createElement('div');
                    imgWrapper.className = 'preview-image-wrapper';
                    
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.className = 'preview-image';
                    img.alt = file.name;
                    
                    // Image number badge
                    const badge = document.createElement('span');
                    badge.className = 'badge bg-primary position-absolute top-0 start-0 m-2';
                    badge.textContent = (fileIndex + 1);
                    
                    // File info overlay
                    const overlay = document.createElement('div');
                    overlay.className = 'preview-overlay';
                    overlay.innerHTML = `
                        <div class="preview-info">
                            <small class="text-white d-block" style="font-size: 0.7rem; word-break: break-all;">${file.name.length > 25 ? file.name.substring(0, 25) + '...' : file.name}</small>
                            <small class="text-white">${(file.size / 1024).toFixed(2)} KB</small>
                        </div>
                    `;
                    
                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(badge);
                    imgWrapper.appendChild(overlay);
                    card.appendChild(imgWrapper);
                    col.appendChild(card);
                    container.appendChild(col);
                };
                reader.readAsDataURL(file);
            }
            
            // Show validation summary
            if (invalidFiles.length > 0) {
                fileCountDiv.innerHTML += ` <span class="text-danger">(${validFiles} valid, ${invalidFiles.length} invalid)</span>`;
                alert('Some files were invalid:\n' + invalidFiles.join('\n'));
            }
        };
        
        // Form validation before submit
        document.getElementById('quickForm').addEventListener('submit', function(e) {
            const input = document.getElementById('image');
            const files = input.files;
            const maxSize = 1536 * 1024; // 1536KB = 1.5MB
            
            if (files.length === 0) {
                e.preventDefault();
                alert('Please select at least one image.');
                return false;
            }
            
            // Validate all files
            let hasError = false;
            let errorMessages = [];
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileSizeInMB = file.size / (1024 * 1024);
                
                if (file.size > maxSize) {
                    hasError = true;
                    errorMessages.push(`"${file.name}" is ${fileSizeInMB.toFixed(2)}MB (max 1.5MB)`);
                }
                
                if (!file.type.startsWith('image/')) {
                    hasError = true;
                    errorMessages.push(`"${file.name}" is not a valid image file`);
                }
            }
            
            if (hasError) {
                e.preventDefault();
                alert('Please fix the following errors:\n\n' + errorMessages.join('\n'));
                return false;
            }
            
            return true;
        });
    </script>
    
    <style>
        .preview-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
            margin-bottom: 1rem;
        }
        
        .preview-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .preview-image-wrapper {
            position: relative;
            width: 100%;
            padding-top: 100%; /* 1:1 Aspect Ratio */
            overflow: hidden;
            background: #f8f9fa;
        }
        
        .preview-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .preview-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 10px;
        }
        
        .preview-card:hover .preview-overlay {
            opacity: 1;
        }
        
        .preview-info {
            width: 100%;
        }
        
        .preview-info small {
            display: block;
        }
        
        #preview-container {
            min-height: 150px;
        }
        
        #preview-container:empty::before {
            content: 'No images selected. Preview will appear here after selecting images.';
            color: #6c757d;
            display: block;
            text-align: center;
            padding: 40px 20px;
            font-style: italic;
        }
        
        #file-count {
            font-weight: 500;
        }
    </style>
@stop
