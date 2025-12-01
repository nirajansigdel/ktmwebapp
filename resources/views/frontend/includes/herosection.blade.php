
<style>
    /* Modal watermark - custom style needed */
    .modal-content {
        position: relative;
    }

    .modal-content::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url("image/logo.png") no-repeat center center;
        background-size: 100%;
        opacity: 0.3;
        z-index: -1;
        pointer-events: none;
    }

    @media print {
        .print-company-info {
            display: block !important;
        }
        .print-hide {
            display: none !important;
        }
    }

    /* Typing effect cursor */
    #typingText {
        border-right: 4px solid rgba(255, 255, 255, 0.8);
        white-space: nowrap;
        overflow: hidden;
    }

    /* Image grid with skew effect - custom style needed */
    .image-box {
        transform: skew(-20deg);
        overflow: hidden;
        border: 2px solid rgba(255, 255, 255, 0.15);
        transition: transform 0.4s ease, border-color 0.4s ease;
    }

    .image-box:hover {
        transform: skew(-21deg) scale(1.05);
        border-color: white;
    }
</style>



<!-- HERO CAROUSEL -->
<div id="heroSlider" class="carousel slide" data-bs-ride="carousel">

    <!-- SLIDES -->
            <div class="carousel-inner">
        @foreach ($coverimages as $key => $img)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset('uploads/coverimage/' . $img->image) }}" 
                     class="d-block w-100" 
                     style="height: 100vh; object-fit: cover; filter: brightness(55%);"
                     alt="Hero Image {{ $key + 1 }}">
            </div>
        @endforeach
    </div>

    <!-- INDICATORS -->
    <div class="carousel-indicators">
        @foreach ($coverimages as $key => $img)
            <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{{ $key }}"
                class="{{ $key == 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>

    <!-- OVERLAY CONTENT -->
    <div class="position-absolute top-50 start-50 translate-middle w-100 text-white">
        <div class="container">
            <div class="row align-items-center g-4 d-flex justify-content-between">

                <!-- LEFT SECTION -->
                <div class="col-lg-5 col-md-4">
                    <h1 class="fw-bold display-4 mb-3">
                        <span id="typingText"></span>
                    </h1>

                    <p class="mb-4 fs-4">
                        Want to send important parcels to your loved ones with complete safety, speed, and reliability?
                        We make sure your package reaches them on time, every time—handled with care from start to finish.
                    </p>

                    <div class="bg-dark bg-opacity-50 p-4 rounded shadow-lg">
                        <h6 class="text-uppercase fw-bold mb-3">Enter Your Tracking Number</h6>

                        <form id="track-form">
                            @csrf
                            <div class="input-group input-group-lg">
                                <input type="text" id="tracking_number" name="tracking_number"
                                    class="form-control" placeholder="Enter Your Tracking Number" required>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search me-2"></i>Track
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- RIGHT SECTION -->
                @php
                    $sixImages = collect();
                    foreach ($images as $image) {
                        foreach ($image->img as $url) {
                            if ($sixImages->count() < 6) {
                                $sixImages->push($url);
                            }
                        }
                        if ($sixImages->count() >= 6) break;
                    }
                @endphp

                <div class="col-lg-6 col-md-7">
                    <div class="row g-2">
                        @foreach ($sixImages as $url)
                            <div class="col-4">
                                <div class="image-box rounded-3 w-80"
                                     style="background-image: url('{{ asset($url) }}'); 
                                            background-size: cover;
                                            background-position: center;
                                            height: 180px; width: 80%;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- TRACKING MODAL -->
<div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trackingModalLabel">Parcel Tracking Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Error Message -->
                <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                
                <!-- Company Info for Print -->
                <div id="company-info-print" class="print-company-info d-none">
                    <h3>KTM Nepal Logistic</h3>
                    <p>Parcel Tracking Information</p>
                </div>
                
                <!-- Barcode -->
                <div class="text-center mb-3">
                    <img id="barcode" src="" alt="Barcode" class="img-fluid d-none" style="max-width: 200px;">
                </div>
                
                <!-- Loading Spinner -->
                <div id="tracking-loading" class="text-center d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Tracking your parcel...</p>
                </div>
                
                <!-- Tracking Result -->
                <div id="tracking-result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="print-btn">Print</button>
            </div>
        </div>
    </div>
