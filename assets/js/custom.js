// custom.js
if (typeof jQuery === 'undefined') {
    console.error('jQuery is not loaded');
} else {
    console.log('jQuery loaded successfully');
}

$(document).ready(function() {
    console.log('Custom.js initialized');

    // Slideshow functionality
    let slideIndex = 1;
    function showSlides(n) {
        let slides = $('.mySlides');
        let dots = $('.dot');
        if (n > slides.length) { slideIndex = 1; }
        if (n < 1) { slideIndex = slides.length; }
        slides.hide();
        dots.removeClass('active');
        slides.eq(slideIndex - 1).show();
        dots.eq(slideIndex - 1).addClass('active');
        console.log('Showing slide:', slideIndex);
    }

    // Initialize slideshow
    showSlides(slideIndex);

    // Next/previous controls
    $('.prev').on('click', function() {
        slideIndex--;
        showSlides(slideIndex);
    });

    $('.next').on('click', function() {
        slideIndex++;
        showSlides(slideIndex);
    });

    // Dot controls
    $('.dot').on('click', function() {
        slideIndex = $(this).index() + 1;
        showSlides(slideIndex);
    });

    // Auto slideshow
    setInterval(function() {
        slideIndex++;
        showSlides(slideIndex);
    }, 5000);
// custom.js
document.addEventListener('DOMContentLoaded', function() {
    console.log('Custom.js initialized');

    // Slideshow functionality
    let slideIndex = 1;
    const slides = document.getElementsByClassName('mySlides');
    const dots = document.getElementsByClassName('dot');

    if (slides.length === 0) {
        console.error('No slides found');
        return;
    }

    function showSlides(n) {
        if (n > slides.length) { slideIndex = 1; }
        if (n < 1) { slideIndex = slides.length; }
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = 'none';
        }
        for (let i = 0; i < dots.length; i++) {
            dots[i].classList.remove('active');
        }
        slides[slideIndex - 1].style.display = 'block';
        dots[slideIndex - 1].classList.add('active');
        console.log('Showing slide:', slideIndex);
    }

    // Initialize slideshow
    showSlides(slideIndex);

    // Next/previous controls
    document.querySelector('.prev').addEventListener('click', function() {
        slideIndex--;
        showSlides(slideIndex);
    });

    document.querySelector('.next').addEventListener('click', function() {
        slideIndex++;
        showSlides(slideIndex);
    });

    // Dot controls
    document.querySelectorAll('.dot').forEach((dot, index) => {
        dot.addEventListener('click', function() {
            slideIndex = index + 1;
            showSlides(slideIndex);
        });
    });

    // Auto slideshow
    setInterval(function() {
        slideIndex++;
        showSlides(slideIndex);
    }, 5000);
});
    // Handle form submissions with AJAX
    $('form.ajax-form').on('submit', function(e) {
        e.preventDefault();
        const $form = $(this);
        const formData = $form.serialize();
        const $submitButton = $form.find('button[type="submit"]');
        const $spinner = $form.find('.spinner');
        const $alertContainer = $('.alert-container');

        console.log('Form submitted:', formData);

        $submitButton.prop('disabled', true).addClass('disabled');
        $spinner.show();

        $.ajax({
            url: 'api.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            timeout: 60000,
            beforeSend: function() {
                console.log('Sending AJAX to api.php:', formData);
                $alertContainer.empty();
            },
            success: function(response) {
                console.log('AJAX success:', response);
                const alertType = response.status === 'success' ? 'success' : 'danger';
                $alertContainer.html(`
                    <div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);

                if (response.status === 'success' && (
                    formData.includes('action=enroll') ||
                    formData.includes('action=delete') ||
                    formData.includes('action=delete_attendance') ||
                    formData.includes('action=add_admin') ||
                    formData.includes('action=update_admin_password') ||
                    formData.includes('action=delete_admin') ||
                    formData.includes('action=attendance')
                )) {
                    setTimeout(() => window.location.reload(), 1000);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', { status, error, response: xhr.responseText });
                $alertContainer.html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to communicate with server: ${error || 'Unknown error'}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            },
            complete: function() {
                console.log('AJAX request completed');
                $submitButton.prop('disabled', false).removeClass('disabled');
                $spinner.hide();
            }
        });
    });

    // Delete Employee Modal
    $('#deleteModal').on('show.bs.modal', function(event) {
        console.log('Delete employee modal opened');
        const button = $(event.relatedTarget);
        const fingerprintId = button.data('fingerprint-id');
        const employeeName = button.data('employee-name');
        const modal = $(this);
        modal.find('#deleteFingerprintId').val(fingerprintId);
        modal.find('#employeeName').text(employeeName);
        console.log('Delete modal data:', { fingerprintId, employeeName });
    });

    // Delete Attendance Modal
    $('#deleteAttendanceModal').on('show.bs.modal', function(event) {
        console.log('Delete attendance modal opened');
        const button = $(event.relatedTarget);
        const attendanceId = button.data('attendance-id');
        const employeeName = button.data('employee-name');
        const modal = $(this);
        modal.find('#deleteAttendanceId').val(attendanceId);
        modal.find('#employeeName').text(employeeName);
        console.log('Delete attendance data:', { attendanceId, employeeName });
    });

    // Update Password Modal
    $('#updatePasswordModal').on('show.bs.modal', function(event) {
        console.log('Update password modal opened');
        const button = $(event.relatedTarget);
        const userId = button.data('user-id');
        const username = button.data('username');
        const modal = $(this);
        modal.find('#updateUserId').val(userId);
        modal.find('#updateUsername').text(username);
        console.log('Update password data:', { userId, username });
    });

    // Delete Admin Modal
    $('#deleteAdminModal').on('show.bs.modal', function(event) {
        console.log('Delete admin modal opened');
        const button = $(event.relatedTarget);
        const userId = button.data('user-id');
        const username = button.data('username');
        const modal = $(this);
        modal.find('#deleteUserId').val(userId);
        modal.find('#deleteUsername').text(username);
        console.log('Delete admin data:', { userId, username });
    });

    // Enhance form input focus
    $('.form-control').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });

    // Smooth scroll for anchor links
    $('a[href*="#"]').on('click', function(e) {
        if (this.hash !== '') {
            e.preventDefault();
            const hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800);
        }
    });
});