<script>
    $(document).ready(function() {
        $('.delete-item-btn').on('click', async function(e) {
            e.preventDefault();
            const deleteRoute = $(this).data('delete-route');

            if (!deleteRoute) {
                await Swal.fire({
                    title: 'Error!',
                    text: 'Delete route is not specified.',
                    icon: 'error',
                });
                return;
            }

            const confirmation = await Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });

            if (confirmation.isConfirmed) {
                const deleting = Swal.fire({
                    title: 'Deleting item ...',
                    text: 'Please wait while we are deleting the item!',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });

                try {
                    const response = await $.ajax({
                        url: deleteRoute,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    });

                    Swal.fire({
                        title: 'Deleted successfully!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        location.reload();
                    });

                } catch (error) {
                    Swal.fire({
                        title: 'Error processing!',
                        text: 'Please try again!',
                        icon: 'error',
                    });
                }
            }
        });
    });
</script>