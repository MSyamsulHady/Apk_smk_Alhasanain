let table = new DataTable("#tableSiswa", {
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
