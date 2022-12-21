<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
</head>
<body>

    <a href="{{ route('pengguna.add') }}">Tambah Pengguna</a>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="daftar-pengguna">

        </tbody>
    </table>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>

    <script type="text/javascript">
        $.ajax({
            url: "http://127.0.0.1:8000/api/pengguna/list",
            type: "GET",
            dataType: "json",
            success: response => {
                let listPengguna = response.data
                console.log(listPengguna)
                let htmlString = ""
                for(let pengguna of listPengguna) {
                    htmlString += `
                        <tr>
                            <td>${pengguna.nama}</td>
                            <td>${pengguna.email}</td>
                            <td>
                                <a href="http://localhost:8000/detail/${pengguna.id}" target="_blank">
                                    <button> Details</button>
                                </a>
                                <a onClick={deletePengguna(${pengguna.id})}>
                                    <button> Hapus</button>
                                </a>
                            </td>
                        </tr>
                    `
                }
                $('#daftar-pengguna').append($.parseHTML(htmlString))
            }
        })

        function deletePengguna(id){
            $.ajax({
                url: `http://127.0.0.1:8000/api/pengguna/${id}/delete`,
                type: "POST",
                dataType: "json",
                success: _ => {
                    console.log("SUCCESS");
                    window.location.href = "";
                },
                error: err => {
                    console.log(err);
                }
            })
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>

</body>
</html>
