<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f8f9fa;
}

section {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.video-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 55vh;
    position: relative;
}

video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.button-container {
    margin-top: 10px;
    display: flex;
    gap: 10px;
}

.buttonbutton {
    width: 150px;
}

.buttonbutton button {
    background: #f0f0f0;
    padding: 8px;
    border-radius: 10px;
    width: 100%;
    border: 1px solid #A39594;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 12px;
}

.buttonbutton button:hover {
    box-shadow: 0 4px 15px rgba(255, 233, 191, 0.35);
}

.best-seller-feature {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.feature-box {
    flex: 0 1 auto;
    width: 180px;
    margin: 0px 10px;
    display: flex;
    padding: 8px 12px;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border: 1px solid #44443b;
    border-radius: 8px;
    padding: 10px;
    background-color: #fff;
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
}

.feature-link {
    text-decoration: none;
    color: #EC7A1C;
}

.feature-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(255, 233, 191, 0.7);
    border-color: #EC7A1C;
}

.feature-link:hover {
    color: #EC7A1C;
}

.text-section {
    text-align: center;
    padding: 40px 20px;
    background-color: #ffffff;
}

.text-title {
    font-size: 36px;
    font-weight: bold;
    color: #44443B;
    margin-bottom: 10px;
}

.text-description {
    font-size: 16px;
    color: #666;
    max-width: 700px;
    margin: 0 auto;
}

.grid-section {
    text-align: center;
    padding: 40px 20px;
    background-color: #ffffff; 
}

.grid-container {
    display: flex;
    justify-content: space-between;
    padding: 30px;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 30px; 
}

.grid-item {
    flex: 1 1 30%; 
    max-width: 30%;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Added box-shadow transition */
    cursor: pointer;
    border-radius: 0;
    background-color: #ffffff; 
}

.grid-item:hover {
    transform: scale(1.05); /* Slightly increase size on hover */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
}

.grid-item img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    display: block;
    border-radius: 0;
    transition: transform 0.3s ease; /* Added transition for image */
}

.grid-item:hover img {
    transform: scale(1.1); /* Slightly zoom in the image on hover */
}

@media (max-width: 992px) {
    .grid-item {
        flex: 0 0 45%; 
        max-width: 45%;
        margin-bottom: 20px;
        height: auto;
    }
    .grid-item img {
        height: 400px;
    }
}

@media (max-width: 600px) {
    .grid-item {
        flex: 0 0 100%; 
        max-width: 100%;
        margin-bottom: 20px;
    }
    .grid-item img {
        height: auto;
        max-height: 500px;
    }
}

.new-arrivals .grid-container {
    display: flex;
    flex-wrap: nowrap;
    gap: 0;
}

.new-arrivals .grid-item {
    flex: 1 1 50%;
    max-width: 50%;
    margin: 0;
    padding: 0;
    box-shadow: none;
}

.new-arrivals .grid-item img {
    width: 100%;
    height: 600px; 
    object-fit: cover;
    display: block;
    margin: 0;
    padding: 0;
    transition: transform 0.3s ease; /* Added transition for new arrival images */
}

.new-arrivals .grid-item:hover img {
    transform: scale(1.1); /* Slightly zoom in the image on hover */
}

.text-section-left {
    text-align: left;
    padding: 40px 0;
    background-color: #ffffff;
}

.text-section-left .text-container {
    margin: 0;
    padding: 0 20px; 
}

.text-section-left .text-title,
.text-section-left .text-description {
    text-align: left;
    margin-left: 0;
}

.photo-label {
    margin-top: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #44443b;
    text-align: center;
}

.footer-section .d-flex {
    display: flex;
    justify-content: flex-start; 
    align-items: center; 
}

.footer-section .d-flex a {
    display: inline-flex;
    align-items: center;
    margin-right: 15px; 
}

.footer-section .d-flex i {
    font-size: 1.5rem; 
}
</style>



