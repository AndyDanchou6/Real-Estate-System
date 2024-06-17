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
                'Accept': "application/json",
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
                sessionStorage.setItem('firstname', data.user.firstname);
                sessionStorage.setItem('lastname', data.user.lastname);
                sessionStorage.setItem('middlename', data.user.middlename);
                sessionStorage.setItem('role', data.user.role);
                sessionStorage.setItem('address', data.user.address);
                sessionStorage.setItem('phoneNo', data.user.phoneNo);
                sessionStorage.setItem('email', data.user.email);
                sessionStorage.setItem('profileImg', data.user.profileImg);

                if (data.user.role == 'admin') {
                    location.href = '/admin/dashboard';
                } 
                
                if (data.user.role == 'agent') {
                    location.href = '/agent/dashboard';
                }

               }
            });
    });
});
