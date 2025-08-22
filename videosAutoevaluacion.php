<?php
$videos = [
    [
        'titulo' => 'Respiración para la calma',
        'descripcion' => 'Aprende una técnica sencilla de respiración para reducir la ansiedad.',
        'url' => 'https://www.youtube.com/embed/1min_video_id',
        'fecha' => '2025-08-21'
    ],
    [
        'titulo' => 'Relajación muscular progresiva',
        'descripcion' => 'Guía paso a paso para relajar tu cuerpo y mente.',
        'url' => 'https://www.youtube.com/embed/2min_video_id',
        'fecha' => '2025-08-20'
    ],
    [
        'titulo' => 'Meditación guiada para principiantes',
        'descripcion' => 'Una meditación corta para empezar el día con energía positiva.',
        'url' => 'https://www.youtube.com/embed/3min_video_id',
        'fecha' => '2025-08-19'
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Videos de Autoevaluación</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-200 min-h-screen flex flex-col items-center text-gray-800">

    <header class="w-full bg-white shadow-md p-4 flex justify-between items-center rounded-b-2xl">
        <h1 class="text-3xl font-extrabold text-blue-700 ml-2">Videos de Autoevaluación</h1>
        <button onclick="location.href='index.php'"
            class="flex items-center gap-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-xl shadow transition">
            <span class="material-icons">arrow_back</span>
            Volver
        </button>
    </header>

    <main class="flex-grow w-full max-w-5xl p-4 md:p-8 mt-8">