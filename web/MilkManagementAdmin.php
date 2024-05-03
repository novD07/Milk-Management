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
        padding: 20px 10px 5px 10px;
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

    .tab-milk-section {
        display: none;
    }

    .tab-milk-active {
        display: block;
    }

    .tab-milk-detail {
        padding: 5px 10px;
        margin: 5px;
        border-radius: 3px;
    }

    .tab-milk-detail:hover {
        cursor: pointer;
        background-color: rgb(203, 203, 203);
    }

    .active-tab-milk {}

    .tab-brand-section {
        display: none;
    }

    .tab-brand-active {
        display: block;
    }

    .tab-brand-detail {
        padding: 5px 10px;
        margin: 5px;
        border-radius: 3px;
    }

    .tab-brand-detail:hover {
        cursor: pointer;
        background-color: rgb(203, 203, 203);
    }

    .active-brand-milk {}

    .tab-user-section {
        display: none;
    }

    .tab-user-active {
        display: block;
    }

    .tab-user-detail {
        padding: 5px 10px;
        margin: 5px;
        border-radius: 3px;
    }

    .tab-user-detail:hover {
        cursor: pointer;
        background-color: rgb(203, 203, 203);
    }

    .active-user-milk {}

    .active-tab {
        background-color: rgb(74, 195, 195);
    }


    table {
        width: 90%;
        border-collapse: collapse;
        margin: 20px auto;
    }

    thead {
        background-color: wheat
    }

    th {
        padding: 8px;
        text-align: center;
    }


    td {
        padding: 8px;
        text-align: left;
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

    .group-radio {
        display: inline-block;
        width: 10%;
    }

    #logout {
        background-color: red;
        color: white;
        font-weight: bold;
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
        width: 90%;
        max-width: 1400px;
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

    #total {
        text-align: center;
        width: 200px;
        font-weight: bold;
        font-size: 16px;
        padding: 8px 16px;
        margin-left: auto;
        margin-right: 75px;
    }
    </style>
</head>
<header>
    <h1>Quản lý trang Web Quảng Cáo Sữa</h1>
    <div class="tab">
        <div class="tab-detail active-tab" id="tab-order" onclick="showSection('order')">
            Quản lý Đơn hàng
        </div>
        <div class="tab-detail " id="tab-milk" onclick="showSection('milk')">
            Quản lý Sữa
        </div>
        <div class="tab-detail" id="tab-brand" onclick="showSection('brand')">
            Quản lý Hãng sữa
        </div>
        <div class="tab-detail" id="tab-user" onclick="showSection('user')">
            Quản lý Người dùng
        </div>
        <div id="logout" onclick="logout()">
            Đăng xuất
        </div>
    </div>
</header>

