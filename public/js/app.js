/**
 * Main JavaScript untuk SIAKAD Kampus
 */

$(document).ready(function() {
    
    // Initialize DataTables
    if ($('.datatable').length) {
        $('.datatable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    }
    
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Confirm delete
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        const message = $(this).data('message') || 'Data yang dihapus tidak dapat dikembalikan!';
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
    
    // Show loading on form submit
    $('form').on('submit', function() {
        const btn = $(this).find('button[type="submit"]');
        btn.prop('disabled', true);
        btn.html('<i class="fas fa-spinner fa-spin"></i> Memproses...');
    });
    
    // Input validation
    $('input[type="email"]').on('blur', function() {
        const email = $(this).val();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !regex.test(email)) {
            $(this).addClass('is-invalid');
            if (!$(this).next('.invalid-feedback').length) {
                $(this).after('<div class="invalid-feedback">Format email tidak valid</div>');
            }
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        }
    });
    
    // Phone number validation
    $('input[type="tel"], input[name*="telepon"]').on('input', function() {
        let value = $(this).val();
        value = value.replace(/[^0-9+]/g, '');
        $(this).val(value);
    });
    
    // Number input validation
    $('input[type="number"]').on('input', function() {
        const min = $(this).attr('min');
        const max = $(this).attr('max');
        const value = parseFloat($(this).val());
        
        if (min && value < parseFloat(min)) {
            $(this).val(min);
        }
        if (max && value > parseFloat(max)) {
            $(this).val(max);
        }
    });
    
    // Tooltip initialization
    $('[data-toggle="tooltip"]').tooltip();
    
    // Popover initialization
    $('[data-toggle="popover"]').popover();
    
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if(target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 70
            }, 500);
        }
    });
    
});

/**
 * Show toast notification
 */
function showToast(type, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
    
    Toast.fire({
        icon: type,
        title: message
    });
}

/**
 * Confirm action with custom message
 */
function confirmAction(url, message) {
    Swal.fire({
        title: 'Konfirmasi',
        text: message || 'Apakah Anda yakin?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
    return false;
}

/**
 * Format number as currency (Rupiah)
 */
function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

/**
 * Calculate IPK from nilai array
 */
function hitungIPK(nilaiArray) {
    let totalBobot = 0;
    let totalSKS = 0;
    
    nilaiArray.forEach(function(nilai) {
        const bobot = getNilaiBobot(nilai.nilai_akhir);
        totalBobot += (bobot * nilai.sks);
        totalSKS += nilai.sks;
    });
    
    return totalSKS > 0 ? (totalBobot / totalSKS).toFixed(2) : 0;
}

/**
 * Get nilai bobot from score
 */
function getNilaiBobot(nilai) {
    if (nilai >= 85) return 4.0;
    if (nilai >= 80) return 3.7;
    if (nilai >= 75) return 3.3;
    if (nilai >= 70) return 3.0;
    if (nilai >= 65) return 2.7;
    if (nilai >= 60) return 2.3;
    if (nilai >= 55) return 2.0;
    if (nilai >= 40) return 1.0;
    return 0;
}

/**
 * Print page
 */
function printPage() {
    window.print();
}
