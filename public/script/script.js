$(document).ready(function () {
    // Tambahkan event listener untuk elemen dokumen
    $(document).click(function (event) {
        // Periksa apakah klik terjadi di dalam atau di luar elemen .product-link dan .product-options
        const isClickInsideProductLink =
            $(".product-link").is(event.target) ||
            $(".product-link").has(event.target).length > 0;
        const isClickInsideProductOptions =
            $(".product-options").is(event.target) ||
            $(".product-options").has(event.target).length > 0;

        // Jika klik di luar elemen .product-link dan .product-options, sembunyikan dropdown
        if (!isClickInsideProductLink && !isClickInsideProductOptions) {
            $(".product-options").slideUp();
        }
    });

    // Tambahkan event listener untuk elemen .product-link
    $(".product-link").click(function (event) {
        event.stopPropagation(); // Mencegah event klik menyebar ke elemen dokumen

        // Sembunyikan semua dropdown
        $(".product-options").slideUp();

        // Temukan dropdown terkait dengan item yang diklik
        const dropdown = $(this).next(".product-options");

        // Jika dropdown sudah tersembunyi, tampilkan; sebaliknya, sembunyikan
        if (!dropdown.is(":visible")) {
            dropdown.slideDown();
        }
    });

    $(document).ready(function () {
        let categoryId;
        let unitId;
        let dataStock;

        $(".btn-modal").click(async function () {
            const productId = $(this).data("product-id");
            const userId = $(this).data("user-id");
            console.log(userId);
            await $.ajax({
                url: "/get-product/" + productId, // Gantilah dengan URL yang sesuai di aplikasi Laravel Anda
                type: "GET",
                dataType: "json",
                success: function (data) {
                    const created_at = new Date(data.created_at);
                    const updated_at = new Date(data.updated_at);
                    const formatter = new Intl.DateTimeFormat("id-ID", {
                        year: "numeric",
                        month: "long",
                        day: "numeric",
                        hour: "numeric",
                        minute: "numeric",
                        second: "numeric",
                    });

                    categoryId = data.category_id;
                    unitId = data.unit_id;
                    dataStock = data.stock;

                    $("#productTitle").text(data.name);
                    $("#deleteProduct").attr(
                        "action",
                        "/product/delete/" + data.id + "/" + userId
                    );
                    $("#productImg").attr("src", "storage/" + data.url_picture);
                    $("#productImgCtg").attr(
                        "src",
                        "../storage/" + data.url_picture
                    );
                    $("#productStock").text(data.stock);
                    $("#productName").text(data.name);
                    $("#productSKU").text(data.SKU);
                    $("#productWeight").text(data.weight + "g");
                    $("#productCreatedAt").text(formatter.format(created_at));
                    $("#productUpdatedAt").text(formatter.format(updated_at));
                    let formattedPrice = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                    }).format(data.price);
                    $("#productPrice").text(formattedPrice);

                    $("#productDescription").text(data.description);
                    $("#productUrl").attr(
                        "href",
                        "/product/update/" + data.SKU
                    );
                },
                error: function (error) {
                    console.log(error);
                },
            });
            await $.ajax({
                url: "/get-category/" + categoryId,
                type: "GET",
                dataType: "json",
                success: function (category) {
                    $("#productCategory").text(category.name);
                },
                error: function (error) {
                    console.log(error);
                },
            });

            await $.ajax({
                url: "/get-unit/" + unitId,
                type: "GET",
                dataType: "json",
                success: function (unit) {
                    $("#productStock").text(dataStock + " " + unit.name);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
        $(".btn-modal-user").click(async function () {
            const userId = $(this).data("user-id");
            const authId = $(this).data("auth");
            await $.ajax({
                url: "/get-user/" + userId,
                type: "GET",
                dataType: "json",
                success: (user) => {
                    $("#userTitle").text(user.name);
                    $("#user").text(user.name);
                    $("#name").text(user.name);
                    $("#email").text(user.email);
                    $("#role").text(user.role);
                    $("#username").text(user.username);
                    $("#userImg").attr("src", "/storage/" + user.url_picture);
                    $("#deleteUser").attr(
                        "action",
                        "/user/delete/" + user.id + "/" + authId
                    );
                    $("#userUrl").attr("href", "/user/update/" + user.username);
                },
            });
        });
        $(".btn-modal-category").click(async function () {
            const categoryId = $(this).data("category-id");
            const userId = $(this).data("user-id");
            await $.ajax({
                url: "/check-category/" + categoryId,
                type: "GET",
                dataType: "json",
                success: function (category) {
                    $("#errorGet").text(" ");
                    $("#confirmDelete").html(
                        "Apakah yakin ingin menghapus kategori " +
                            "<b>" +
                            category.name +
                            "</b>"
                    );
                    $("#btn-delete").prop("disabled", false);
                    $("#productCategory").text(category.name);
                    $("#deleteCategory").attr(
                        "action",
                        "/category/delete/" + categoryId + "/" + userId
                    );
                },
                error: function (error) {
                    $("#btn-delete").prop("disabled", true);
                    $("#errorGet").text(
                        "Kategori dimiliki oleh produk, hapus atau ganti kategori produk terlebih dahulu"
                    );
                    $("#confirmDelete").text(" ");
                    $("#productCategory").text(" ");
                },
            });
        });
        $(".btn-modal-unit").click(async function () {
            const unitId = $(this).data("unit-id");
            const userId = $(this).data("user-id");
            await $.ajax({
                url: "/check-unit/" + unitId,
                type: "GET",
                dataType: "json",
                success: function (unit) {
                    $("#errorGet").text(" ");
                    $("#confirmDelete").text(
                        "Apakah yakin ingin menghapus satuan"
                    );
                    $("#btn-delete").prop("disabled", false);
                    $("#name").text(unit.name);
                    $("#deleteUnit").attr(
                        "action",
                        "/unit/delete/" + unitId + "/" + userId
                    );
                },
                error: function (error) {
                    $("#btn-delete").prop("disabled", true);
                    $("#errorGet").text(
                        "Unit dimiliki oleh produk, hapus atau ganti unit produk terlebih dahulu"
                    );
                    $("#confirmDelete").text(" ");
                    $("#name").text(" ");
                },
            });
        });
        $(".btn-modal-stock").click(async function () {
            const productId = $(this).data("product-id");
            const userId = $(this).data("user-id");
            await $.ajax({
                url: "/get-product/" + productId, // Gantilah dengan URL yang sesuai di aplikasi Laravel Anda
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $("#update-stock").attr(
                        "action",
                        "/product/update/inc/" + productId + "/" + userId
                    );
                    $("#title").text(data.name);
                    $("#productStock").text(data.stock);
                },
            });
        });
        $(".btn-modal-stock-del").click(async function () {
            const productId = $(this).data("product-id");
            const userId = $(this).data("user-id");
            await $.ajax({
                url: "/get-product/" + productId, // Gantilah dengan URL yang sesuai di aplikasi Laravel Anda
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $("#update-stock").attr(
                        "action",
                        "/product/update/del/" + productId + "/" + userId
                    );
                    $("#title").text(data.name);
                    $("#productStock").text(data.stock);
                },
            });
        });

        $(".btn-modal-update-category").click(async function () {
            const categoryId = $(this).data("category-id");
            const userId = $(this).data("user-id");
            await $.ajax({
                url: "/get-category/" + categoryId,
                type: "GET",
                dataType: "json",
                success: function (category) {
                    $("#productCategory").text(category.name);
                    $("#name_category").attr("value", category.name);
                    $("#update_category").attr(
                        "action",
                        "/category/update/" + categoryId + "/" + userId
                    );
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        $(".btn-modal-update-unit").click(async function () {
            const unitId = $(this).data("unit-id");
            const userId = $(this).data("user-id");
            console.log(userId);
            await $.ajax({
                url: "/get-unit/" + unitId,
                type: "GET",
                dataType: "json",
                success: function (unit) {
                    $("#productUnit").text(unit.name);
                    $("#name_unit").attr("value", unit.name);
                    $("#update_unit").attr(
                        "action",
                        "/unit/update/" + unitId + "/" + userId
                    );
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
    });
});
