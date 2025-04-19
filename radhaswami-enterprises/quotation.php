<?php
include 'includes/header.php';
include 'includes/config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $project_type = $conn->real_escape_string($_POST['project_type']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // File upload handling
    $upload_status = false;
    $file_path = '';
    
    if (isset($_FILES['performa']) && $_FILES['performa']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/quotations/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_name = time() . '_' . basename($_FILES['performa']['name']);
        $target_path = $upload_dir . $file_name;
        
        // Check file type (allow PDF, JPG, PNG)
        $file_type = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
        $allowed_types = ['pdf', 'jpg', 'jpeg', 'png'];
        
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES['performa']['tmp_name'], $target_path)) {
                $upload_status = true;
                $file_path = $target_path;
            }
        }
    }
    
    // Insert into database
    $sql = "INSERT INTO quotations (name, email, phone, project_type, message, performa_path, submitted_at) 
            VALUES ('$name', '$email', '$phone', '$project_type', '$message', '$file_path', NOW())";
    
    if ($conn->query($sql) {
        $success = true;
        
        // Send email notification (you would configure this in a real application)
        /*
        $to = "info@radhaswamienterprises.com";
        $subject = "New Quotation Request from $name";
        $email_message = "Name: $name\nEmail: $email\nPhone: $phone\nProject Type: $project_type\nMessage: $message";
        $headers = "From: $email";
        mail($to, $subject, $email_message, $headers);
        */
    } else {
        $error = "There was an error submitting your request. Please try again.";
    }
}
?>

    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container">
            <h1 class="wow fadeInUp">Request a Quotation</h1>
            <p class="wow fadeInUp" data-wow-delay="0.2s">Get competitive pricing for your project needs</p>
        </div>
        <div class="banner-overlay"></div>
    </section>

    <!-- Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Request Quote</li>
            </ul>
        </div>
    </section>

    <!-- Quotation Form Section -->
    <section class="quotation-form-section">
        <div class="container">
            <?php if (isset($success)): ?>
                <div class="success-message wow fadeInUp">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2>Thank You for Your Request!</h2>
                    <p>We've received your quotation request and will get back to you within 24 hours with a competitive quote.</p>
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
                
                <div class="form-container wow fadeInUp">
                    <div class="form-intro">
                        <h2>Get a Custom Quote</h2>
                        <p>Fill out the form below and upload your performa to receive a competitive quotation for your project needs. Our team will review your requirements and get back to you promptly.</p>
                    </div>
                    
                    <form action="quotation.php" method="POST" enctype="multipart/form-data" id="quotationForm">
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
                            <label for="project_type">Project Type*</label>
                            <select id="project_type" name="project_type" required>
                                <option value="">Select Project Type</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Industrial">Industrial</option>
                                <option value="Renovation">Renovation</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="performa">Upload Performa (PDF, JPG, PNG)</label>
                            <div class="file-upload">
                                <input type="file" id="performa" name="performa" accept=".pdf,.jpg,.jpeg,.png">
                                <label for="performa" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span id="file-name">Choose file or drag here</span>
                                </label>
                            </div>
                            <p class="file-note">Max file size: 5MB</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Additional Information</label>
                            <textarea id="message" name="message" rows="4" placeholder="Any special requirements or notes..."></textarea>
                        </div>
                        
                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary">Submit for Quotation</button>
                        </div>
                    </form>
                </div>
                
                <div class="quotation-info wow fadeInUp" data-wow-delay="0.2s">
                    <h3>Need Immediate Assistance?</h3>
                    <p>For urgent inquiries or if you prefer to discuss your requirements directly, please contact us:</p>
                    <ul class="contact-options">
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <a href="tel:+916378300906">+91 6378300906</a>
                        </li>
                        <li>
                            <i class="fab fa-whatsapp"></i>
                            <a href="https://wa.me/916378300906" target="_blank">Chat on WhatsApp</a>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:info@radhaswamienterprises.com">info@radhaswamienterprises.com</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>