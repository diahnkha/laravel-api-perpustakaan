<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Author;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    //
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
         $author = Author::query()->get();
         return response()->json([
             "status" => true,
             "message" => "",
             "data" => $author
         ]);
     }

     function show($id)
     {
         $author = Author::query()->where("id", $id)->first();

         if ($author == null) {
             return response()->json([
                 "status" => false,
                 "message" => "author tidak ditemukan",
                 "data" => null
             ]);
         }

         return response()->json([
             "status" => true,
             "message" => "",
             "data" => $author
         ]);
     }

     function store(Request $request)
     {
         $payload = $request->all();
         $payload['foto'] = $request->file("foto")->store("gambar", "public");
         if (!isset($payload["nama_depan"])) {
             return response()->json([
                 "status" => false,
                 "message" => "wajib ada nama_depan",
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
         if (!isset($payload["nama_belakang"])) {
             return response()->json([
                 "status" => false,
                 "message" => "wajib ada nama_belakang",
                 "data" => null
             ]);
         }

         if (!isset($payload["email"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada email",
                "data" => null
            ]);
        }
        if (!isset($payload["alamat"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada alamat",
                "data" => null
            ]);
        }

         $author = Author::query()->create($payload);
         return response()->json([
             "status" => true,
             "message" => "",
             "data" => $author->makeHidden([

                "created_at",
                "updated_at"
             ])
         ]);
     }

    public function update(Request $request, $id)
    {
        $payload = $request->except(['foto']);
        $author = Author::find($id);
        if (isset($request->foto)) {
            Storage::disk('public')->delete($author->foto);
            $payload["foto"] = $request->foto->store('gambar', 'public');
        }

        $author->update($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $author
        ]);
    }

     function destroy($id){

        $author = Author::query()->where("id", $id)->first();

        if ($author == null) {
            return response()->json([
                "status" => false,
                "message" => "author tidak ditemukan",
                "data" => null
            ]);
        }

        $author = Author::destroy($id);

        return response()->json([
            "status" => true,
            "message" => "berhasil dihapus"
        ]);
     }
}
