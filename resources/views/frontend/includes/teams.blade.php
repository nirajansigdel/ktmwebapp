
 <style>

/* Card wrapper */
.sectionbox-card {
  position: relative;
  border-radius: 1rem;
  overflow: hidden;
  background-color: #fff;
  box-shadow: 0 10px 24px rgba(16, 24, 40, 0.08);
  transition: transform 0.45s ease, box-shadow 0.45s ease;
}

.sectionbox-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 32px rgba(16, 24, 40, 0.14);
}

/* Image */
.sectionbox-image {
  position: relative;
}

.sectionbox-image img {
  width: 100%;
  height: 320px;
  object-fit: cover;
  display: block;
  transition: transform 1.1s cubic-bezier(0.22, 0.61, 0.36, 1);
}

.sectionbox-card:hover .sectionbox-image img {
  transform: scale(1.05);
}

.sectionbox-image::after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(2, 6, 23, 0.85) 0%,
    rgba(2, 6, 23, 0.5) 45%,
    rgba(2, 6, 23, 0.0) 75%
  );
  pointer-events: none;
  transition: opacity 0.6s ease;
}

.sectionbox-card:hover .sectionbox-image::after {
  opacity: 0.95;
}

/* Badge */
.sectionbox-badge {
  position: absolute;
  top: 12px;
  left: 12px;
  background: rgba(255, 255, 255, 0.9);
  color: #0f172a;
  padding: 0.25rem 0.6rem;
  border-radius: 999px;
  font-size: 0.75rem;
  font-weight: 700;
}

/* Content */
.sectionbox-content {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  padding: 1rem 1.25rem 1.25rem;
  color: #ffffff;
  transform: translateY(10px);
  transition: 0.6s cubic-bezier(0.22, 0.61, 0.36, 1);
}

.sectionbox-card:hover .sectionbox-content {
  transform: translateY(0);
}

/* Title */
.sectionbox-title {
  margin-bottom: 0.25rem;
  font-weight: 700;
  font-size: 1.125rem;
  line-height: 1.3;
}

/* Description */
.sectionbox-desc {
  font-size: 0.9rem;
  opacity: 0.9;
  margin-bottom: 0.75rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Button CTA */
.sectionbox-cta {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background-color: rgba(255, 255, 255, 0.9);
  color: #0f172a;
  padding: 0.5rem 0.75rem;
  border-radius: 999px;
  font-weight: 700;
  font-size: 0.875rem;
  text-decoration: none;
  transition: 0.3s ease;
}

.sectionbox-cta:hover .arrow {
  transform: translateX(2px);
}

/* Responsive */
@media (max-width: 768px) {
  .sectionbox-image img { height: 240px; }
}

</style>

<section class="container-fluid py-5">
  <div class="container">

    <div class="row">
      <div class="text-center mb-4">
        <p class="section-title pb-2">Advisory Team</p>
        <p class="section-subtitle">Our Professional Advisors</p>
      </div>
    </div>

    <div class="row g-4">
      @foreach ($advisorsPosts as $advisor)
        <?php 
          $cleanDescription = preg_replace('/<p[^>]*><\\/p[^>]*>/', '', $advisor->description);
        ?>

        <div class="col-md-4">
          <div class="sectionbox-card">

            <div class="sectionbox-image">
              @if ($advisor->image)
                <img src="{{ asset('uploads/post/' . $advisor->image) }}" alt="{{ $advisor->title }}">
              @else
                <img src="https://via.placeholder.com/500" alt="Advisor">
              @endif

              <span class="sectionbox-badge">Advisor</span>
            </div>

            <div class="sectionbox-content">
              <h3 class="sectionbox-title text-capitalize">
                {{ Str::limit($advisor->title, 40) }}
              </h3>

              <p class="sectionbox-desc">
                {!! Str::limit(strip_tags($cleanDescription), 150) !!}
              </p>

              <!-- Optional CTA -->
              <!-- <a href="#" class="sectionbox-cta">View Details <span class="arrow">→</span></a> -->
            </div>

          </div>
        </div>

      @endforeach
    </div>

    <div class="text-center mt-4">
      <a href="#">
      <button class="btn btn-view-all">
                        View All Team Members
                        <i class="fas fa-arrow-right ms-2"></i>
                    </button>
      </a>
    </div>

  </div>
</section>
