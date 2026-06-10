<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    // ─── Public ──────────────────────────────────────────────────────────────────

    public function index()
    {
        $news = News::with('author:id,name')->latest()->paginate(9);
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    // ─── Admin ───────────────────────────────────────────────────────────────────

    public function adminIndex()
    {
        $news = News::with('author:id,name')->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form', ['news' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'title'     => $request->title,
            'content'   => $request->content,
            'author_id' => session('user.id'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($data);

        return redirect('/admin/news')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'title'   => $request->title,
            'content' => $request->content,
        ];

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect('/admin/news')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return redirect('/admin/news')->with('success', 'Berita berhasil dihapus.');
    }
}
