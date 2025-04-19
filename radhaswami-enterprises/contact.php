<?php
include 'includes/header.php';
include 'includes/config.php';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Insert into database
    $sql = "INSERT INTO contacts (name, email, phone, subject, message, submitted_at) 
            VALUES ('$name', '$email', '$phone', '$subject', '$message', NOW())";
    
    if ($conn->query($sql)) {
        $success = true;
        
        // Send email notification (you would configure this in a real application)
        /*
        $to = "info@radhaswamienterprises.com";
        $email_subject = "New Contact Form Submission: $subject";
        $email_message = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage: $message";
        $headers = "From: $email";
        mail($to, $email_subject, $email_message, $headers);
        */
    } else {
        $error = "There was an error submitting your message. Please try again.";
    }
}
?>

    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container">
            <h1 class="wow fadeInUp">Contact Us</h1>
            <p class="wow fadeInUp" data-wow-delay="0.2s">Get in touch with our team for all your electrical and sanitaryware needs</p>
        </div>
        <div class="banner-overlay"></div>
    </section>

    <!-- Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <?php if (isset($success)): ?>
                <div class="success-message wow fadeInUp">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2>Thank You for Contacting Us!</h2>
                    <p>We've received your message and will get back to you shortly.</p>
                    <p>For immediate assistance, you can contact us directly:</p>
                    <div class="contact-options">
                        <a href="tel:+916378300906" class="btn btn-outline">
                            <i class="fas fa-phone-alt"></i> Call Now
                        </a>
                        <a href="https://wa.me/916378300906" class="btn btn-primary" target="_blank">
                            <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                        </a>
                    </div>
                    <a href="index.php" class="back-home">Back to Home</a>
                </div>
            <?php else: ?>
                <?php if (isset($error)): ?>
                    <div class="error-message wow fadeInUp">
                        <p><?php echo $error; ?></p>
                    </div>
                <?php endif; ?>
                
                <div class="contact-grid">
                    <!-- Contact Form -->
                    <div class="contact-form wow fadeInUp">
                        <h2>Send Us a Message</h2>
                        <form action="contact.php" method="POST" id="contactForm">
                            <div class="form-group">
                                <label for="name">Full Name*</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Email Address*</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number*</label>
                                    <input type="tel" id="phone" name="phone" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="subject">Subject*</label>
                                <input type="text" id="subject" name="subject" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Your Message*</label>
                                <textarea id="message" name="message" rows="5" required></textarea>
                            </div>
                            
                            <div class="form-submit">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="contact-info wow fadeInUp" data-wow-delay="0.2s">
                        <h2>Contact Information</h2>
                        <p>Feel free to reach out to us through any of these channels:</p>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <h3>Our Location</h3>
                                <p>Shop Address, Jaipur, Rajasthan, India</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="info-content">
                                <h3>Phone Numbers</h3>
                                <p><a href="tel:+916378300906">+91 6378300906</a> (Devesh Kumawat)</p>
                                <p><a href="tel:+917891417327">+91 7891417327</a> (Kanhiya Lal Kumawat)</p>
                                <p><a href="tel:+919057344451">+91 9057344451</a> (Kishan Kumawat)</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="info-content">
                                <h3>WhatsApp</h3>
                                <p><a href="https://wa.me/916378300906" target="_blank">Chat with us on WhatsApp</a></p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <h3>Email</h3>
                                <p><a href="mailto:info@radhaswamienterprises.com">info@radhaswamienterprises.com</a></p>
                            </div>
                        </div>
                        
                        <div class="business-hours">
                            <h3>Business Hours</h3>
                            <ul>
                                <li>Monday - Saturday: 9:00 AM - 8:00 PM</li>
                                <li>Sunday: 10:00 AM - 4:00 PM</li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Google Map -->
    <section class="map-section wow fadeInUp">
        <div class="container">
            <h2 class="section-title">Our Location</h2>
            <div class="map-container">
                <div id="map"></div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content wow fadeInUp">
                <h2>Looking for Expert Advice?</h2>
                <p>Our team is ready to help you select the perfect products for your project.</p>
                <div class="cta-buttons">
                    <a href="tel:+916378300906" class="btn btn-primary">
                        <i class="fas fa-phone-alt"></i> Call Now
                    </a>
                    <a href="products.php" class="btn btn-secondary">Browse Products</a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>