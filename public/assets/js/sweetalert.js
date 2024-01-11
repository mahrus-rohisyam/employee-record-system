$(".delete").click(function () {
    let employeeId = $(this).attr("data-id");
    Swal.fire({
        title: "Are you sure?",
        text: "You will delete a record with Employee Id: " + employeeId,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = `/employee/delete/${employeeId}`;
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success",
            });
        } else {
            Swal.fire({
                title: "Canceled!",
                text: "No changes were made",
                icon: "info",
            });
        }
    });
});
