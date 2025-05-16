<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Commands\PersonFileUploadCommand;
use App\Application\Handlers\PersonFileUploadHandler;
use App\Domain\Enums\ImportingEntityType;
use App\Domain\Models\ValueObjects\FilePath;
use App\Domain\Models\ValueObjects\UploadedImportFile;
use App\Http\Requests\PersonFileUploadRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PersonFileUploadController extends Controller
{
    public function showForm(): View|Factory
    {
        return view('person_file_upload');
    }

    public function upload(PersonFileUploadRequest $request, PersonFileUploadHandler $handler): RedirectResponse
    {
        $file = $request->validated('file');

        $command = new PersonFileUploadCommand(
            new UploadedImportFile(
                $file->getClientOriginalName(),
                $file->getClientOriginalExtension(),
                new FilePath($file->getRealPath()),
                ImportingEntityType::PERSON
            )
        );

        if ($handler->handle($command)) {
            return back()->with('success', 'Файл успешно загружен');
        }

        return back()->with('error', 'Ошибка при загрузке файла');
    }
}
