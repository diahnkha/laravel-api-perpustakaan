<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add product</title>
</head>
<body>

        <label for="nama">Nama</label>
        <input type="text" id="nama"><br>

        <label for="foto">foto</label>
        <input type="file" id="foto" accept="image/*" ><br>

        <label for="deskripsi">deskripsi</label>
        <input type="text" id="deskripsi"><br>

        <label for="harga">harga</label>
        <input type="number" id="harga"><br>

        <label for="stok">stok</label>
        <input type="number" id="stok"><br>

        <button onClick="add()" id="submit">Add</button>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script>
        function add(){
            // e.preventDefault()
            let nama = $("#nama").val()
            let foto = $("#foto")[0].files[0]
            let deskripsi = $("#deskripsi").val()
            let harga = $("#harga").val()
            let stok = $("#stok").val()

            if (nama === "") return alert("Nama tidak boleh kosong")
            if (foto === "") return alert("foto tidak boleh kosong")
            if (deskripsi === "") return alert("deskripsi tidak boleh kosong")
            if (harga === "") return alert("harga tidak boleh kosong")
            if (stok === "") return alert("stok tidak boleh kosong")

            let fd = new FormData();
            fd.append("nama", nama)
            fd.append("foto", foto)
            fd.append("deskripsi", deskripsi)
            fd.append("harga", harga)
            fd.append("stok", stok)

            $.ajax({
                url: "http://127.0.0.1:8000/api/product/store",
                method: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: _ =>
                    window.location.href = "http://127.0.0.1:8000"
            })

        }
    </script>
</body>
</html>
