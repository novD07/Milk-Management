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
<h2>Thông tin các đơn hàng</h2>

<body>
    <table id="order">
        <thead>
            <th>STT</th>
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
    <div id="pagination">
        <span onclick="firstPage()">
            << </span>
                <span onclick="prevPage()">
                    < </span>
                        <div id="div-pagination"></div>
                        <span onclick="nextPage()"> > </span>
                        <span onclick="lastPage()"> >> </span>
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
    <script>
    let userLogin = null;
    let brands = [];
    let detail = null;
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
                getAllMilkBrand()
            };
        } else
            window.location.href = "http://localhost:81/api/web/HomePage.php"

    };

    function getAllMilkBrand() {
        fetch("http://localhost:81/api/get-all-milk-brand.php")
            .then((response) => response.json())
            .then((data) => {
                brands = data;
                getOrder(data);
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

    function getOrder() {
        fetch(`http://localhost:81/api/get-order-by-user-id.php?id=${userLogin.id}`)
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
    let total = 0;

    function displayData(data) {
        const tableBody = document
            .getElementById("order")
            .getElementsByTagName("tbody")[0];
        tableBody.innerHTML = "";
        data.forEach((order, index) => {
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
            const sttElement = document.createElement("p");
            sttElement.textContent = index + 1;

            cell1.appendChild(sttElement);

            const nameElement1 = document.createElement("h3");
            nameElement1.style.textAlign = "center";
            nameElement1.textContent = order.fullName;
            cell2.appendChild(nameElement1);
            const nameElement2 = document.createElement("h3");
            nameElement2.style.textAlign = "center";
            nameElement2.textContent = order.address;
            cell3.appendChild(nameElement2);
            const nameElement3 = document.createElement("h3");
            nameElement3.style.textAlign = "center";
            nameElement3.textContent = order.phoneNumber;
            cell4.appendChild(nameElement3);
            const nameElement4 = document.createElement("h3");
            nameElement4.style.textAlign = "center";
            nameElement4.textContent = order.email;
            cell5.appendChild(nameElement4);
            const nameElement = document.createElement("h3");
            nameElement.style.textAlign = "center";
            nameElement.textContent = order.total + " VNĐ";
            cell6.appendChild(nameElement);
            const statusElement = document.createElement("h3");
            statusElement.style.textAlign = "center";
            statusElement.textContent = order.status == 0 ? "Chờ xác nhận" : order.status == 1 ? "Đã xác nhận" :
                order.status == 2 ? "Đã giao" : "Đã hủy";
            cell7.appendChild(statusElement);

            const detailElement = document.createElement("p");
            detailElement.textContent = "Xem chi tiết";
            detailElement.style.textAlign = "center";
            detailElement.style.margin = "0px auto";
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
            cell8.appendChild(detailElement);
        });
    }

    function showDetail() {
        document.getElementById("return").addEventListener("click", () => {
            unShowDetail();
            detail = null;
        });
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
                        document.getElementById("total").textContent = "Total: " + total + " VNĐ";
                    })
                    .catch((error) => console.error("Error:", error));
            })
            .catch((error) => console.error("Error:", error));
        document.getElementById("detail").classList.add("show");

    }

    function unShowDetail() {
        document.getElementById("detail").classList.remove("show");
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
    </script>
</body>

</html>