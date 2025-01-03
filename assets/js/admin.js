jQuery(document).ready(function($) {
    // File input validation
    $('#csv_file').on('change', function() {
        var file = this.files[0];
        if (file && file.type !== 'text/csv') {
            alert('Please select a valid CSV file.');
            this.value = '';
        }
    });
    
    // Form submission handling
    $('form').on('submit', function() {
        if ($('#csv_file').val() === '') {
            alert('Please select a CSV file to import.');
            return false;
        }
    });
});