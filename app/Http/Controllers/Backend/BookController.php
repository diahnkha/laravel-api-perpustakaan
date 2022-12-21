<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;

class BookController extends Controller
{

    /**
     * CRUD
     * - list => index
     * - detail => show
     * - edit => update
     * - create => store
     * - delete => destroy
     */

     function index()
     {
         $books = Book::query()->get();

         $list = array();
         foreach ($books as $book) {
            $book = Book::query()->where("id", $book->id)->first();
            $idpengarang = $book["pengarang"];
            $idkategori = $book["kategori"];
            $category = Category::query()->where("id", $idpengarang)->first();
            $author = Author::query()->where("id", $idkategori)->first();
            $listobject = [
                "judul" =>$book->judul,
                "foto" =>$book->foto,
                "penerbit" =>$book->penerbit,
                "kota" =>$book->kota,
                "bahasa" =>$book->bahasa,
                "isbn" =>$book->isbn,
                "author" => $author,
                "deskripsi" => $book->deskripsi,
                "tahun" => $book->tahun,
                "kategori" => $category,
                "stok" => $book->stok

            ];
            array_push($list, $listobject);
          };

         return response()->json([
             "status" => true,
             "message" => "",
             "data" => $list
         ]);
     }

     function show($id)
     {
         $book = Book::query()->where("id", $id)->first();
         $idpengarang = $book["pengarang"];
         $idkategori = $book["kategori"];
         $category = Category::query()->where("id", $idpengarang)->first();
         $author = Author::query()->where("id", $idkategori)->first();

         if ($book == null) {
             return response()->json([
                 "status" => false,
                 "message" => "book tidak ditemukan",
                 "data" => null
             ]);
         }

         $listobject = [
            "judul" =>$book->judul,
            "foto" =>$book->foto,
            "penerbit" =>$book->penerbit,
            "kota" =>$book->kota,
            "bahasa" =>$book->bahasa,
            "isbn" =>$book->isbn,
            "author" => $author,
            "deskripsi" => $book->deskripsi,
            "tahun" => $book->tahun,
            "kategori" => $category,
            "stok" => $book->stok

         ];


         return response()->json([
             "status" => true,
             "message" => "",
             "data" => $listobject
         ]);
     }

     function store(Request $request)
     {
         $payload = $request->all();
         $payload['foto'] = $request->file("foto")->store("gambar", "public");
         if (!isset($payload["judul"])) {
             return response()->json([
                 "status" => false,
                 "message" => "wajib ada judul",
                 "data" => null
             ]);
         }
         if (!isset($payload["foto"])) {
             return response()->json([
                 "status" => false,
                 "message" => "wajib ada foto",
                 "data" => null
             ]);
         }
         if (!isset($payload["penerbit"])) {
             return response()->json([
                 "status" => false,
                 "message" => "wajib ada penerbit",
                 "data" => null
             ]);
         }
         if (!isset($payload["kota"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada kota",
                "data" => null
            ]);
        }
        if (!isset($payload["bahasa"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada bahasa",
                "data" => null
            ]);
        }
        if (!isset($payload["isbn"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada isbn",
                "data" => null
            ]);
        }
        if (!isset($payload["deskripsi"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada deskripsi",
                "data" => null
            ]);
        }
        if (!isset($payload["tahun"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada tahun",
                "data" => null
            ]);
        }
        if (!isset($payload["kategori"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada kategori",
                "data" => null
            ]);
        }
        if (!isset($payload["stok"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada stok",
                "data" => null
            ]);
        }

         $book = book::query()->create($payload);
         return response()->json([
             "status" => true,
             "message" => "",
             "data" => $book->makeHidden([

                "created_at",
                "updated_at"
             ])
         ]);
     }

    public function update(Request $request, $id)
    {
        $payload = $request->except(['foto']);
        $book = Book::find($id);
        if (isset($request->foto)) {
            Storage::disk('public')->delete($book->foto);
            $payload["foto"] = $request->foto->store('gambar', 'public');
        }

        $book->update($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $book
        ]);
    }

     function destroy($id){

        $book = Book::query()->where("id", $id)->first();

        if ($book == null) {
            return response()->json([
                "status" => false,
                "message" => "book tidak ditemukan",
                "data" => null
            ]);
        }

        $book = Book::destroy($id);

        return response()->json([
            "status" => true,
            "message" => "berhasil dihapus"
        ]);
     }
}
