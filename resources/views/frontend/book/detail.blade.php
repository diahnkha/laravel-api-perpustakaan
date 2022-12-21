<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>
<body>
<label for="nama">Nama</label>
        <input type="text" id="nama"><br>

        <img style="width:200; height:200px;" src="http://localhost:8000/storage/${product.foto}" alt="">

        <label for="foto">foto</label>
        <input type="file" id="foto" accept="image/*" ><br>

        <label for="deskripsi">deskripsi</label>
        <input type="text" id="deskripsi"><br>

        <label for="harga">harga</label>
        <input type="number" id="harga"><br>

        <label for="stok">stok</label>
        <input type="number" id="stok"><br>

        <button onClick="update()" id="submit">Update</button>

        <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>

        <script>
            $.ajax({
                url: "http://127.0.0.1:8000/api/product/{{$id}}/show",
                method: "GET",
                dataType: "json",
                success: response => {
                    let product = response.data
                    console.log(product);
                    let nama = $("#nama").val(product.nama)
                    let foto = $("#foto")[0].files[0]
                    let deskripsi = $("#deskripsi").val(product.deskripsi)
                    let harga = $("#harga").val(product.harga)
                    let stok = $("#stok").val(product.stok)


                }
            })

            function update(){
                    // e.preventDefault()
                    let nama = $("#nama").val()
                    let foto = $("#foto")[0].files[0]
                    let deskripsi = $("#deskripsi").val()
                    let harga = $("#harga").val()
                    let stok = $("#stok").val()

                    if (nama === "") return alert("Nama tidak boleh kosong")
                    if (deskripsi === "") return alert("deskripsi tidak boleh kosong")
                    if (harga === "") return alert("harga tidak boleh kosong")
                    if (stok === "") return alert("stok tidak boleh kosong")


                    let fd = new FormData();
                    fd.append("nama", nama)
                    fd.append("deskripsi", deskripsi)
                    fd.append("harga", harga)
                    fd.append("stok", stok)

                    if (foto!=null) fd.append("foto", foto)


                    $.ajax({
                        url: "http://127.0.0.1:8000/api/product/{{$id}}/update",
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
