<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>
<body>
        <label for="nama_depan">nama_depan</label>
        <input type="text" id="nama_depan"><br>

        <label for="nama_belakang">nama_belakang</label>
        <input type="text" id="nama_belakang"><br>

        <label for="foto">Foto</label>
        <input type="file" id="foto" accept="image/*" ><br>

        <label for="email">email</label>
        <input type="email" id="email"><br>

        <button onClick="update()" id="submit">Update</button>

        <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>

        <script>
            $.ajax({
                url: "http://127.0.0.1:8000/api/author/{{$id}}/show",
                method: "GET",
                dataType: "json",
                success: response => {
                    let author = response.data
                    console.log(author);
                    let nama_depan = $("#nama_depan").val(author.nama_depan)
                    let foto = $("#foto")[0].files[0]
                    let nama_belakang = $("#nama_belakang").val(author.nama_belakang)
                    let email = $("#email").val(author.email)
                    let alamat = $("#alamat").val(author.alamat)


                }
            })

            function update(){
                    // e.preventDefault()
                    let nama_depan = $("#nama_depan").val()
                    let foto = $("#foto")[0].files[0]
                    let nama_belakang = $("#nama_belakang").val()
                    let email = $("#email").val()
                    let alamat = $("#alamat").val()

                    if (nama_depan === "") return alert("nama_depan tidak boleh kosong")
                    if (foto === "") return alert("foto tidak boleh kosong")
                    if (nama_belakang === "") return alert("nama_belakang tidak boleh kosong")
                    if (email === "") return alert("email tidak boleh kosong")
                    if (alamat === "") return alert("alamat tidak boleh kosong")


                    let fd = new FormData();
                    fd.append("nama_depan", nama_depan)
                    fd.append("nama_belakang", nama_belakang)
                    fd.append("email", email)
                    fd.append("alamat", alamat)

                    if (foto!=null) fd.append("foto", foto)


                    $.ajax({
                        url: "http://127.0.0.1:8000/api/author/{{$id}}/update",
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