<body>
    <div class="management-section" id="order-section">
        <div class="tab-order-section" id="tab-order-get">
            <table id="order">
                <thead>
                    <th>STT</th>
                    <th>Tên người mua</th>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Tống tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </thead>
                <tbody></tbody>
            </table>
            <!-- Phân trang -->
            <div id="pagination">
                <span onclick="firstPage()">
                    << </span>
                        <span onclick="prevPage()">
                            < </span>
                                <div id="div-pagination-0"></div>
                                <span onclick="nextPage()"> > </span>
                                <span onclick="lastPage()"> >> </span>
            </div>
        </div>
        <div class="div-detail" id="detail">
            <div class="detail">
                <h2>Thông tin chi tiết đơn hàng </h2>
                <table id="cart">
                    <thead>
                        <th> STT </th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div>
                    <div id="total"></div>
                </div>
                <div id="return">Quay về</div>

            </div>
        </div>
    </div>

    <div class="management-section" id="milk-section">
        <button class="tab-milk-detail" onclick="showTabInMilkSection('get')">
            Xem danh sách sữa
        </button>
        <button class="tab-milk-detail" onclick="showTabInMilkSection('add')">
            Thêm sữa mới
        </button>
        <div class="tab-milk-section" id="tab-milk-get">
            <table id="milkTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên Sữa</th>
                        <th>Hãng Sữa</th>
                        <th>Loại</th>
                        <th>Trọng Lượng</th>
                        <th>Giá</th>
                        <th>Thành Phần Dinh Dưỡng</th>
                        <th>Lợi ích</th>
                        <th>Edit</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dữ liệu từ fetch sẽ được thêm vào đây -->
                </tbody>
            </table>
            <!-- Phân trang -->
            <div id="pagination">
                <span onclick="firstPage()">
                    << </span>
                        <span onclick="prevPage()">
                            < </span>
                                <div id="div-pagination"></div>
                                <span onclick="nextPage()"> > </span>
                                <span onclick="lastPage()"> >> </span>
            </div>
        </div>
        <div class="tab-milk-section" id="tab-milk-add">
            <form id="addMilkForm">
                <h2>Thêm Sữa Mới</h2>
                <label for="id1">Mã Sữa</label>
                <input type="text" id="id1" name="id" required />

                <label for="name1">Tên Sữa</label>
                <input type="text" id="name1" name="name" required />

                <label for="brand1">Hãng Sữa</label>
                <select id="brand1" name="brand" required></select>

                <label for="type1">Loại</label>
                <select type="text" id="type1" name="type" required>
                    <option value="Sữa bột">Sữa bột</option>
                    <option value="Sữa nước">Sữa nước</option>
                </select>

                <label for="weight1">Trọng Lượng</label>
                <input type="text" id="weight1" name="weight" required />

                <label for="price1">Giá</label>
                <input type="text" id="price1" name="price" required />

                <label for="nutritionalIngredients1">Thành Phần Dinh Dưỡng</label>
                <textarea id="nutritionalIngredients1" name="nutritionalIngredients"></textarea>
                <label for="benefit1">Lợi ích</label>
                <textarea type="text" id="benefit1" name="benefit"></textarea>
                <label for="image1">Ảnh</label>
                <input type="file" id="image1" name="image" />
                <input type="submit" value="Thêm Sữa Mới" />
            </form>
        </div>
        <div class="tab-milk-section" id="tab-milk-update">
            <form id="updateMilkForm">
                <h2>Sửa Sữa</h2>
                <label for="id">Mã Sữa</label>
                <input type="text" id="id" name="id" readonly />

                <label for="name">Tên Sữa</label>
                <input type="text" id="name" name="name" required />

                <label for="brand">Hãng Sữa</label>
                <select id="brand" name="brand" required></select>

                <label for="type">Loại</label>
                <select type="text" id="type" name="type" required>
                    <option value="Sữa bột">Sữa bột</option>
                    <option value="Sữa nước">Sữa nước</option>
                </select>

                <label for="weight">Trọng Lượng</label>
                <input type="text" id="weight" name="weight" required />

                <label for="price">Giá</label>
                <input type="text" id="price" name="price" required />

                <label for="nutritionalIngredients">Thành Phần Dinh Dưỡng</label>
                <textarea id="nutritionalIngredients" name="nutritionalIngredients"></textarea>
                <label for="benefit">Lợi ích</label>
                <textarea type="text" id="benefit" name="benefit"></textarea>
                <label for="image">Ảnh</label>
                <input type="file" id="image" name="image" />
                <input type="submit" value="Sửa Sữa" />
            </form>
        </div>
    </div>

    <div class="management-section" id="brand-section">
        <button class="tab-brand-detail" onclick="showTabInBrandSection('get')">
            Xem danh sách Hãng sữa
        </button>
        <button class="tab-brand-detail" onclick="showTabInBrandSection('add')">
            Thêm Hãng sữa mới
        </button>
        <div class="tab-brand-section tab-brand-active" id="tab-brand-get">
            <table id="brandTable">
                <thead>
                    <tr>
                        <th>Mã HS</th>
                        <th>Tên hãng sữa</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dữ liệu từ fetch sẽ được thêm vào đây -->
                </tbody>
            </table>
            <!-- Phân trang -->
            <div id="pagination">
                <span onclick="firstPage()">
                    << </span>
                        <span onclick="prevPage()">
                            < </span>
                                <div id="div-pagination-2"></div>
                                <span onclick="nextPage()"> > </span>
                                <span onclick="lastPage()"> >> </span>
            </div>
        </div>
        <div class="tab-brand-section" id="tab-brand-add">
            <form id="addBrandForm">
                <h2>Thêm Hãng Sữa Mới</h2>
                <label for="id2">Mã Hãng Sữa</label>
                <input type="text" id="id2" name="id" required />

                <label for="name2">Tên Hãng Sữa</label>
                <input type="text" id="name2" name="name" required />

                <label for="address2">Địa chỉ</label>
                <input type="text" id="address2" name="address" required />

                <label for="phone2">Số điện thoại</label>
                <input type="text" id="phone2" name="phoneNumber" required />

                <label for="email2">Email</label>
                <input type="text" id="email2" name="email" required />

                <input type="submit" value="Thêm Hãng Sữa Mới" />
            </form>
        </div>
        <div class="tab-brand-section" id="tab-brand-update">
            <form id="updateBrandForm">
                <h2>Sửa Hãng Sữa</h2>
                <label for="idBrand">Mã Hãng Sữa</label>
                <input type="text" id="idBrand" name="id" readonly />
                <label for="nameBrand">Tên Hãng Sữa</label>
                <input type="text" id="nameBrand" name="name" required />

                <label for="address">Địa chỉ</label>
                <input type="text" id="address" name="address" required />

                <label for="phon">Số điện thoại</label>
                <input type="text" id="phone" name="phoneNumber" required />

                <label for="email">Email</label>
                <input type="text" id="email" name="email" required />

                <input type="submit" value="Sửa Hãng Sữa" />
            </form>
        </div>
        <div class="tab-brand-section" id="tab-brand-delete"></div>
    </div>

    <div class="management-section" id="user-section">
        <button class="tab-user-detail" onclick="showTabInUserSection('get')">
            Xem danh sách Khách hàng
        </button>
        <button class="tab-user-detail" onclick="showTabInUserSection('add')">
            Thêm Khách hàng mới
        </button>
        <div class="tab-user-section tab-user-active" id="tab-user-get">
            <table id="userTable">
                <thead>
                    <tr>
                        <th>Mã KH</th>
                        <th>Tên khách hàng</th>
                        <th>Giới tính</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dữ liệu từ fetch sẽ được thêm vào đây -->
                </tbody>
            </table>
            <!-- Phân trang -->
            <div id="pagination">
                <span onclick="firstPage()">
                    << </span>
                        <span onclick="prevPage()">
                            < </span>
                                <div id="div-pagination-3"></div>
                                <span onclick="nextPage()"> > </span>
                                <span onclick="lastPage()"> >> </span>
            </div>
        </div>
        <div class="tab-user-section" id="tab-user-add">
            <form id="addUserForm">
                <h2>Thêm Người dùng Mới</h2>

                <label for="name3">Tên Người dùng</label>
                <input type="text" id="name3" name="name" required />

                <label>Giới tính</label>
                <input class="group-radio" type="radio" id="sex" name="sex" value="1" checked required />
                <label class="group-radio" for="sex">Nam</label>
                <input class="group-radio" type="radio" id="sex1" name="sex" value="0" required />
                <label class="group-radio" for="sex1">Nữ</label>

                <label for="address3">Địa chỉ</label>
                <input type="text" id="address3" name="address" required />

                <label for="phone3">Số điện thoại</label>
                <input type="text" id="phone3" name="phone" required />

                <label for="email3">Email</label>
                <input type="text" id="email3" name="email" required />

                <input type="submit" value="Thêm Người dùng Mới" />
            </form>
        </div>
        <div class="tab-user-section" id="tab-user-update">
            <form id="updateUserForm">
                <h2>Sửa Thông tin Người dùng</h2>
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
                <input type="submit" value="Sửa người dùng" />
            </form>
        </div>
        <div class="tab-user-section" id="tab-user-delete"></div>
    </div>

    <script>
    let section = "";
    let userLogin = null;
    window.onload = function() {
        showSection("order");
        userLogin = JSON.parse(localStorage.getItem("user"));
        if (userLogin.role) {
            if (userLogin.role != 1)
                window.location.href = "http://localhost:81/api/web/MilkManagementUser.php"
        } else
            window.location.href = "http://localhost:81/api/web/HomePage.php"
    };

    function showSection(sectionId) {
        currentPage = 1;
        section = sectionId;
        if (sectionId === "order") showTabInOrderSection("get");
        if (sectionId === "milk") showTabInMilkSection("get");
        if (sectionId === "brand") showTabInBrandSection("get");
        if (sectionId === "user") showTabInUserSection("get");
        document.querySelectorAll(".management-section").forEach((section) => {
            section.classList.remove("active-section");
        });
        document
            .getElementById(`${sectionId}-section`)
            .classList.add("active-section");
        document.querySelectorAll(".tab-detail").forEach((section) => {
            section.classList.remove("active-tab");
        });
        document.getElementById(`tab-${sectionId}`).classList.add("active-tab");
    }

    function showTabInUserSection(type, id) {
        document.querySelectorAll(".tab-user-section").forEach((section) => {
            section.classList.remove("tab-user-active");
        });
        document
            .getElementById(`tab-user-${type}`)
            .classList.add("tab-user-active");

        document.querySelectorAll(".tab-user-detail").forEach((section) => {
            section.classList.remove("active-tab-user");
        });
        document
            .getElementById(`tab-user-${type}`)
            .classList.add("active-tab-user");
        if (type === "get") getUserData();
        else if (type === "add") {
            // getAllBrandBrand(1);
        } else if (type === "update") {
            // getAllBrandBrand("");
            getUserById(id);
        }
    }

    function showTabInBrandSection(type, id) {
        document.querySelectorAll(".tab-brand-section").forEach((section) => {
            section.classList.remove("tab-brand-active");
        });
        document
            .getElementById(`tab-brand-${type}`)
            .classList.add("tab-brand-active");

        document.querySelectorAll(".tab-brand-detail").forEach((section) => {
            section.classList.remove("active-tab-brand");
        });
        document
            .getElementById(`tab-brand-${type}`)
            .classList.add("active-tab-brand");
        if (type === "get") getBrandData();
        else if (type === "add") {
            // getAllBrandBrand(1);
        } else if (type === "update") {
            // getAllBrandBrand("");
            getBrandById(id);
        }
    }

    function showTabInMilkSection(type, id) {
        document.querySelectorAll(".tab-milk-section").forEach((section) => {
            section.classList.remove("tab-milk-active");
        });
        document
            .getElementById(`tab-milk-${type}`)
            .classList.add("tab-milk-active");

        document.querySelectorAll(".tab-milk-detail").forEach((section) => {
            section.classList.remove("active-tab-milk");
        });
        document
            .getElementById(`tab-milk-${type}`)
            .classList.add("active-tab-milk");
        if (type === "get") getMilkData();
        else if (type === "add") {
            getAllMilkBrand(1);
        } else if (type === "update") {
            getAllMilkBrand("");
            getMilkById(id);
        }
    }

    function showTabInOrderSection(type, id) {
        document.querySelectorAll(".tab-order-section").forEach((section) => {
            section.classList.remove("tab-order-active");
        });
        document
            .getElementById(`tab-order-${type}`)
            .classList.add("tab-order-active");

        document.querySelectorAll(".tab-order-detail").forEach((section) => {
            section.classList.remove("active-tab-order");
        });
        document
            .getElementById(`tab-order-${type}`)
            .classList.add("active-tab-order");
        if (type === "get") getOrderData();

    }

    function getMilkById(id) {
        fetch(`http://localhost:81/api/get-one-milk.php?id=${id}`)
            .then((response) => response.json())
            .then((data) => {
                populateUpdateMilk(data);
            })
            .catch((error) => console.error("Error:", error));
    }

    function getBrandById(id) {
        fetch(`http://localhost:81/api/get-one-milk-brand.php?id=${id}`)
            .then((response) => response.json())
            .then((data) => {
                populateUpdateBrand(data);
            })
            .catch((error) => console.error("Error:", error));
    }

    function getUserById(id) {
        fetch(`http://localhost:81/api/get-one-user.php?id=${id}`)
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
    }

    function populateUpdateBrand(data) {
        document.getElementById("idBrand").value = data.id;
        document.getElementById("nameBrand").value = data.name;
        document.getElementById("address").value = data.address;
        document.getElementById("phone").value = data.phoneNumber;
        document.getElementById("email").value = data.email;
    }

    function populateUpdateMilk(data) {
        document.getElementById("id").value = data.id;
        document.getElementById("name").value = data.name;
        document.getElementById("brand").value = data.brand;
        document.getElementById("type").value = data.type;
        document.getElementById("weight").value = data.weight;
        document.getElementById("price").value = data.price;
        document.getElementById("nutritionalIngredients").value =
            data.nutritionalIngredients;
        document.getElementById("benefit").value = data.benefit;
    }

    function getAllMilkBrand(number) {
        fetch("http://localhost:81/api/get-all-milk-brand.php")
            .then((response) => response.json())
            .then((data) => {
                populateBrandDropdown(data, number);
            })
            .catch((error) => console.error("Error:", error));
    }

    function populateBrandDropdown(data, number) {
        const brandDropdown = document.getElementById(`brand${number}`);
        brandDropdown.innerHTML = "";
        data.forEach((brand) => {
            const option = document.createElement("option");
            option.value = brand.id;
            option.text = brand.name;
            brandDropdown.add(option);
        });
    }

    function changeStatusMilk(id) {
        fetch(`http://localhost:81/api/change-milk.php?id=${id}`, {
                method: "GET",
            })
            .then((response) => {
                response.json();
                getMilkData();
            })
            .then((data) => console.log(data))
            .catch((error) => console.error("Error:", error));
    }

    function changeStatusBrand(id) {
        fetch(`http://localhost:81/api/change-milk-brand.php?id=${id}`, {
                method: "GET",
            })
            .then((response) => {
                response.json();
                getBrandData();
            })
            .then((data) => console.log(data))
            .catch((error) => console.error("Error:", error));
    }

    function changeStatusUser(id) {
        fetch(`http://localhost:81/api/change-user.php?id=${id}`, {
                method: "GET",
            })
            .then((response) => {
                response.json();
                getUserData();
            })
            .then((data) => console.log(data))
            .catch((error) => console.error("Error:", error));
    }

    const rowsPerPage = 5;
    let currentPage = 1;
    let dataCurrent = [];

    function showDataOnPage() {
        const totalPages = Math.ceil(dataCurrent.length / rowsPerPage);
        for (let i = 1; i <= totalPages; i++) {
            document.getElementById("pagination-" + i).style.color = "black";
        }
        if (document.getElementById("pagination-" + currentPage))
            document.getElementById("pagination-" + currentPage).style.color =
            "red";
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const pageData = dataCurrent.slice(startIndex, endIndex);
        if (section === "order") displayOrderData(pageData);
        if (section === "milk") displayMilkData(pageData);
        if (section === "brand") displayBrandData(pageData);
        if (section === "user") displayUserData(pageData);
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            showDataOnPage();
        }
    }

    function nextPage() {
        const totalPages = Math.ceil(dataCurrent.length / rowsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            showDataOnPage();
        }
    }

    function firstPage() {
        currentPage = 1;
        showDataOnPage();
    }

    function lastPage() {
        const totalPages = Math.ceil(dataCurrent.length / rowsPerPage);
        currentPage = totalPages;
        showDataOnPage();
    }

    function getOrderData() {
        fetch("http://localhost:81/api/get-all-order.php")
            .then((response) => response.json())
            .then((data) => {
                dataCurrent = data;
                const totalPages = Math.ceil(dataCurrent.length / rowsPerPage);
                const pagination = document.getElementById("div-pagination-0");
                pagination.innerHTML = "";
                for (let i = 1; i <= totalPages; i++) {
                    const pageBtn = document.createElement("span");
                    pageBtn.id = "pagination-" + i;
                    pageBtn.style.textDecoration = "underline";
                    pageBtn.style.cursor = "pointer";
                    if (i === 1) pageBtn.style.color = "red";
                    pageBtn.textContent = i;
                    pageBtn.classList.add("page-btn");
                    pageBtn.addEventListener("click", () => {
                        currentPage = i;
                        showDataOnPage();
                    }); // Thay đổi hàm sửa theo ý muốn
                    pagination.appendChild(pageBtn);
                }
                showDataOnPage();
            })
            .catch((error) => console.error("Error:", error));
    }

    function getMilkData() {
        fetch("http://localhost:81/api/get-all-milk.php")
            .then((response) => response.json())
            .then((data) => {
                dataCurrent = data;
                const totalPages = Math.ceil(dataCurrent.length / rowsPerPage);
                const pagination = document.getElementById("div-pagination");
                pagination.innerHTML = "";
                for (let i = 1; i <= totalPages; i++) {
                    const pageBtn = document.createElement("span");
                    pageBtn.id = "pagination-" + i;
                    pageBtn.style.textDecoration = "underline";
                    pageBtn.style.cursor = "pointer";
                    if (i === 1) pageBtn.style.color = "red";
                    pageBtn.textContent = i;
                    pageBtn.classList.add("page-btn");
                    pageBtn.addEventListener("click", () => {
                        currentPage = i;
                        showDataOnPage();
                    }); // Thay đổi hàm sửa theo ý muốn
                    pagination.appendChild(pageBtn);
                }
                showDataOnPage();
            })
            .catch((error) => console.error("Error:", error));
    }
    let detail = null;

    function displayOrderData(data) {
        fetch("http://localhost:81/api/get-all-user.php")
            .then((response) => response.json())
            .then((users) => {
                const tableBody = document
                    .getElementById("order")
                    .getElementsByTagName("tbody")[0];
                tableBody.innerHTML = "";
                data.forEach((order, index) => {
                    const currentUser = users.find(u => u.id == order.user);
                    const row = tableBody.insertRow();

                    const cell1 = row.insertCell(0);
                    cell1.style.width = "120px";
                    cell1.style.textAlign = "center";

                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    const cell4 = row.insertCell(3);
                    const cell5 = row.insertCell(4);
                    const cell6 = row.insertCell(5);
                    const cell7 = row.insertCell(6);
                    const cell8 = row.insertCell(7);
                    const cell9 = row.insertCell(8);
                    const sttElement = document.createElement("p");
                    sttElement.textContent = index + 1;

                    cell1.appendChild(sttElement);
                    const nameElement0 = document.createElement("p");
                    nameElement0.style.textAlign = "center";
                    nameElement0.textContent = currentUser?.id == 1 ? "Khách vãng lai" : currentUser.name;
                    cell2.appendChild(nameElement0);
                    const nameElement1 = document.createElement("p");
                    nameElement1.style.textAlign = "center";
                    nameElement1.textContent = order.fullName;
                    cell3.appendChild(nameElement1);
                    const nameElement2 = document.createElement("p");
                    nameElement2.style.textAlign = "center";
                    nameElement2.textContent = order.address;
                    cell4.appendChild(nameElement2);
                    const nameElement3 = document.createElement("p");
                    nameElement3.style.textAlign = "center";
                    nameElement3.textContent = order.phoneNumber;
                    cell5.appendChild(nameElement3);
                    const nameElement4 = document.createElement("p");
                    nameElement4.style.textAlign = "center";
                    nameElement4.textContent = order.email;
                    cell6.appendChild(nameElement4);

                    const nameElement = document.createElement("h3");
                    nameElement.style.textAlign = "center";
                    nameElement.textContent = order.total + " VNĐ";
                    cell7.appendChild(nameElement);

                    const statusElement = document.createElement("h3");
                    statusElement.style.textAlign = "center";
                    statusElement.textContent = order.status == 0 ? "Chờ xác nhận" : order.status == 1 ?
                        "Đã xác nhận" :
                        order.status == 2 ? "Đã giao" : "Đã hủy";
                    cell8.appendChild(statusElement);

                    const detailElement = document.createElement("p");
                    detailElement.textContent = "Xem chi tiết";
                    detailElement.style.textAlign = "center";
                    detailElement.style.margin = "5px auto";
                    detailElement.style.padding = "5px 10px";
                    detailElement.style.border = "1px solid black";
                    detailElement.style.backgroundColor = "red"
                    detailElement.style.width = "120px"
                    detailElement.style.border = "3px";
                    detailElement.style.color = "white"
                    detailElement.style.cursor = "pointer";
                    detailElement.addEventListener("click", () => {
                        detail = order;
                        showDetail();
                    });
                    cell9.appendChild(detailElement);

                    const updateStatusElement = document.createElement("p");

                    updateStatusElement.textContent = order.status == 0 ? "Xác nhận" : "Đã giao";
                    updateStatusElement.style.textAlign = "center";
                    updateStatusElement.style.margin = "5px auto";
                    updateStatusElement.style.padding = "5px 10px";
                    updateStatusElement.style.border = "1px solid black";
                    updateStatusElement.style.backgroundColor = "red"
                    updateStatusElement.style.width = "120px"
                    updateStatusElement.style.border = "3px";
                    updateStatusElement.style.color = "white"
                    updateStatusElement.style.cursor = "pointer";
                    updateStatusElement.addEventListener("click", () => {
                        updateStatusOrder(order.id, parseInt(order.status) + 1);
                    });
                    if (order.status == 0 || order.status == 1)
                        cell9.appendChild(updateStatusElement);

                    const cancelStatusElement = document.createElement("p");
                    cancelStatusElement.textContent = "Hủy đơn";
                    cancelStatusElement.style.textAlign = "center";
                    cancelStatusElement.style.margin = "5px auto";
                    cancelStatusElement.style.padding = "5px 10px";
                    cancelStatusElement.style.border = "1px solid black";
                    cancelStatusElement.style.backgroundColor = "red"
                    cancelStatusElement.style.width = "120px"
                    cancelStatusElement.style.border = "3px";
                    cancelStatusElement.style.color = "white"
                    cancelStatusElement.style.cursor = "pointer";
                    cancelStatusElement.addEventListener("click", () => {
                        updateStatusOrder(order.id, 3);
                    });
                    if (order.status == 0 || order.status == 1)
                        cell9.appendChild(cancelStatusElement);
                });
            })
            .catch((error) => console.error("Error:", error));
    }

    function updateStatusOrder(id, status) {
        fetch(`http://localhost:81/api/put-order.php?id=${id}&status=${status}`, {
                method: "GET",
            })
            .then((response) => {
                response.json();
                getOrderData();
            })
            .then((data) => console.log(data))
            .catch((error) => console.error("Error:", error));
    }
    let total = 0;

    function showDetail() {
        document.getElementById("return").addEventListener("click", () => {
            unShowDetail();
            detail = null;
        });
        fetch(`http://localhost:81/api/get-all-milk-brand.php`)
            .then((response) => response.json())
            .then((brands) => {
                fetch(`http://localhost:81/api/get-cart-by-ids.php?ids=${detail.carts}`)
                    .then((response) => response.json())
                    .then((carts) => {
                        fetch("http://localhost:81/api/get-all-milk.php")
                            .then((response) => response.json())
                            .then((milks) => {
                                const tableBody = document
                                    .getElementById("cart")
                                    .getElementsByTagName("tbody")[0];
                                tableBody.innerHTML = "";
                                carts.forEach((cart, index) => {
                                    const milk = milks.find(m => m.id = cart.milk);
                                    total += milk.price * cart.quantity;
                                    const currentBrand = brands.find((b) => b.id === milk.brand);

                                    const row = tableBody.insertRow();
                                    const cell1 = row.insertCell(0);
                                    cell1.style.textAlign = "center";

                                    const cell2 = row.insertCell(1);
                                    const cell3 = row.insertCell(2);
                                    cell3.style.textAlign = "center";
                                    const cell4 = row.insertCell(3);
                                    cell4.style.textAlign = "center";
                                    const cell5 = row.insertCell(4);

                                    const sttElement = document.createElement("p");
                                    sttElement.textContent = index + 1;
                                    cell1.appendChild(sttElement);

                                    const nameElement = document.createElement("p");
                                    nameElement.textContent = milk.name + " - " + currentBrand.name;
                                    nameElement.style.marginBottom = "20px";
                                    cell2.appendChild(nameElement);

                                    const priceElement = document.createElement("p");
                                    priceElement.textContent = milk.price;
                                    cell3.appendChild(priceElement);

                                    const quantityElement = document.createElement("p");
                                    quantityElement.textContent = cart.quantity;
                                    cell4.appendChild(quantityElement);

                                });
                                document.getElementById("total").textContent = `Total: ${total} VNĐ`;
                            })
                            .catch((error) => console.error("Error:", error));
                    })
                    .catch((error) => console.error("Error:", error));
            })
            .catch((error) => console.error("Error:", error));
        document.getElementById("detail").classList.add("show");

    }

    function unShowDetail() {
        document.getElementById("detail").classList.remove("show");
    }

    function displayMilkData(data) {
        fetch("http://localhost:81/api/get-all-milk-brand.php")
            .then((response) => response.json())
            .then((milkBrand) => {
                const tableBody = document
                    .getElementById("milkTable")
                    .getElementsByTagName("tbody")[0];

                // Xóa nội dung cũ của bảng
                tableBody.innerHTML = "";

                // Duyệt qua danh sách và thêm từng dòng vào bảng
                data.forEach((milk) => {
                    const row = tableBody.insertRow();
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    const cell4 = row.insertCell(3);
                    const cell5 = row.insertCell(4);
                    const cell6 = row.insertCell(5);
                    const cell7 = row.insertCell(6);
                    const cell8 = row.insertCell(7);
                    const cell9 = row.insertCell(8);
                    const cell10 = row.insertCell(9);
                    const cell11 = row.insertCell(10);

                    cell1.textContent = milk.id;
                    cell3.textContent = milk.name;
                    cell4.textContent =
                        milkBrand.find((mb) => mb.id === milk.brand)?.name ||
                        milkBrand.brand;
                    cell5.textContent = milk.type;
                    cell6.textContent = milk.weight;
                    cell7.textContent = milk.price;
                    cell8.textContent = milk.nutritionalIngredients;
                    cell9.textContent = milk.benefit;

                    // Hiển thị hình ảnh
                    const imageElement = document.createElement("img");
                    imageElement.style.height = "80px";
                    imageElement.src =
                        "http://localhost:81/api/imageUpload/" + milk.image;
                    imageElement.alt = milk.name;
                    cell2.appendChild(imageElement);

                    // Thêm nút Edit
                    const editBtn = document.createElement("span");
                    editBtn.style.textDecoration = "underline";
                    editBtn.style.cursor = "pointer";
                    editBtn.textContent = "Edit";
                    editBtn.classList.add("edit-btn");
                    editBtn.addEventListener("click", () =>
                        showTabInMilkSection("update", milk.id)
                    ); // Thay đổi hàm sửa theo ý muốn
                    cell10.appendChild(editBtn);

                    // Thêm nút Delete
                    const deleteBtn = document.createElement("span");
                    deleteBtn.style.textDecoration = "underline";
                    deleteBtn.style.cursor = "pointer";
                    deleteBtn.textContent = milk.status == 1 ? "Enable" : "Disable";
                    deleteBtn.classList.add("change-status-btn");
                    deleteBtn.addEventListener("click", () =>
                        changeStatusMilk(milk.id)
                    ); // Thay đổi hàm xóa theo ý muốn
                    cell11.appendChild(deleteBtn);
                });
            })
            .catch((error) => console.error("Error:", error));
    }

    function getBrandData(number) {
        fetch("http://localhost:81/api/get-all-milk-brand.php")
            .then((response) => response.json())
            .then((data) => {
                dataCurrent = data;
                const totalPages = Math.ceil(dataCurrent.length / rowsPerPage);
                console.log(totalPages);
                const pagination = document.getElementById("div-pagination-2");
                pagination.innerHTML = "";
                for (let i = 1; i <= totalPages; i++) {
                    const pageBtn = document.createElement("span");
                    pageBtn.id = "pagination-" + i;
                    pageBtn.style.textDecoration = "underline";
                    pageBtn.style.cursor = "pointer";
                    if (i === 1) pageBtn.style.color = "red";
                    pageBtn.textContent = i;
                    pageBtn.classList.add("page-btn");
                    pageBtn.addEventListener("click", () => {
                        currentPage = i;
                        showDataOnPage();
                    }); // Thay đổi hàm sửa theo ý muốn
                    pagination.appendChild(pageBtn);
                }
                showDataOnPage();
            })
            .catch((error) => console.error("Error:", error));
    }

    function displayBrandData(data) {
        const tableBody = document
            .getElementById("brandTable")
            .getElementsByTagName("tbody")[0];

        // Xóa nội dung cũ của bảng
        tableBody.innerHTML = "";

        // Duyệt qua danh sách và thêm từng dòng vào bảng
        data.forEach((brand) => {
            const row = tableBody.insertRow();
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            const cell3 = row.insertCell(2);
            const cell4 = row.insertCell(3);
            const cell5 = row.insertCell(4);
            const cell6 = row.insertCell(5);
            const cell7 = row.insertCell(6);

            cell1.textContent = brand.id;
            cell2.textContent = brand.name;
            cell3.textContent = brand.address;
            cell4.textContent = brand.phoneNumber;
            cell5.textContent = brand.email;

            // Thêm nút Edit
            const editBtn = document.createElement("span");
            editBtn.style.textDecoration = "underline";
            editBtn.style.cursor = "pointer";
            editBtn.textContent = "Edit";
            editBtn.classList.add("edit-btn");
            editBtn.addEventListener("click", () =>
                showTabInBrandSection("update", brand.id)
            ); // Thay đổi hàm sửa theo ý muốn
            cell6.appendChild(editBtn);

            // Thêm nút Delete
            const deleteBtn = document.createElement("span");
            deleteBtn.style.textDecoration = "underline";
            deleteBtn.style.cursor = "pointer";
            deleteBtn.textContent = brand.status == 1 ? "Enable" : "Disable";
            deleteBtn.classList.add("change-status-btn");
            deleteBtn.addEventListener("click", () =>
                changeStatusBrand(brand.id)
            ); // Thay đổi hàm xóa theo ý muốn
            cell7.appendChild(deleteBtn);
        });
    }

    function getUserData(number) {
        fetch("http://localhost:81/api/get-all-user.php")
            .then((response) => response.json())
            .then((data) => {
                dataCurrent = data;
                const totalPages = Math.ceil(dataCurrent.length / rowsPerPage);
                console.log(totalPages);
                const pagination = document.getElementById("div-pagination-3");
                pagination.innerHTML = "";
                for (let i = 1; i <= totalPages; i++) {
                    const pageBtn = document.createElement("span");
                    pageBtn.id = "pagination-" + i;
                    pageBtn.style.textDecoration = "underline";
                    pageBtn.style.cursor = "pointer";
                    if (i === 1) pageBtn.style.color = "red";
                    pageBtn.textContent = i;
                    pageBtn.classList.add("page-btn");
                    pageBtn.addEventListener("click", () => {
                        currentPage = i;
                        showDataOnPage();
                    }); // Thay đổi hàm sửa theo ý muốn
                    pagination.appendChild(pageBtn);
                }
                showDataOnPage();
            })
            .catch((error) => console.error("Error:", error));
    }

    function displayUserData(data) {
        const tableBody = document
            .getElementById("userTable")
            .getElementsByTagName("tbody")[0];

        // Xóa nội dung cũ của bảng
        tableBody.innerHTML = "";

        // Duyệt qua danh sách và thêm từng dòng vào bảng
        data.forEach((user) => {
            const row = tableBody.insertRow();
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            const cell3 = row.insertCell(2);
            const cell4 = row.insertCell(3);
            const cell5 = row.insertCell(4);
            const cell6 = row.insertCell(5);
            const cell7 = row.insertCell(6);
            const cell8 = row.insertCell(7);

            cell1.textContent = user.id;
            cell2.textContent = user.name;
            cell3.textContent = user.sex == 1 ? "Nam" : "Nữ";
            cell4.textContent = user.address;
            cell5.textContent = user.phone;
            cell6.textContent = user.email;

            // Thêm nút Edit
            const editBtn = document.createElement("span");
            editBtn.style.textDecoration = "underline";
            editBtn.style.cursor = "pointer";
            editBtn.textContent = "Edit";
            editBtn.classList.add("edit-btn");
            editBtn.addEventListener("click", () =>
                showTabInUserSection("update", user.id)
            ); // Thay đổi hàm sửa theo ý muốn
            cell7.appendChild(editBtn);

            // Thêm nút Delete
            const deleteBtn = document.createElement("span");
            deleteBtn.style.textDecoration = "underline";
            deleteBtn.style.cursor = "pointer";
            deleteBtn.textContent = user.status == 1 ? "Enable" : "Disable";
            deleteBtn.classList.add("change-status-btn");
            deleteBtn.addEventListener("click", () => changeStatusUser(user
                .id)); // Thay đổi hàm xóa theo ý muốn
            cell8.appendChild(deleteBtn);
        });
    }
    </script>
    <script>
    document
        .getElementById("addMilkForm")
        .addEventListener("submit", function(event) {
            event.preventDefault();

            function addMilk() {
                const formData = new FormData(
                    document.getElementById("addMilkForm")
                );
                fetch("http://localhost:81/api/post-milk.php", {
                        method: "POST",
                        body: formData,
                    })
                    .then((data) => {
                        console.log(data);
                        alert("Add Milk Success");
                        showTabInMilkSection("get");
                    })
                    .catch((error) => console.error("Error:", error));
            }
            addMilk();
        });

    document
        .getElementById("updateMilkForm")
        .addEventListener("submit", function(event) {
            event.preventDefault();

            function updateMilk() {
                const formData = new FormData(
                    document.getElementById("updateMilkForm")
                );
                fetch(`http://localhost:81/api/put-milk.php`, {
                        method: "POST",
                        body: formData,
                    })
                    .then((data) => {
                        console.log(data);
                        alert("Update Milk Success");
                        showTabInMilkSection("get");
                    })
                    .catch((error) => console.error("Error:", error));
            }
            updateMilk();
        });

    document
        .getElementById("addBrandForm")
        .addEventListener("submit", function(event) {
            event.preventDefault();

            function addBrand() {
                const formData = new FormData(
                    document.getElementById("addBrandForm")
                );
                fetch("http://localhost:81/api/post-milk-brand.php", {
                        method: "POST",
                        body: formData,
                    })
                    .then((data) => {
                        console.log(data);
                        alert("Add Milk Brand Success");
                        showTabInBrandSection("get");
                    })
                    .catch((error) => console.error("Error:", error));
            }
            addBrand();
        });

    document
        .getElementById("updateBrandForm")
        .addEventListener("submit", function(event) {
            event.preventDefault();

            function updateBrand() {
                const formData = new FormData(
                    document.getElementById("updateBrandForm")
                );
                fetch(`http://localhost:81/api/put-milk-brand.php`, {
                        method: "POST",
                        body: formData,
                    })
                    .then((data) => {
                        console.log(data);
                        alert("Update Milk Brand Success");
                        showTabInBrandSection("get");
                    })
                    .catch((error) => console.error("Error:", error));
            }
            updateBrand();
        });

    document
        .getElementById("addUserForm")
        .addEventListener("submit", function(event) {
            event.preventDefault();

            function addUser() {
                const formData = new FormData(
                    document.getElementById("addUserForm")
                );
                fetch("http://localhost:81/api/post-user.php", {
                        method: "POST",
                        body: formData,
                    })
                    .then((data) => {
                        console.log(data);
                        alert("Add User Success");
                        showTabInUserSection("get");
                    })
                    .catch((error) => console.error("Error:", error));
            }
            addUser();
        });

    document
        .getElementById("updateUserForm")
        .addEventListener("submit", function(event) {
            event.preventDefault();

            function updateUser() {
                const formData = new FormData(
                    document.getElementById("updateUserForm")
                );
                fetch(`http://localhost:81/api/put-user.php`, {
                        method: "POST",
                        body: formData,
                    })
                    .then((data) => {
                        console.log(data);
                        alert("Update User Success");
                        showTabInUserSection("get");
                    })
                    .catch((error) => console.error("Error:", error));
            }
            updateUser();
        });
    </script>
    <script>
    function logout() {
        localStorage.clear();
        window.location.href = "http://localhost:81/api/web/HomePage.php";
    }
    </script>
</body>

</html>