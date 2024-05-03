<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quảng Cáo Sữa</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    header {
        text-align: center;
        background-color: aqua;
        padding: 20px 10px;
    }

    h2 {
        margin-top: 20px;
        text-align: center;
    }

    .div-form {
        border: 1px solid black;
        margin: 20px auto;
        width: 400px;
        padding: 10px;
        display: none;
    }

    .show {
        display: block;
    }

    form {
        max-width: 400px;
        margin: 20px auto;
    }

    form h2 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: white;
        cursor: pointer;
    }

    .group-radio {
        display: inline-block;
        width: 10%;
    }

    h3 {
        text-align: center;
        text-decoration: underline;
        font-style: italic;
        cursor: pointer;
        margin: 5px;
    }
    </style>
</head>
<header>
    <h1>Web Quảng Cáo Sữa</h1>
</header>

<body>
    <div class="div-form show" id="div-form-login">
        <h2>Đăng nhập</h2>
        <form id="login">
            <div>
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="email" required />
            </div>
            <div>
                <label for="passwordLogin">Mật khẩu</label>
                <input type="password" id="passwordLogin" name="password" required />
            </div>
            <input type="submit" value="Đăng nhập" />
            <h3 id="nav-register">Đăng ký</h3>
            <h3 id="nav-user-page">Bỏ qua đăng ký</h3>
        </form>

    </div>
    <div class="div-form" id="div-form-register">
        <h2>Đăng ký</h2>
        <form id="register">

            <label for="name">Họ tên</label>
            <input type="text" id="name" name="name" required />
            <label>Giới tính</label>
            <input class="group-radio" type="radio" id="sex" name="sex" value="1" checked required />
            <label class="group-radio" for="sex">Nam</label>
            <input class="group-radio" type="radio" id="sex1" name="sex" value="0" required />
            <label class="group-radio" for="sex1">Nữ</label>

            <label for="address">Địa chỉ</label>
            <input type="text" id="address" name="address" required />

            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" name="phone" required />

            <label for="email">Email</label>
            <input type="text" id="email" name="email" required />
            <div>
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required />
            </div>
            <div>
                <label for="passwordConfirm">Xác nhận mật khẩu</label>
                <input type="password" id="passwordConfirm" name="passwordConfirm" required />
            </div>
            <input type="submit" value="Đăng ký" />
            <h3 id="nav-login">Đăng nhập</h3>
        </form>

    </div>
    <script>
    document.getElementById("login").addEventListener("submit", function(event) {
        event.preventDefault();

        function login() {
            const formData = new FormData(document.getElementById("login"));
            fetch(`http://localhost:81/api/login.php`, {
                    method: "POST",
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === true) {
                        // Lưu thông tin người dùng vào localStorage
                        localStorage.setItem("user", JSON.stringify(data.data));

                        // Hiển thị thông báo và chuyển hướng trang
                        alert("Login Success");
                        window.location.href = data.data.role == 1 ?
                            "http://localhost:81/api/web/MilkManagementAdmin.php" :
                            "http://localhost:81/api/web/MilkManagementUser.php";
                    } else {
                        alert("Login Failed. Please check your username and password.");
                    }
                })
                .catch((error) => console.error("Error:", error));
        }

        login();
    });
    document.getElementById("register").addEventListener("submit", function(event) {
        event.preventDefault();

        function login() {
            const formData = new FormData(document.getElementById("register"));
            if (formData.get("password") !== formData.get("passwordConfirm"))
                alert("Mật khẩu xác nhận không khớp!")
            else
                fetch(`http://localhost:81/api/register.php`, {
                    method: "POST",
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === true) {
                        alert("Register Success");
                        document.getElementById("nav-login").click();
                    } else {
                        alert("Register Failed!");
                    }
                })
                .catch((error) => console.error("Error:", error));
        }
        login();
    });
    document.getElementById("nav-login").addEventListener("click", () => {
        document.querySelectorAll(".div-form").forEach(d => d.classList.remove("show"));
        document.getElementById("div-form-login").classList.add("show");
    });
    document.getElementById("nav-register").addEventListener("click", () => {
        document.querySelectorAll(".div-form").forEach(d => d.classList.remove("show"));
        document.getElementById("div-form-register").classList.add("show");
    });
    document.getElementById("nav-user-page").addEventListener("click", () => {
        window.location.href =
            "http://localhost:81/api/web/MilkManagementUser.php";
    });
    </script>
</body>

</html>