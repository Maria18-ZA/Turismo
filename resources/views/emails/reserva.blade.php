<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nova Reserva</title>
</head>
<body style="font-family: Arial; background: #f4f4f4; padding: 30px;">

    <div style="
        max-width: 600px;
        margin: auto;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    ">

        <div style="
            background: #0f172a;
            color: white;
            padding: 20px;
            text-align: center;
        ">
            <h1>Nova Reserva Recebida</h1>
        </div>

        <div style="padding: 30px;">

            <h2 style="color: #0f172a;">
                Dados da Reserva
            </h2>

            <p>
                <strong>Cliente:</strong>
                {{ $reserva->nome }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ $reserva->email }}
            </p>

            <p>
                <strong>Telefone:</strong>
                {{ $reserva->telefone }}
            </p>

            <p>
                <strong>Check-in:</strong>
                {{ $reserva->check_in }}
            </p>

            <p>
                <strong>Check-out:</strong>
                {{ $reserva->check_out }}
            </p>

            <p>
                <strong>Quarto:</strong>
                {{ $reserva->quarto->nome ?? 'Não definido' }}
            </p>

            <hr>

            <p style="color: #666;">
                Esta reserva foi enviada automaticamente pelo sistema.
            </p>

        </div>

    </div>

</body>
</html>