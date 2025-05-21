<style>
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f8f9fa;
}

.content-container {
    display: flex;
    padding: 40px;
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

.text-boxes {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.text-box {
    background-color: white;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.text-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(255, 233, 191, 0.8);
}

@media (max-width: 767.98px) {
    .text-box {
        margin-bottom: 15px;
    }
}

.text-box h3 {
    color: #343a40;
    margin-bottom: 15px;
    font-size: 1.5rem;
}

.text-box p {
    color: #6c757d;
    line-height: 1.6;
}

.image-box {
    flex: 1;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.image-box img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 5px;
    object-fit: cover;
}

@media (max-width: 768px) {
    .content-container {
        flex-direction: column;
        padding: 20px;
    }
    
    .image-box {
        min-height: 300px;
    }
}
</style>

<div class="main-content">
    <div class="content-container">
        <div class="text-boxes">
            <div class="text-box">
                <h3>Our Story</h3>
                <p>OLIs CRIB was founded in 2020 with a passion for providing high-quality products to our customers. We started as a small family business and have grown into a trusted name in our industry.</p>
            </div>
            
            <div class="text-box">
                <h3>Our Mission</h3>
                <p>We are committed to delivering exceptional value through our carefully curated selection of products. Our mission is to make shopping convenient, enjoyable, and affordable for everyone.</p>
            </div>
            
            <div class="text-box">
                <h3>Our Values</h3>
                <p>At OLIs CRIB, we believe in honesty, integrity, and customer satisfaction above all else. We treat every customer like family and stand behind every product we sell.</p>
            </div>
        </div>
        
        
        <div class="image-box">
            <img src="images/OLI.png" alt="About Us Image">
        </div>
    </div>
</div>