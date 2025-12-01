
@section('content')
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
    <style>
        .form-group {
            padding-bottom: 7px
        }

        .message-box {
            margin-bottom: 7px;
        }
    </style>

    <div class="background">
        <h1 class="page_title">{{ __('Contact Us') }}</h1>
    </div>

    <section class="contact_form">
        <div class="container">

            <div class="row mt-3">
                {{-- <div class="col-md-6 cform_left">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d113044.53605690929!2d85.26660755724599!3d27.697465314449445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d27.6986812!2d85.34900499999999!4m5!1s0x39eb19c077e257b1%3A0xe92e2047692bea14!2sShree%20Binayak%20Marg%209%2C%20Kathmandu%2044600!3m2!1d27.6975294!2d85.34893389999999!5e0!3m2!1sen!2snp!4v1703018704663!5m2!1sen!2snp"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div> --}}
                <div class="col-md-6 cform_left">
                    <iframe src="{{ $googleMapsLink }}" width="100%" height="450" style="border:0;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="col-md-6 cform_right">
                    <form id="quick_contact" class="form-horizontal" method="POST" role="form"
                        action="{{ route('Contact.store') }}" method="POST">


                        @csrf
                        <div class="form-group">

                            <input type="text" class="form-control" id="name" placeholder="NAME" name="name"
                                value="" required>

                        </div>


                        <div class="form-group">

                            <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email"
                                value="" required>

                        </div>



                        <div class="form-group">


                            <input type="phone" name="phone_no" class="form-control" id="phone_no"
                                placeholder="Phone No." required>


                        </div>



                        <textarea class="form-control message-box" rows="10" placeholder="MESSAGE" name="message" required></textarea>




                        <!-- Add reCAPTCHA field -->
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>




                        <input type="submit" value="Submit" id="submitBtn" class="btn bg-primary text-white mb-3">
                    </form>
                </div>
                {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                {{-- <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('quick_contact').addEventListener('submit', function(event) {
                            event.preventDefault();

                            // Disable submit button to prevent multiple clicks
                            document.getElementById('submitBtn').disabled = true;

                            grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                                action: 'submit'
                            }).then(function(token) {
                                document.getElementById('g-recaptcha-response').value = token;
                                var formData = new FormData(document.getElementById('quick_contact'));

                                fetch('{{ route('Contact.store') }}', {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'Accept': 'application/json',
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            console.log('Form submitted successfully!');
                                            document.getElementById('successMessage').innerText =
                                                'Form submitted successfully!';
                                        } else {
                                            console.error(data.error);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    })
                                    .finally(() => {
                                        // Reset the form
                                        document.getElementById('quick_contact').reset();

                                        // Reset reCAPTCHA
                                        grecaptcha.reset();

                                        // Enable submit button
                                        document.getElementById('submitBtn').disabled = false;
                                    });
                            });
                        });
                    });
                </script> --}}

            </div>
    </section>

