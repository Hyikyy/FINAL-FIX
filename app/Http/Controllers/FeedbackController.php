<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeedbackController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $feedbacks = Feedback::all(); // Ambil semua feedback
        return view('admin.feedback.index', compact('feedbacks')); // Kirim data ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'berita_id' => 'required|exists:beritas,id',
            'isi' => 'required|string',
            'tanggal' => 'required|date'
        ]);

        // Cek apakah user sudah memberikan feedback untuk berita ini
        $existingFeedback = Feedback::where('berita_id', $request->berita_id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($existingFeedback) {
            return back()->with('error', 'Anda sudah memberikan feedback untuk berita ini.');
        }
        $data = $request->all();

        //Tambahkan user_id dan nama
        $data['user_id'] = Auth::id(); //ambil id user
        $data['nama'] = Auth::user()->name; //ambil nama user
        Feedback::create($data);

        return back()->with('success', 'Feedback berhasil ditambahkan!');
    }

    public function edit(Feedback $feedback)
    {
        $this->authorize('update', $feedback); // Periksa otorisasi

        return view('feedback.edit', compact('feedback')); // Buat view edit
    }

    public function update(Request $request, Feedback $feedback)
    {
        $this->authorize('update', $feedback); // Periksa otorisasi

        $request->validate([
            'isi' => 'required|string',
             'tanggal' => 'required|date'
        ]);

        $feedback->update($request->only('isi','tanggal'));

        return back()->with('success', 'Feedback berhasil diupdate!');
    }

    public function destroy(Feedback $feedback)
    {
        $this->authorize('delete', $feedback); // Periksa otorisasi

        $feedback->delete();

        return back()->with('success', 'Feedback berhasil dihapus!');
    }

    public function destroyByAdmin(Feedback $feedback)
    {
        // Tidak perlu otorisasi karena sudah di middleware 'admin'

        $feedback->delete();

        return back()->with('success', 'Feedback berhasil dihapus oleh Admin!');
    }
}