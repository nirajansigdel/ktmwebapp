<style>
    .vision-mission-section {
background-image: url('{{ asset('image/convo.jpg') }}'); !important;/* replace with your image path */
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    padding: 120px 0;
    position: relative;
    color: white;
    height: auto;
}

/* dark overlay exactly like screenshot */
.vision-mission-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.65);
    z-index: 1;
}

.vision-mission-section .container {
    position: relative;
    z-index: 2;
}

/* Title Styling Like Screenshot */
.vm-title {
    font-size: 58px;
    font-weight: 700;
    letter-spacing: 2px;
}

/* Paragraph Styling */
.vm-text {
    max-width: 950px;
    margin: 0 auto;
    font-size: 22px;
    line-height: 1.6;
}

</style>
<section class="vision-mission-section d-flex align-items-center text-center">
    <div class="container">
        
        <!-- Vision -->
        <h1 class="vm-title">VISION</h1>
        <p class="vm-text">
            To be the trusted partner for building resilient, ethical, and high-performing organizations 
            by transforming Employee Relations, Human Resources and Leadership across global growth markets.
        </p>

        <!-- Mission -->
        <h1 class="vm-title mt-5">MISSION</h1>
        <p class="vm-text">
            We provide integrated, strategy-led solutions that harmonize global best practices with local market 
            realities. We empower leaders to navigate cross-border complexity, mitigate systemic risk, and 
            cultivate agile workplace cultures that drive sustainable growth.
        </p>

    </div>
</section>
