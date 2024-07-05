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
                    sessionStorage.setItem("danchou", data.token);

                    if (data.role == "admin") {
                        let roleID = "31C_" + data.id;

                        sessionStorage.setItem("nice", roleID);
                        location.href = "/admin/dashboard";
                    } else if (data.role == "agent") {
                        let roleID = "07_" + data.id;

                        sessionStorage.setItem("nice", roleID);
                        location.href = "/agent/dashboard";
                    } else if (data.role == roleID) {
                        let roleID = "3W_" + data.id;

                        sessionStorage.setItem("nice", roleID);
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
