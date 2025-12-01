
    <style>
        .modal-header .company-info {
            position: absolute;
            top: 0;
            left: 0;
            margin: 10px;
        }
        .barcode {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        @media print {
            .print-company-info {
                display: block;
                text-align: center;
                margin-bottom: 20px;
            }
            .print-hide {
                display: none;
            }
        }
    </style>

        <div class="container">
            <div class="d-flex justify-content-center mt-2 mb-2">
                <form id="track-form">
                    @csrf
                    <div class="form-group d-flex align-items-center">
                        <label for="tracking_number" class="me-2"><b>Track Parcel:</b></label>
                        <input type="text" class="form-control w-50 me-2" id="tracking_number" name="tracking_number" required>
                        <button type="submit" class="btn btn-primary">Track</button>
                    </div>
                </form>
            </div>
            
            
            

     