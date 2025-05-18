<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка файла</title>
</head>
<body>
<h2>Загрузить файл</h2>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@if($errors->has('file'))
    <p>{{ $errors->first('file') }}</p>
@endif

@if(session('error'))
    <p>{{ session('error') }}</p>
@endif
<form action="{{ route('persons.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button type="submit">Загрузить</button>
</form>
</body>
</html>
