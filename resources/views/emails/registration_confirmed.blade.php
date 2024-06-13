<!DOCTYPE html>
<html>
    <head>
        <title>Confirmação de Inscrição</title>
    </head>
    <body>
        <h1>Confirmação de Inscrição</h1>
        <p>Olá {{ $registration->user->name }},</p>
        <p>Sua inscrição para o evento {{ $registration->event->title }} foi confirmada!</p>
    </body>
</html>
