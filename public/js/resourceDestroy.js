function deleteRecord(urlDestroy, redirectRoute) {
    $.ajax({
        url: urlDestroy,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        error: function (request, error) {
            alert(error)
        },
        success: function (result) {
            alert('Deleted!')
            window.location.href = redirectRoute;
        }
    });
}