<!-- Markup for Home Hero Section -->
<section class="hero-section">
    <img src={{ asset("assets/images/hero-section.jpg") }} alt="Architectural Building Image" class="hero-image">
    <div class="text-overlay">
        <div class="introduction">
            <p class="motto">
                Complete Reality Capture
            </p>
            <p class="sub-motto">
                Interior and exterior visual data any angle, all in one platform. Conceptual home designs, floor
                plans, photorealistic 3D
                renderings, home decoration and design proposals.
            </p>
            <div class="buttons">
                <button class="action secondary" data-link="about-app">
                    LEARN MORE
                </button>
                @auth
                    <a href="{{ route("feed") }}" class="action primary" style="text-decoration: none">
                        BOOK APPOINTMENT
                    </a>
                @else
                    <button class="action primary" data-link="book-appointment">
                        BOOK APPOINTMENT
                    </button>
                @endauth
            </div>
        </div>
    </div>
</section>
