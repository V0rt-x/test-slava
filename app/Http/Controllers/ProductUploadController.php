<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsUploadRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class ProductUploadController extends Controller
{
    public function showForm(): View|Factory
    {
        return view('upload');
    }

    public function upload(ProductsUploadRequest $request): RedirectResponse
    {
        if ($request->file('file')->isValid()) {
            $request->file('file')->storeAs('products_uploads', sprintf('products_%s.xlsx', Carbon::now()->format('Y-m-d_H-i-s')));

            return back()->with('success', 'Файл успешно загружен');
        }

        return back()->with('error', 'Ошибка при загрузке файла');
    }
}
