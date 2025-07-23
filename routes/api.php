<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/foo', function () {
    return 'foo';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta de prueba para correos (temporal)
Route::get('/test-mail', function () {
    try {
        Mail::raw('Este es un correo de prueba desde Laravel con Gmail', function ($message) {
            $message->to('tu-email-destino@gmail.com')
                    ->subject('Prueba de correo desde FileManager API');
        });
        
        return response()->json(['message' => 'Correo enviado exitosamente']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al enviar correo: ' . $e->getMessage()], 500);
    }
});

include __DIR__.'/auth.php';