function success(message) {
    swal({
        title: "Successful!",
        text: message || "Operation successful!",
        icon: "success",
        button: "Continue",
    });
}

function error(message) {
    swal({
        title: "Error!",
        text: message || "Operation successful!",
        icon: "warning",
        button: "Continue",
    });
}
