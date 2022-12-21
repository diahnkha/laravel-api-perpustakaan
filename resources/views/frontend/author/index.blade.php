<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
</head>
<body>

    <a href="{{ route('author.add') }}">Tambah author</a>
    <table border="1">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
                <th>Email</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody id="daftar-author">

        </tbody>
    </table>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>

    <script type="text/javascript">
        $.ajax({
            url: "http://127.0.0.1:8000/api/author/list",
            type: "GET",
            dataType: "json",
            success: response => {
                let listauthor = response.data
                console.log(listauthor)
                let htmlString = ""
                for(let author of listauthor) {
                    htmlString += `
                        <tr>
                            <td> <img style="width:300; height:150px;" src="http://localhost:8000/storage/${author.foto}" alt=""></td>
                            <td>${author.nama_depan}</td>
                            <td>${author.nama_belakang}</td>
                            <td>${author.email}</td>
                            <td>${author.alamat}</td>
                            <td>
                                <a href="http://localhost:8000/detail/${author.id}" target="_blank">
                                    <button> Details</button>
                                </a>
                                <button onClick={deleteauthor(${author.id})}>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `
                }
                $('#daftar-author').append($.parseHTML(htmlString))
            }
        })

        function deleteauthor(id){
            $.ajax({
                url: `http://127.0.0.1:8000/api/author/${id}/delete`,
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