</div>

<!-- TYPING EFFECT JS -->
<script>
    const text = "KTM Nepal Logistic";
    let i = 0;

    function typeEffect() {
        if (i < text.length) {
            document.getElementById("typingText").innerHTML += text.charAt(i);
            i++;
            setTimeout(typeEffect, 90);
        }
    }

    document.addEventListener("DOMContentLoaded", typeEffect);
</script>





<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        const trackForm = document.getElementById('track-form');
        if (!trackForm) {
            console.error('Track form not found');
            return;
        }

        trackForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const resultDiv = document.getElementById('tracking-result');
            const errorDiv = document.getElementById('error-message');
            const barcodeImg = document.getElementById('barcode');

            // Clear previous results and show loading
            const loadingDiv = document.getElementById('tracking-loading');
            if (resultDiv) resultDiv.innerHTML = '';
            if (errorDiv) {
                errorDiv.textContent = '';
                errorDiv.classList.add('d-none');
            }
            if (barcodeImg) {
                barcodeImg.classList.add('d-none');
                barcodeImg.src = '';
            }
            if (loadingDiv) {
                loadingDiv.classList.remove('d-none');
            }

            fetch('{{ route('track-parcel') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response Data:', data);

                    const trackingModalElement = document.getElementById('trackingModal');
                    if (!trackingModalElement) {
                        console.error('Tracking modal not found');
                        alert('Tracking modal not found. Please refresh the page.');
                        return;
                    }

                    const trackingModal = new bootstrap.Modal(trackingModalElement);
                    
                    // Hide loading
                    if (loadingDiv) loadingDiv.classList.add('d-none');

                    if (data.error) {
                        if (resultDiv) resultDiv.innerHTML = '';
                        if (errorDiv) {
                            errorDiv.textContent = data.error;
                            errorDiv.classList.remove('d-none');
                        }
                        trackingModal.show();
                    } else if (data.trackingInfo) {
                        if (errorDiv) errorDiv.classList.add('d-none');
                        if (resultDiv) {
                            resultDiv.innerHTML = formatTrackingData(data.trackingInfo);
                        }
                        if (data.trackingInfo.parcel && data.trackingInfo.parcel.barcode_image && barcodeImg) {
                            barcodeImg.src = `data:image/png;base64,${data.trackingInfo.parcel.barcode_image}`;
                            barcodeImg.classList.remove('d-none');
                        }
                        trackingModal.show();
                    } else {
                        if (errorDiv) {
                            errorDiv.textContent = 'No tracking information found.';
                            errorDiv.classList.remove('d-none');
                        }
                        trackingModal.show();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (loadingDiv) loadingDiv.classList.add('d-none');
                    if (resultDiv) resultDiv.innerHTML = '';
                    if (errorDiv) {
                        errorDiv.textContent = 'An error occurred while tracking the parcel. Please try again.';
                        errorDiv.classList.remove('d-none');
                    }
                    const trackingModalElement = document.getElementById('trackingModal');
                    if (trackingModalElement) {
                        const trackingModal = new bootstrap.Modal(trackingModalElement);
                        trackingModal.show();
                    } else {
                        alert('An error occurred while tracking the parcel. Please refresh the page.');
                    }
                });
        });
    });

    // Print button event listener
    document.addEventListener('DOMContentLoaded', function() {
        const printBtn = document.getElementById('print-btn');
        if (printBtn) {
            printBtn.addEventListener('click', function () {
        const printWindow = window.open('', '', 'height=600,width=800');

        const companyInfo = document.getElementById('company-info-print').cloneNode(true);
        const barcode = document.getElementById('barcode').cloneNode(true);
        const trackingInfo = document.getElementById('tracking-result').cloneNode(true);

        const printContainer = document.createElement('div');
        printContainer.style.padding = '20px';

        printContainer.appendChild(companyInfo);
        printContainer.appendChild(document.createElement('hr'));
        printContainer.appendChild(barcode);
        printContainer.appendChild(trackingInfo);

        printWindow.document.write('<html><head><title>Print Tracking Information</title>');
        printWindow.document.write(
            '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" />'
        );
        printWindow.document.write('<style>' +
            '.transparent-table { width: 100%; border-collapse: collapse; } ' +
            '.transparent-table th, .transparent-table td { border: 1px solid #ddd; padding: 8px; text-align: left; } ' +
            '.transparent-table th { padding-top: 12px; padding-bottom: 12px; } ' +
            'hr { margin: 20px 0; }' +
            '@media print { .col-md-6 { float: left; width: 48%; margin-right: 2%; } .col-md-6:last-child { margin-right: 0; } }' +
            '</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(printContainer.innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();

        printWindow.onload = function () {
            setTimeout(function () {
                printWindow.print();
            }, 500);
        };
            });
        }
    });

    function formatTrackingData(data) {
        let html = '';
        if (typeof data === 'object' && data !== null) {
            html += '<div class="row">';

            if (data.receiver) {
                html += `
                    <div class="col-md-6 mb-4">
                        <h3 class="mb-3 text-primary">
                            <i class="fas fa-user me-2"></i>Receiver Information
                        </h3>
                        ${formatReceiverTable(data.receiver)}
                    </div>
                `;
            }

            if (data.parcel) {
                html += `
                    <div class="col-md-6 mb-4">
                        <h3 class="mb-3 text-primary">
                            <i class="fas fa-box me-2"></i>Parcel Information
                        </h3>
                        ${formatParcelTable(data.parcel)}
                    </div>
                `;
            }

            html += '</div>'; // close row

            if (data.tracking_updates && data.tracking_updates.length > 0) {
                html += `
                    <div class="col-12 mt-4">
                        <h3 class="mb-3 text-primary">
                            <i class="fas fa-route me-2"></i>Tracking Updates
                        </h3>
                        ${formatTrackingUpdatesTable(data.tracking_updates)}
                    </div>
                `;
            }
        }
        return html;
    }

    function formatParcelTable(parcel) {
        let forwardingNumberRow = '';

        if (parcel.forwarder_number && parcel.forwarder_number.trim() !== '') {
            forwardingNumberRow = `
                <tr>
                    <th class="bg-light">Forwarding Number</th>
                    <td>${parcel.forwarder_number}</td>
                </tr>
            `;
        }

        return `
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th class="bg-light w-50">HAWB</th>
                        <td>${parcel.tracking_number || 'N/A'}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Carrier</th>
                        <td>${parcel.carrier || 'N/A'}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Dispatched Date</th>
                        <td>${formatDate(parcel.sending_date) || 'N/A'}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Weight</th>
                        <td>${parcel.weight || 'N/A'}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Estimated Delivery</th>
                        <td>${formatDate(parcel.estimated_delivery_date) || 'N/A'}</td>
                    </tr>
                    ${forwardingNumberRow}
                </tbody>
            </table>
        `;
    }

    function formatReceiverTable(receiver) {
        return `
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th class="bg-light w-50">Name</th>
                        <td>${receiver.fullname || 'N/A'}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Address</th>
                        <td>
                            ${receiver.street_address || ''}${receiver.street_address ? ',<br>' : ''}
                            ${receiver.city || ''}${receiver.city ? ', ' : ''}
                            ${receiver.state || ''}${receiver.state ? ', ' : ''}
                            ${receiver.country || 'N/A'}
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Postal Code</th>
                        <td>${receiver.postal_code || 'N/A'}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Phone No.</th>
                        <td>${receiver.phone_no || 'N/A'}</td>
                    </tr>
                </tbody>
            </table>
        `;
    }

    function formatTrackingUpdatesTable(trackingUpdates) {
        if (!trackingUpdates || trackingUpdates.length === 0) {
            return '<p class="text-muted">No tracking updates available.</p>';
        }
        
        return `
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Location</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${trackingUpdates.map(update => `
                            <tr>
                                <td>${formatDate(update.updated_at) || 'N/A'}</td>
                                <td><span class="badge bg-info">${update.status || 'N/A'}</span></td>
                                <td>${update.location || 'N/A'}</td>
                                <td>${update.notes || 'N/A'}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        `;
    }

    function formatDate(dateString) {
        if (!dateString) return '';
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString(undefined, options);
    }
</script>
