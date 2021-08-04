$('.delete-post-form button').click(function () {
    if (confirm('Are you sure to delete this post?') ) {
        this.closest('form').submit();
    }
});
