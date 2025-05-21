<div class="contact-container">
    <div class="contact-header">
        <h2></h2>
        <h2>Get in Touch With Us</h2>
        <p>Click here to contact our support team. We're available 24/7 to answer your questions and help with any issues you might have. Your satisfaction is our top priority!</p>
        <p>Get in Touch With Us Click here to contact our support team. We're available 24/7 to answer your questions and help with any issues you might have. Your satisfaction is our top priority!</p>

        <p>If you have any questions, feel free to reach out!</p>
    </div>
    
    <div class="contact-boxes">
        <!-- Phone Box -->
        <div class="contact-box phone-box">
            <div class="contact-icon">
                <i class="fas fa-phone-alt"></i>
            </div>
            <h3>Call Us</h3>
            <a href="tel:+63910982364" class="contact-link phone-link">+63910982364</a>
        </div>
        
        <!-- Facebook Box -->
        <div class="contact-box facebook-box">
            <div class="contact-icon">
                <i class="fab fa-facebook-f"></i>
            </div>
            <h3>Visit Our Facebook</h3>
            <a href="https://www.facebook.com/oliscrib" target="_blank" class="contact-link fb-link">OLIs CRIB</a>
        </div>
    </div>
</div>
<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-color: #f8f9fa;
    }
    
    .contact-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .contact-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .contact-header h2 {
        color: #343a40;
        font-size: 2.2rem;
        margin-bottom: 20px;
    }
    
    .contact-header p {
        color: #6c757d;
        font-size: 1.1rem;
        max-width: 800px;
        margin: 0 auto 25px;
        line-height: 1.6;
    }
    
    .contact-boxes {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 30px;
    }
    
    .contact-box {
        flex: 1;
        max-width: 500px;
        padding: 40px;
        border-radius: 10px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .phone-box {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
    
    .facebook-box {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
    
    .contact-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(255, 233, 191, 0.8);
    }

    @media (max-width: 767.98px) {
        .contact-box {
            margin-bottom: 15px;
        }
    }
    .contact-icon {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #9b806e;
    }
    
    .contact-box h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #343a40;
    }
    
    .contact-link {
        display: inline-block;
        padding: 10px 25px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .phone-link {
        color: #343a40;
        border: 2px solid #9b806e;
    }
    
    .phone-link:hover {
        background-color: #9b806e;
        color: white;
    }
    
    .fb-link {
        color: white;
        background-color: #4267B2;
        border: 2px solid #4267B2;
    }
    
    .fb-link:hover {
        background-color: white;
        border-color: #365899;
    }
    
    .footer {
        width: 100%;
        background-color: #90462c;
        padding: 20px 0;
        margin-top: auto;
    }
    
    .footer p {
        margin: 0;
        color: white;
    }
    
    @media (max-width: 768px) {
        .contact-boxes {
            flex-direction: column;
        }
        
        .contact-box {
            max-width: 100%;
        }
    }
</style>