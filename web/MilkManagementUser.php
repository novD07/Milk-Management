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

        margin-bottom: 10px;
    }

    .div-info {
        display: flex;
        height: 100%;
    }

    .image {
        height: 100%;
        width: 150px;
        margin-right: 20px;
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

    #logout,
    #login {
        background-color: red;
        color: white;
        font-weight: bold;
    }

    .group-quantity {
        display: flex;
        justify-content: flex-end;


    }

    .group-cart {
        display: flex;
        text-align: center;
        justify-content: flex-end;
        align-items: center;
        margin: 10px;
    }

    .group-cart>div {
        margin: 0 10px;
    }

    .group-quantity div {

        min-width: 30px;
        background-color: gainsboro;
        padding: 5px 10px;
        cursor: pointer;
        border: 1px solid black;
        text-align: center;
    }

    #addCart {
        padding: 5px 10px;
        border: 1px solid black;
        border-radius: 3px;
        background-color: aqua;
        font-weight: bold;
        cursor: pointer;
    }

    #addCart:hover {
        background-color: aquamarine;
    }

    #grid-milk {
        width: 90%;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
        grid-gap: 20px;
    }

    #grid-milk div {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 3px;
        padding: 20px;
        margin: 10px;
        justify-content: center;
        cursor: pointer;
    }

    #grid-milk div {
        border: 2px solid white;
    }

    #grid-milk>div {
        border: 1px solid black;
    }

    #grid-milk>div:hover {
        border: 2px solid red;

    }

    .tab-detail {
        display: none;
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
<h2>Thông tin các sản phẩm</h2>

<body>
    <!-- <table id="milkTable">
        <tbody></tbody>
    </table> -->
    <div id="grid-milk">

    </div>
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
            <div>
                <div class="title" id="title"></div>
                <div class="div-info">
                    <div class="image" id="image">
                        <img src="" alt="" id="img" />
                    </div>
                    <div class="info">
                        <div>
                            <h4>Thành phần dinh dưỡng:</h4>
                            <p id="tp"></p>
                        </div>
                        <div>
                            <h4>Lợi ích:</h4>
                            <p id="li"></p>
                        </div>
                        <div class="wp">
                            <strong>Trọng lượng: </strong><span id="weight"></span> -
                            <strong>Đơn giá: </strong><span id="price"> </span> VNĐ
                        </div>
                    </div>
                </div>
            </div>
            <div class="group-cart">
                <div class="group-quantity">
                    <div onclick="decrease()">-</div>
                    <div id="count">1</div>
                    <div onClick="increase()">+</div>
                </div>
                <div id="addCart">Thêm vào giỏ</div>
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

        if (userLogin?.role == 1)
            window.location.href = "http://localhost:81/api/web/MilkManagementAdmin.php"
        else {
            if (!userLogin) {
                document.querySelectorAll(".hidden2").forEach((t, index) => {
                    t.style.display = "block";
                })
            } else {
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
                getMilkData(data);
            })
            .catch((error) => console.error("Error:", error));
    }

    const rowsPerPage = 18;
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
        displayMilkData(pageData);
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

    function displayMilkData(data) {
        fetch("http://localhost:81/api/get-all-milk-brand.php")
            .then((response) => response.json())
            .then((milkBrand) => {
                // const tableBody = document
                //     .getElementById("milkTable")
                //     .getElementsByTagName("tbody")[0];
                // tableBody.innerHTML = "";

                const gridMilk = document.getElementById("grid-milk");
                gridMilk.innerHTML = "";

                data.forEach((milk) => {
                    // const row = tableBody.insertRow();
                    // row.addEventListener("click", () => {
                    //     detail = milk;
                    //     showDetail();
                    // });
                    // const cell1 = row.insertCell(0);
                    // cell1.style.width = "120px";
                    // cell1.style.textAlign = "center";

                    // const cell2 = row.insertCell(1);

                    // const imageElement = document.createElement("img");
                    // imageElement.style.height = "80px";
                    // imageElement.src =
                    //     "http://localhost:81/api/imageUpload/" + milk.image;
                    // imageElement.alt = milk.name;
                    // cell1.appendChild(imageElement);

                    // const nameElement = document.createElement("h3");
                    // nameElement.textContent = milk.name;
                    // nameElement.style.marginBottom = "20px";
                    // nameElement.alt = milk.name;
                    // cell2.appendChild(nameElement);

                    // const brandElement = document.createElement("p");
                    // brandElement.textContent =
                    //     "Nhà sản xuất: " +
                    //     brands.find((b) => b.id === milk.brand).name || milk.brand;
                    // brandElement.alt = milk.name;
                    // cell2.appendChild(brandElement);

                    // const detailElement = document.createElement("p");
                    // detailElement.textContent =
                    //     milk.type + " - " + milk.weight + (milk.type == "Sữa bột" ? " gr" : " ml") + " - " +
                    //     milk.price + " VNĐ";
                    // detailElement.alt = milk.name;
                    // cell2.appendChild(detailElement);

                    const milkInGrid = document.createElement("div");
                    milkInGrid.addEventListener("click", () => {
                        detail = milk;
                        showDetail();
                    });
                    milkInGrid.style.backgroundColor = "rgba(120, 120, 120, 0.3)"
                    const divImageGridElement = document.createElement("div");
                    divImageGridElement.style.height = "230px";

                    const imageGridElement = document.createElement("img");
                    imageGridElement.style.maxWidth = "100%";
                    imageGridElement.src =
                        "http://localhost:81/api/imageUpload/" + milk.image;
                    imageGridElement.alt = milk.name;
                    divImageGridElement.appendChild(imageGridElement);
                    milkInGrid.appendChild(divImageGridElement);

                    const brandGridElement = document.createElement("p");
                    brandGridElement.textContent =
                        "Nhà sản xuất: " +
                        brands.find((b) => b.id === milk.brand).name || milk.brand;
                    milkInGrid.appendChild(brandGridElement);

                    const detailGridElement = document.createElement("p");
                    detailGridElement.textContent =
                        milk.type + " - " + milk.weight + (milk.type == "Sữa bột" ? " gr" : " ml") + " - " +
                        milk.price + " VNĐ";
                    milkInGrid.appendChild(detailGridElement);
                    gridMilk.appendChild(milkInGrid);

                    const addCartInGrid = document.createElement("p");
                    addCartInGrid.style.fontWeight = "bold";
                    addCartInGrid.textContent = "Thêm vào giỏ";
                    addCartInGrid.style.background = "aqua";
                    addCartInGrid.style.padding = "5px 20px";
                    addCartInGrid.style.marginTop = "20px";
                    addCartInGrid.style.borderRadius = "6px";
                    addCartInGrid.style.border = "1px solid gray";
                    milkInGrid.appendChild(addCartInGrid);
                    gridMilk.appendChild(milkInGrid);
                });
            })
            .catch((error) => console.error("Error:", error));
    }

    function showDetail() {
        count = 1;
        document.getElementById("return").addEventListener("click", () => {
            unShowDetail();
            detail = null;
        });
        const image = document.getElementById("img");
        image.style.width = "140px";
        image.src = "http://localhost:81/api/imageUpload/" + detail.image;
        document.getElementById("title").textContent =
            detail.name +
            " - " +
            brands.find((b) => b.id === detail.brand).name || detail.brand;
        document.getElementById("tp").textContent =
            detail.nutritionalIngredients;

        document.getElementById("li").textContent = detail.benefit;
        document.getElementById("weight").textContent = detail.weight + (detail.type == "Sữa bột" ? " gr" : " ml");

        document.getElementById("price").textContent = detail.price;
        document.getElementById("detail").classList.add("show");
    }

    function unShowDetail() {
        count = 1;
        document.getElementById("count").textContent = count;
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
    let count = 1;

    function decrease() {
        if (count > 1)
            count--;
        document.getElementById("count").textContent = count;
    }

    function increase() {
        count++;
        document.getElementById("count").textContent = count;
    }
    document.getElementById("addCart").addEventListener("click", () => {

        function addCart() {
            const formData = new FormData();
            formData.append("user", userLogin?.id ? userLogin.id : 1);
            formData.append("milk", detail.id);
            formData.append("quantity", count);
            fetch("http://localhost:81/api/post-cart.php", {
                    method: "POST",
                    body: formData,
                })
                .then(data => data.json())
                .then((data) => {
                    console.log(data);
                    console.log(data.data);
                    if (data.status) {
                        if (!userLogin) {
                            if (!sessionStorage.getItem("carts"))
                                sessionStorage.setItem("carts", JSON.stringify([]));
                            sessionStorage.setItem("carts",
                                JSON.stringify([...Array.from(
                                    JSON.parse(sessionStorage.getItem("carts")) ?? []
                                ), data.data])
                            )
                        }
                        alert("Add Cart Success");
                    } else alert("Add Cart Failed");
                })
                .catch((error) => console.error("Error:", error));
        }
        addCart();
    })
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