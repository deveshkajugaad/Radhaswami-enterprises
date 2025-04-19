document.addEventListener('DOMContentLoaded', function() {
    // Quotation Form Validation
    const quotationForm = document.getElementById('quotationForm');
    if (quotationForm) {
        quotationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const projectType = document.getElementById('project_type');
            const performa = document.getElementById('performa');
            let isValid = true;
            
            // Reset error states
            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('has-error');
            });
            
            // Validate name
            if (name.value.trim() === '') {
                name.closest('.form-group').classList.add('has-error');
                isValid = false;
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {
                email.closest('.form-group').classList.add('has-error');
                isValid = false;
            }
            
            // Validate phone
            const phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(phone.value.trim())) {
                phone.closest('.form-group').classList.add('has-error');
                isValid = false;
            }
            
            // Validate project type
            if (projectType.value === '') {
                projectType.closest('.form-group').classList.add('has-error');
                isValid = false;
            }
            
            // Validate performa (optional)
            if (performa.files.length > 0) {
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
                const fileType = performa.files[0].type;
                const fileSize = performa.files[0].size; // in bytes
                
                if (!allowedTypes.includes(fileType)) {
                    performa.closest('.form-group').classList.add('has-error');
                    isValid = false;
                    alert('Please upload a valid file type (PDF, JPG, PNG).');
                }
                
                if (fileSize > 5 * 1024 * 1024) { // 5MB
                    performa.closest('.form-group').classList.add('has-error');
                    isValid = false;
                    alert('File size should be less than 5MB.');
                }
            }
            
            // If valid, submit form
            if (isValid) {
                this.submit();
            }
        });
    }
    
    // Contact Form Validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const subject = document.getElementById('subject');
            const message = document.getElementById('message');
            let isValid = true;
            
            // Reset error states
            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('has-error');
            });
            
            // Validate name
            if (name.value.trim() === '') {
                name.closest('.form-group').classList.add('has-error');
                isValid = false;
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {
                email.closest('.form-group').classList.add('has-error');
                isValid = false;
            }
            
            // Validate phone
            const phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(phone.value.trim())) {
                phone.closest('.form-group').classList.add('has-error');
                isValid = false;
            }
            
            // Validate subject
            if (subject.value.trim() === '') {
                subject.closest('.form-group').classList.add('has-error');
                isValid = false;
            }
            
            // Validate message
            if (message.value.trim() === '') {
                message.closest('.form-group').classList.add('has-error');
                isValid = false;
            }
            
            // If valid, submit form
            if (isValid) {
                this.submit();
            }
        });
    }
    
    // Add real-time validation
    document.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('input', function() {
            this.closest('.form-group').classList.remove('has-error');
        });
    });
});