<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderby('name')->get();
       
        $data = [
            'title' => 'Contacts',
            'contacts' => $contacts
        ];
        
        return view('contact-us.index', $data);
    }

    public function send(Request $request)
    {
        // Validasi dan proses pengiriman pesan
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Logika pengiriman pesan atau penyimpanan data
        Contact::create($validated);

        return redirect()->route('home')->with('success', 'Pesan Anda telah terkirim!');
    }

    public function show(string $id)
    {
        $contact = Contact::find($id);
        $data = [
            "title" => "Contact Detail",
            "contact" => $contact
        ];
        return view('contact-us.detail', $data);
    }

    public function destroy(string $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete(); // menggunakan soft delete

            return redirect()->route('contact.index')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect()->route('contact.index')->with("errorMessage", "Data gagal dihapus!");
        }
    }

}
