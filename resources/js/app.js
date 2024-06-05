$(document).ready(function () {
    WebFont.load({
        google: {
            families: ["Lato:300,400,700,900"],
        },
        custom: {
            families: [
                "Flaticon",
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["../assets/css/fonts.min.css"],
        },
        active: function () {
            sessionStorage.fonts = true;
        },
    });

    // datatable
    let table = new DataTable(".table-data", {
            dom: "rtp",
        }),
        select = $("#jurusan"),
        nama = $("#nama");

    select.on("change", function () {
        table.search(this.value).draw();
    });
    nama.on("keyup", function () {
        table.search(this.value).draw();
    });

    let msg = $(".msg-data");
    if (msg.attr("data-msg")) {
        Swal.fire({
            title: msg.attr("data-msg"),
            icon: msg.attr("data-type"),
        });
    }
});

$(".deletealertsiswa").click(function (e) {
    var id_siswa = $(this).attr("data-id");
    var form = $(this).closest("form");
    var nama = $(this).attr("data-nama");
    Swal.fire({
        title: "Apakah Anda Yakin menghapus " + nama + " ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya.",
    }).then((deleteguru) => {
        if (deleteguru.isConfirmed) {
            form.submit();
            icon: "success";
        }
    });
});

$(".deletealert").click(function (e) {
    var id_guru = $(this).attr("data-id");
    var form = $(this).closest("form");
    var nama = $(this).attr("data-nama");
    Swal.fire({
        title: "Apakah Anda Yakin menghapus " + nama + " ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya.",
    }).then((deleteguru) => {
        if (deleteguru.isConfirmed) {
            form.submit();
            icon: "success";
        }
    });
});

$("#logout").click(function (e) {
    e.preventDefault();
    Swal.fire({
        title: "Apakah Anda Yakin?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya.",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = $(this).attr("href");
        }
    });
});
