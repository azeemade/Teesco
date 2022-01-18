<?php

namespace App\Http\Controllers;

use App\Models\Imprint;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();

        return response()->json([
            'status' => (bool) $product,
            'message' => $product ? 'Products list available' : 'An Error Occured',
            'data' => $product->transform(function ($product) {
                return
                    [
                        'id' => $product->id,
                        'product_name' => $product->name,
                        'product_price' => $product->price,
                        'product_units' => $product->units,
                        'product_description' => $product->description,
                        'product_image' => $product->image,
                        'product_color' => $product->color,
                        'product_size' => $product->size->size_title,
                        'product_imprint' => $product->imprint->imprint_title
                    ];
            })
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'status' => (bool) $product,
            'message' => $product ? 'Product is available' : 'An Error Occured',
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'units' => $product->units,
                'description' => $product->description,
                'image' => $product->image,
                'color' => $product->color,
                'size' => $product->size->size_title,
                'imprint' => $product->imprint->imprint_title
            ]
        ]);
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('image')) {
            $name = time() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
        }
        return response()->json(asset("images/$name"), 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreate(Request $request)
    {
        if ($request->hasFile('image')) {
            $name = time() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
        }
        //return response()->json();

        $product = Product::updateOrCreate([
            'id' => $request->id,
        ], [
            'name' => $request->name,
            'price' => $request->price,
            'units' => $request->units,
            'description' => $request->description,
            'image' => $name,
            'color' => $request->color,
            'size_id' => $request->size_id,
            'imprint_id' => $request->imprint_id
        ]);

        return response()->json(
            //asset("images/$name"),
            //201,
            [
                'status' => (bool) $product,
                'message' => $product ? 'Product Action Successful!' : 'Error Performing Product Action'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $status = $product->delete();

        return response()->json([
            'status' => (bool) $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }

    public function exportCSV(Request $request)
    {
        $fileName = 'ProductsData.csv';
        $products = Product::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array("Id", "Name", "Price", "Units", "Description", "Image Link", "Color", "Size", "Imprint", "Date Created");

        $callback = function () use ($products, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($products as $product) {
                $row['Id'] = $product->id;
                $row['Name'] = $product->name;
                $row['Price'] = $product->price;
                $row['Units'] = $product->units;
                $row['Description'] = $product->description;
                $row['Image Link'] = $product->image;
                $row['Color'] = $product->color;
                $row['Size'] = $product->size->size_title;
                $row['Imprint'] = $product->imprint->imprint_title;
                $row['Date Created'] = $product->created_at;

                fputcsv($file, array($row['Id'], $row['Name'], $row['Price'], $row['Units'], $row['Description'], $row['Image Link'], $row['Color'], $row['Size'], $row['Imprint'], $row['Date Created']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
