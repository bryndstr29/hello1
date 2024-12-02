$(document).ready(function () {
    $('#inventoryForm').submit(function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: 'inventory_insert.php', 
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                const result = JSON.parse(response); 
                if (result.success) {
                    $('#message').text(result.message);
                    $('#inventoryForm')[0].reset(); 
                } else {
                    $('#message').text(result.message).css('color', 'red');
                }
            },
            error: function () {
                $('#message').text('An error occurred.').css('color', 'red');
            },
        });
    });
});
