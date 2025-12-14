<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; background-color: #f3f4f6; padding: 20px; }
        .container { background-color: white; padding: 30px; border-radius: 10px; max-w: 600px; margin: 0 auto; }
        .header { color: #003366; font-size: 20px; font-weight: bold; margin-bottom: 20px; border-bottom: 2px solid #D4AF37; padding-bottom: 10px; }
        .label { font-weight: bold; color: #555; }
        .message { background-color: #f9fafb; padding: 15px; border-left: 4px solid #003366; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Nouveau message du site web</div>
        
        <p><span class="label">Nom :</span> {{ $data['name'] }}</p>
        <p><span class="label">Email :</span> {{ $data['email'] }}</p>
        <p><span class="label">Sujet :</span> {{ $data['subject'] }}</p>
        
        <div class="message">
            {!! nl2br(e($data['message'])) !!}
        </div>
    </div>
</body>
</html>