<section>
    <div class="banner_section">
        <div class="video-container">
            <video id="bikeVideo" src="images/OLIsVid.mp4" autoplay loop></video>
            <div class="button-container">
                <div class="buttonbutton">
                    <button id="playPauseBtn" onclick="togglePlayPause()">Pause</button>
                </div>
                <div class="buttonbutton">
                    <button id="muteUnmuteBtn" onclick="toggleMuteUnmute()">Mute</button>
                </div>
            </div>
        </div>
    </div>

    <div class="text-section"></div>
    <div class="text-section">
        <div class="container">
            <h1 class="text-title">Welcome to Our Bike Shop</h1>
            <p class="text-description">We offer a wide selection of high-quality bikes for all your riding adventures. Browse our collection today and find your perfect ride!</p>
        </div>
    </div>

    <div class="grid-section">
        <div class="container-fluid px-5">
            <div class="best-seller-feature">
                 <div class="feature-box" style="padding: 8px 12px;">
                    <a href="?page=products#bestsellers" class="feature-link">
                        <i class="fa fa-bell fa-2x mb-2"></i>
                        <h6 style="margin: 0; font-size: 16px;">Best Sellers</h6>
                    </a>
                </div>
                <div class="feature-box" style="padding: 8px 12px;">
                    <a href="?page=products#new-arrivals" class="feature-link">
                        <i class="fa fa-plus fa-2x mb-2"></i>
                        <h6 style="margin: 0; font-size: 16px;">New Arrivals</h6>
                    </a>
                </div>
                <div class="feature-box" style="padding: 8px 12px;">
                    <a href="?page=products#spring-essentials" class="feature-link">
                        <i class="fa fa-check fa-2x mb-2"></i>
                        <h6 style="margin: 0; font-size: 16px;">Featured Essentials</h6>
                    </a>
                </div>
            </div>

            <div class="grid-container">
                <div class="grid-item">
                    <img src="images/custom1.png" alt="Featured 1">
                    <p class="photo-label">Featured 1</p>
                </div>
                <div class="grid-item">
                    <img src="images/custom1.png" alt="Featured 2">
                    <p class="photo-label">Featured 2</p>
                </div>
                <div class="grid-item">
                    <img src="images/custom1.png" alt="Featured 3">
                    <p class="photo-label">Featured 3</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-section">
        <div class="container">
            <h2 class="text-title">Why Order Here?</h2>
            <p class="text-description">We provide top-quality bikes, excellent customer service, and a wide variety of models to suit every rider's needs.</p>
        </div>
    </div>

    <div class="grid-section new-arrivals">
        <div class="container-fluid px-5">
            <div class="grid-container">
                <div class="grid-item">
                <img src="images/custom1.png" alt="New Arrival 1">
                </div>
                <div class="grid-item">
                    <img src="images/custom1.png" alt="New Arrival 2">
                </div>
            </div>
        </div>
    </div>

    <div class="text-section">
        <div class="container">
            <h2 class="text-title">Explore New Gears</h2>
            <p class="text-description">Our latest collection of bikes has just arrived! Explore the options now!</p>
        </div>
    </div>

    <div class="grid-section">
        <div class="container-fluid px-5">
            <div class="best-seller-feature">
                <div class="feature-box" style="padding: 8px 12px;">
                    <a href="?page=products" class="feature-link">
                        <i class="fa fa-bicycle fa-2x mb-2"></i>
                        <h6 style="margin: 0; font-size: 16px;">Buy Now</h6>
                    </a>
                </div>
                <div class="feature-box" style="padding: 8px 12px;">
                    <a href="?page=checkout" class="feature-link">
                        <i class="fa fa-shopping-cart fa-2x mb-2"></i>
                        <h6 style="margin: 0; font-size: 16px;">Your Cart</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
 
<script>
function togglePlayPause() {
    const video = document.getElementById('bikeVideo');
    const button = document.getElementById('playPauseBtn');
    if (video.paused) {
        video.play();
        button.textContent = 'Pause';
    } else {
        video.pause();
        button.textContent = 'Play';
    }
}

function toggleMuteUnmute() {
    const video = document.getElementById('bikeVideo');
    const button = document.getElementById('muteUnmuteBtn');
    video.muted = !video.muted;
    button.textContent = video.muted ? 'Unmute' : 'Mute';
}
if (window.location.hash) {
    const targetId = window.location.hash.substring(1);
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
        targetElement.scrollIntoView({
            behavior: 'smooth'
        });
    }
}

</script>





