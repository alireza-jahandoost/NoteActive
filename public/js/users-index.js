$('.delete-users-form button').click(function () {
    if (confirm('Are you sure to delete this user?') ) {
        this.closest('form').submit();
    }
});
