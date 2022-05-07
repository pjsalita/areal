<!-- Markup for About App -->
<section class="about-app">
    <div class="about-image">
        <img data-aos="zoom-in" data-aos-duration="1000" src="{{ asset("assets/images/Advertisement.png") }}" alt="Mobile Phone with AReal Logo">
    </div>

    <div class="about-description" data-aos="slide-left" data-aos-duration="500">
        <h1 class="title"> About AReal App</h1>
        <p class="body">
            AReal is an android application that can feature the different angles of a building, the exterior, and
            interior design. It also
            provides easy access for the client when it comes to the project.
        </p>
        <div class="buttons">
            <div class="action secondary" data-role="modal-trigger">
                HOW TO INSTALL
            </div>
            @if (Storage::exists('AReal_Latest.apk'))
                <a href="{{ Storage::url('AReal_Latest.apk') }}" class="action primary" target="_blank" style="text-decoration: none">
                    DOWNLOAD NOW
                </a>
            @else
                <div class="action primary">
                    DOWNLOAD NOW
                </div>
            @endif
        </div>
    </div>

    <div class="modal" data-role="modal">
        <div class="modal-overlay" data-role="modal-overlay"></div>
        <div class="modal-box">
            <div class="title">
                <h1>How to Install</h1>
                <div class="close" data-role="close-modal">
                    <img src="{{ asset("assets/images/close.png") }}" alt="Close Icon">
                </div>
            </div>
            <div class="body">
                <ol>
			<li>
				<p>Scroll down to About Areal App and press "download now".</p>
				<img src="{{ asset('assets/images/1.png') }}" alt="" />
			</li>
			<li>
				<p>Press details to go to the browser download tab.</p>
				<img src="{{ asset('assets/images/2.png') }}" alt="" />
			</li>
			<li>
				<p>Press the downloaded apk file. Then click the install.</p>
				<img src="{{ asset('assets/images/3.png') }}" alt="" />
				<img src="{{ asset('assets/images/4.png') }}" alt="" />
			</li>
			<li>
				<p>Then open the application. </p>
				<img src="{{ asset('assets/images/3.png') }}" alt="" />
			</li>
		</ol>
            </div>
        </div>
    </div>
</section>
