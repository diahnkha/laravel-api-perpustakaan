<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add author</title>
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

        <button onClick="add()" id="submit">Add</button>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script>
        function add(){
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
            fd.append("foto", foto)
            fd.append("nama_belakang", nama_belakang)
            fd.append("email", email)
            fd.append("alamat", alamat)

            $.ajax({
                url: "http://127.0.0.1:8000/api/author/store",
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
