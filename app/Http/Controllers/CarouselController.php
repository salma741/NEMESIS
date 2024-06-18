<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderby('title')->get();

        $data = [
            'title' => 'Carousels',
            'carousels' => $carousels
        ];

        return view('carousel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Carousels',
        ];

        return view('carousel.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Silakan isi nama.',
            'description.required' => 'Silakan isi deskripsi.',
        ];

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|mimes:jpg,png,jpeg|max:1024',
        ], $messages);


        try {
            if($request->hasFile('image')) {
                $data['image'] = $request->file("image")->store('img', 'public');
            } else {
                $data['image'] = null;
            }

            Carousel::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan.');
            return redirect('carousel');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('carousel');
        }
    }

    public function edit(string $id)
    {
        $carousel = Carousel::find($id);
        if(!$carousel) {

            return redirect('carousel')->with("errorMessage", 'Carousel tidak dapat ditemukan');
        }
        $data = [
            'title' => 'Edit carousels',
            'carousel' => $carousel
        ];

        return view('carousel.form', $data);
    }

    public function update(Request $request, string $id)
    {
        $messages = [
            'title.required' => 'Silakan isi nama.',
            'description.required' => 'Silakan isi deskripsi.',
        ];

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|mimes:jpg,png,jpeg|max:1024',
        ], $messages);


        try {
            if($request->hasFile('image')) {
                $data['image'] = $request->file("image")->store('img', 'public');
            } else {
                $data['image'] = null;
            }

            $carousel = Carousel::findOrFail($id);
            $carousel->update($data);

            Alert::success('Sukses', 'Data berhasil diperbarui.');
            return redirect('carousel');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('carousel');
        }
    }

    public function show(string $id)
    {
        $carousel = Carousel::find($id);
        $data = [
            "title" => "Carousel Detail",
            "carousel" => $carousel
        ];
        return view('carousel.detail', $data);
    }

    public function destroy(string $id)
    {
        try {
            $carousel = Carousel::findOrFail($id);
            $carousel->delete(); // menggunakan soft delete

            return redirect('carousel')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect('carousel')->with("errorMessage", "Data gagal dihapus!");
        }
    }
}
