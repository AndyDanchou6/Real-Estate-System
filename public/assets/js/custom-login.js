addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        var rememberMe = document.querySelector("#rememberMe").checked;
        const inputEmail = document.querySelector("#yourEmail").value;
        const inputPassword = document.querySelector("#yourPassword").value;

        if (rememberMe == true) {
            localStorage.setItem("loginEmail", inputEmail);
        }

        const loginApi = `/api/login`;

        fetch(loginApi, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            body: JSON.stringify({
                email: inputEmail,
                password: inputPassword,
            }),
        })
            .then((res) => {
                if (!res.ok) {
                    throw new Error("Bad Network Response.");
                }
                return res.json();
            })
            .then((data) => {
                if (data.status == 200) {
                    // sessionStorage.setItem('middlename', data.user.middlename);
                    // sessionStorage.setItem('address', data.user.address);
                    // sessionStorage.setItem('phoneNo', data.user.phoneNo);
                    sessionStorage.setItem("firstName", data.user.firstName);
                    sessionStorage.setItem("lastName", data.user.lastName);
                    sessionStorage.setItem("occupation", data.user.occupation);
                    sessionStorage.setItem("profileImg", data.user.profileImg);
                    sessionStorage.setItem("email", data.user.email);
                    sessionStorage.setItem("role", data.user.role);

                    if (data.user.role == "admin") {
                        location.href = "/admin/dashboard";
                    } else if (data.user.role == "agent") {
                        location.href = "/agent/dashboard";
                    } else if (data.user.role == "client") {
                        location.href = "/client/dashboard";
                    } else {
                        location.href = "/";
                    }
                } else {
                    alert("Email and Password Does not Match!");
                }
            });
    });
});
