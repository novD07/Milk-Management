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

        #logout,
        #login {
            background-color: red;
            color: white;
            font-weight: bold;
        }

        #checkOut {
            text-align: center;
            width: 150px;
            background-color: aqua;
            font-weight: bold;
            font-size: 18px;
            border: 1px solid black;
            padding: 8px 16px;
            border-radius: 3px;
            margin-left: auto;
            margin-right: 100px;
            cursor: pointer;
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

        .tab-detail {
            display: none
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
        <div class="tab-detail hidden" onclick="handleNavigate(2)">
            Thông tin đơn hàng
        </div>
        <div class="tab-detail hidden" onclick="handleNavigate(3)">
            Thông tin cá nhân
        </div>
        <div id="logout" class="tab-detail hidden" onclick="logout()">
            Đăng xuất
        </div>
        <div id="login" class="tab-detail hidden2" onclick="login()">
            Đăng nhập
        </div>
    </div>
</header>
<h2>Thông tin giỏ hàng</h2>

<body>
    <table id="cart">
        <thead>
            <th> STT </th>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Xóa</th>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div id="pagination">
        <span onclick="firstPage()">
            << </span>
                <span onclick="prevPage()">
                    < </span>
                        <div id="div-pagination"></div>
                        <span onclick="nextPage()"> > </span>
                        <span onclick="lastPage()"> >> </span>
    </div>
    <div>
        <div id="total"></div>
        <div id="checkOut">Mua hàng</div>
    </div>
    <form id="shippingForm">

        <h2>Thông tin Giao hàng</h2>
        <label for="name">Tên Người nhận</label>
        <input type="text" id="name" name="fullName" required />


        <label for="address">Địa chỉ</label>
        <input type="text" id="address" name="address" required />

        <label for="phone">Số điện thoại</label>
        <input type="text" id="phone" name="phoneNumber" required />

        <label for="email">Email</label>
        <input type="text" id="email" name="email" required />


    </form>
    <script>
        let userLogin = null;
        let brands = [];
        let detail = null;
        window.onload = function() {
            userLogin = JSON.parse(localStorage.getItem("user"));
            if (userLogin?.role == 1)
                window.location.href = "http://localhost:81/api/web/MilkManagementAdmin.php"
            else {
                if (!userLogin)
                    document.querySelectorAll(".hidden2").forEach((t, index) => {
                        t.style.display = "block";
                    })
                else {
                    document.getElementById("name").value = userLogin.name;
                    document.getElementById("address").value = userLogin.address;
                    document.getElementById("phone").value = userLogin.phone;
                    document.getElementById("email").value = userLogin.email;
                    document.querySelectorAll(".hidden").forEach((t, index) => {
                        t.style.display = "block";
                    })
                }
                document.querySelectorAll(".tab-detail").forEach((t, index) => {
                    const link = window.location.href;
                    if (index == 0 && link.includes("MilkManagementUser") ||
                        index == 1 && link.includes("CartManagementUser") ||
                        index == 2 && link.includes("OrderManagementUser") ||
                        index == 3 && link.includes("ProfileManagementUser"))
                        t.classList.add("active-tab");

                    if (!(t.classList.contains("hidden") || t.classList.contains("hidden2")))
                        t.style.display = "block"
                })
                getAllMilkBrand()
            };
        };

        function getAllMilkBrand() {
            fetch("http://localhost:81/api/get-all-milk-brand.php")
                .then((response) => response.json())
                .then((data) => {
                    brands = data;
                    console.log(data);
                    getCart(data);
                })
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
            displayData(pageData);
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

        function getCart() {
            if (userLogin)
                fetch(`http://localhost:81/api/get-cart-by-user-id.php?id=${userLogin.id}`)
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
            else {
                dataCurrent = JSON.parse(sessionStorage.getItem("carts")) ?? [];
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
            }
        }

        function getCartNull() {

            dataCurrent = [];
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

        }
        let total = 0;

        function displayData(data) {
            total = 0;
            fetch("http://localhost:81/api/get-all-milk.php")
                .then((response) => response.json())
                .then((milks) => {
                    const tableBody = document
                        .getElementById("cart")
                        .getElementsByTagName("tbody")[0];
                    tableBody.innerHTML = "";
                    data.forEach((cart, index) => {
                        const milk = milks.find(m => m.id = cart.milk);
                        total += milk.price * cart.quantity;
                        const currentBrand = brands.find((b) => b.id === milk.brand);

                        const row = tableBody.insertRow();
                        row.addEventListener("click", () => {
                            detail = milk;
                            showDetail();
                        });
                        const cell1 = row.insertCell(0);
                        cell1.style.textAlign = "center";

                        const cell2 = row.insertCell(1);
                        const cell3 = row.insertCell(2);
                        cell3.style.textAlign = "center";
                        const cell4 = row.insertCell(3);
                        cell4.style.textAlign = "center";
                        const cell5 = row.insertCell(4);
                        cell5.style.textAlign = "center";

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

                        const deleteElement = document.createElement("div");
                        deleteElement.textContent = "Xóa";
                        deleteElement.style.margin = "0px auto";
                        deleteElement.style.padding = "5px 10px";
                        deleteElement.style.border = "1px solid black";
                        deleteElement.style.backgroundColor = "red"
                        deleteElement.style.width = "70px"
                        deleteElement.style.border = "3px";
                        deleteElement.style.color = "white"
                        deleteElement.style.cursor = "pointer";
                        deleteElement.addEventListener("click", () => {
                            changeStatusCart(cart.id);
                        })
                        cell5.appendChild(deleteElement);
                    });
                    document.getElementById("total").textContent = "Total: " + total + " VNĐ";
                })
                .catch((error) => console.error("Error:", error));
        }

        function changeStatusCart(id) {
            fetch(`http://localhost:81/api/change-cart.php?id=${id}`, {
                    method: "GET",
                })
                .then((response) => {
                    response.json();
                    getCart();
                })
                .then((data) => console.log(data))
                .catch((error) => console.error("Error:", error));
        }
        document.getElementById("checkOut").addEventListener("click", () => {
            const formData = new FormData(
                document.getElementById("shippingForm")
            );
            if (!formData.get("fullName") || !formData.get("address") || !formData.get("phoneNumber") || !formData
                .get(
                    "address"))
                alert("Không được để trống các thông tin giao hàng")
            else {
                formData.append("user", userLogin?.id ?? 1);
                formData.append("total", total);
                if (userLogin?.role)
                    fetch(`http://localhost:81/api/post-order.php`, {
                        method: "POST",
                        body: formData,
                    })
                    .then(data => data.json())
                    .then((data) => {
                        if (data.status) {
                            console.log(data);
                            alert("Checkout Success");
                            getCart()
                        }

                    })
                    .catch((error) => console.error("Error:", error));
                else {
                    formData.append("ids", dataCurrent.map(data => data.id).join(','));
                    fetch(`http://localhost:81/api/post-order-guest.php`, {
                            method: "POST",
                            body: formData,
                        })
                        .then(data => data.json())
                        .then((data) => {
                            if (data.status) {
                                console.log(data);
                                sessionStorage.clear();
                                alert("Checkout Success");
                                getCartNull()
                            }
                        })
                        .catch((error) => console.error("Error:", error));
                }
            }

        })
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

        function login() {
            localStorage.clear();
            window.location.href = "http://localhost:81/api/web/HomePage.php";
        }
    </script>
</body>

</html>