<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryController extends Controller
{
    //
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
         $category = Category::query()->get();
         return response()->json([
             "status" => true,
             "message" => "",
             "data" => $category
         ]);
     }

     function show($id)
     {
         $category = Category::query()->where("id", $id)->first();

         if ($category == null) {
             return response()->json([
                 "status" => false,
                 "message" => "category tidak ditemukan",
                 "data" => null
             ]);
         }

         return response()->json([
             "status" => true,
             "message" => "",
             "data" => $category
         ]);
     }

     function store(Request $request)
     {
         $payload = $request->all();
         $payload['foto'] = $request->file("foto")->store("gambar", "public");
         if (!isset($payload["nama_kategori"])) {
             return response()->json([
                 "status" => false,
                 "message" => "wajib ada nama_kategori",
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
         if (!isset($payload["deskripsi"])) {
             return response()->json([
                 "status" => false,
                 "message" => "wajib ada deskripsi",
                 "data" => null
             ]);
         }

         $category = Category::query()->create($payload);
         return response()->json([
             "status" => true,
             "message" => "",
             "data" => $category->makeHidden([

                "created_at",
                "updated_at"
             ])
         ]);
     }

    public function update(Request $request, $id)
    {
        $payload = $request->except(['foto']);
        $category = Category::find($id);
        if (isset($request->foto)) {
            Storage::disk('public')->delete($category->foto);
            $payload["foto"] = $request->foto->store('gambar', 'public');
        }

        $category->update($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $category
        ]);
    }

     function destroy($id){

        $category = Category::query()->where("id", $id)->first();

        if ($category == null) {
            return response()->json([
                "status" => false,
                "message" => "category tidak ditemukan",
                "data" => null
            ]);
        }

        $category = Category::destroy($id);

        return response()->json([
            "status" => true,
            "message" => "berhasil dihapus"
        ]);
     }
}
