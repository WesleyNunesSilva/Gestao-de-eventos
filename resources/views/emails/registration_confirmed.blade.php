<!DOCTYPE html>
<html>
    <head>
        <title>Confirmação de Pagamento</title>
    </head>
    <body class="body-email">

        <div class="container email-container">
            <h2 class="email-heading">Confirmação de Pagamento</h2>
    
            <p>Olá <strong>{{ $registration->user->name }}</strong>,</p>
    
            <p>O seu pagamento para o evento "<strong>{{ $registration->event->title }}</strong>" foi confirmado com sucesso.</p>
    
            <p><strong>Data do evento:</strong> {{ $registration->getFormattedEventDateAttribute() }}</p>
    
            <p><strong>Valor pago:</strong> {{ $registration->event->getFormattedPriceAttribute() }}</p>
    
            <p>Obrigado por participar do nosso evento. Qualquer dúvida, entre em contato conosco.</p>

        </div>
    
    </body>
</html>