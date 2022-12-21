<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
</head>
<body>

    <a href="{{ route('product.add') }}">Tambah product</a>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Foto</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody id="daftar-product">

        </tbody>
    </table>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>

    <script type="text/javascript">
        $.ajax({
            url: "http://127.0.0.1:8000/api/product/list",
            type: "GET",
            dataType: "json",
            success: response => {
                let listproduct = response.data
                console.log(listproduct)
                let htmlString = ""
                for(let product of listproduct) {
                    htmlString += `
                        <tr>
                            <td>${product.nama}</td>
                            <td> <img style="width:300; height:150px;" src="http://localhost:8000/storage/${product.foto}" alt=""></td>
                            <td>${(product.deskripsi).slice(0,20)}</td>
                            <td>${product.harga}</td>
                            <td>${product.stok}</td>
                            <td>
                                <a href="http://localhost:8000/detail/${product.id}" target="_blank">
                                    <button> Details</button>
                                </a>
                                <button onClick={deleteproduct(${product.id})}>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `
                }
                $('#daftar-product').append($.parseHTML(htmlString))
            }
        })

        function deleteproduct(id){
            $.ajax({
                url: `http://127.0.0.1:8000/api/product/${id}/delete`,
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
