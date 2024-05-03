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
        padding: 20px 10px 10px 10px;
    }

    h2 {
        margin-top: 20px;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        margin: 20px auto;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    #pagination {
        text-align: center;
    }

    #pagination span {
        padding: 2px 5px;
        text-decoration: underline;
        cursor: pointer;
    }

    #pagination div {
        display: inline-block;
    }

    .div-detail {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(142, 141, 141, 0.537);
        display: none;
    }

    .show {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .detail {
        display: flex;
        margin: 0px auto;
        width: 50%;
        max-width: 700px;
        min-height: 250px;
        height: auto;
        background-color: white;
        flex-direction: column;
        justify-content: space-between;
        padding: 10px;
    }

    .title {
        border: 2px solid rgba(255, 255, 255, 1);
        font-weight: bold;
        text-align: center;
        padding: 20px;
        font-size: 20px;
        background-color: orange;
    }

    .info div {
        margin-bottom: 5px;
    }

    .div-info {
        display: flex;
        height: 100%;
    }

    .image {
        height: 100%;
        width: 150px;
    }

    #return {
        text-decoration: underline;
        cursor: pointer;
    }

    .wp {
        text-align: right;
    }

    .tab {
        display: flex;
        width: 60%;
        justify-content: space-between;
        margin: 5px auto;
    }

    .tab div {
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 18px;
    }

    .tab div:hover {
        background-color: rgb(74, 195, 195);
        cursor: pointer;
    }

    .management-section {
        display: none;
    }

    .active-section {
        display: block;
    }

    .active-tab {
        background-color: rgb(74, 195, 195);
    }

    #logout {
        background-color: red;
        color: white;
        font-weight: bold;
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
    </style>
</head>
<header>
    <h1>Web Quảng Cáo Sữa</h1>
    <div class="tab">
        <div class="tab-detail" onclick="handleNavigate(0)">
            Danh sách sản phẩm
        </div>
        <div class="tab-detail" onclick="handleNavigate(1)">
            Thông tin giỏ hàng
        </div>
        <div class="tab-detail" onclick="handleNavigate(2)">
            Thông tin đơn hàng
        </div>
        <div class="tab-detail" onclick="handleNavigate(3)">
            Thông tin cá nhân
        </div>
        <div id="logout" onclick="logout()">
            Đăng xuất
        </div>
    </div>
</header>

<body>
    <form id="updateUserForm">
        <h2>Thông tin Cá nhân</h2>
        <label for="id4">Mã khách hàng</label>
        <input type="text" id="id4" name="id" readonly />
        <label for="name4">Tên Người dùng</label>
        <input type="text" id="name4" name="name" required />

        <label>Giới tính</label>
        <input class="group-radio" type="radio" id="sex2" name="sex" value="1" checked required />
        <label class="group-radio" for="sex2">Nam</label>
        <input class="group-radio" type="radio" id="sex3" name="sex" value="0" required />
        <label class="group-radio" for="sex3">Nữ</label>

        <label for="address4">Địa chỉ</label>
        <input type="text" id="address4" name="address" required />

        <label for="phone4">Số điện thoại</label>
        <input type="text" id="phone4" name="phone" required />

        <label for="email4">Email</label>
        <input type="text" id="email4" name="email" required />

        <label for="password4">Password</label>
        <input type="text" id="password4" name="password" required />
        <input type="submit" value="Cập nhập" />
    </form>
    <script>
    let userLogin = null;
    window.onload = function() {
        userLogin = JSON.parse(localStorage.getItem("user"));
        if (userLogin) {
            if (userLogin.role == 1)
                window.location.href = "http://localhost:81/api/web/MilkManagementAdmin.php"
            else {
                document.querySelectorAll(".tab-detail").forEach((t, index) => {
                    const link = window.location.href;
                    if (index == 0 && link.includes("MilkManagementUser") ||
                        index == 1 && link.includes("CartManagementUser") ||
                        index == 2 && link.includes("OrderManagementUser") ||
                        index == 3 && link.includes("ProfileManagementUser"))
                        t.classList.add("active-tab");

                })
                getUserById()
            };
        } else
            window.location.href = "http://localhost:81/api/web/HomePage.php"

    };

    function getUserById() {
        fetch(`http://localhost:81/api/get-one-user.php?id=${userLogin.id}`)
            .then((response) => response.json())
            .then((data) => {
                populateUpdateUser(data);
            })
            .catch((error) => console.error("Error:", error));
    }

    function populateUpdateUser(data) {
        document.getElementById("id4").value = data.id;
        document.getElementById("name4").value = data.name;
        document.getElementById(
            data.sex == 1 ? "sex2" : "sex3"
        ).checked = true;
        document.getElementById("address4").value = data.address;
        document.getElementById("phone4").value = data.phone;
        document.getElementById("email4").value = data.email;
        document.getElementById("password4").value = data.password;
    }
    </script>
    <script>
    function handleNavigate(key) {
        switch (key) {
            case 0:
                window.location.href = "http://localhost:81/api/web/MilkManagementUser.php";
                break;
            case 1:
                window.location.href = "http://localhost:81/api/web/CartManagementUser.php";
                break;
            case 2:
                window.location.href = "http://localhost:81/api/web/OrderManagementUser.php";
                break;
            case 3:
                window.location.href = "http://localhost:81/api/web/ProfileManagementUser.php";
                break;
            default:
                break;
        }
    }
    </script>
    <script>
    function logout() {
        localStorage.clear();
        window.location.href = "http://localhost:81/api/web/HomePage.php";
    }
    document
        .getElementById("updateUserForm")
        .addEventListener("submit", function(event) {
            event.preventDefault();

            function updateProfile() {
                const formData = new FormData(
                    document.getElementById("updateUserForm")
                );
                fetch(`http://localhost:81/api/put-profile.php`, {
                        method: "POST",
                        body: formData,
                    })
                    .then((data) => {
                        alert("Update Profile Success");
                    })
                    .catch((error) => console.error("Error:", error));
            }
            updateProfile();
        });
    </script>
</body>

</html>