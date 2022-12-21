<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail pengguna</title>
</head>
<body>
        <label for="nama">Nama</label>
        <input type="text" id="nama"><br>

        <label for="email">email</label>
        <input type="email" id="email"><br>

        <label for="password">password</label>
        <input type="password" id="password"><br>

        <button onClick="update()" id="submit">Submit</button>

        <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>

        <script>
            $.ajax({
                url: "http://127.0.0.1:8000/api/pengguna/{{$id}}/show",
                method: "GET",
                dataType: "json",
                success: response => {
                    let pengguna = response.data
                    console.log(pengguna);
                    $("#nama").val(pengguna.nama)
                    $("#email").val(pengguna.email)


                }
            })

            function update(id){
                    // e.preventDefault()
                    let nama = $("#nama").val()
                    let email = $("#email").val()
                    let password = $("#password").val()

                    if (nama === "") return alert("Nama tidak boleh kosong")
                    if (email === "") return alert("Email tidak boleh kosong")


                    let fd = new FormData();
                    fd.append("nama", nama)
                    fd.append("email", email)

                    if (password !== "") fd.append("password", password)

                    $.ajax({
                        url: "http://127.0.0.1:8000/api/pengguna/{{$id}}/update",
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
