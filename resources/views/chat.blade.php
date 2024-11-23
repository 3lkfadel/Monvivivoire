@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Chat avec notre assistant intelligent</h1>
    <div id="chatbox" style="height: 300px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
        <!-- Les messages seront affichés ici -->
    </div>
    <form id="chat-form">
        <div class="input-group">
            <input type="text" id="message" class="form-control" placeholder="Écrivez votre message...">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('chat-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const message = document.getElementById('message').value;

        // Affiche le message utilisateur
        const chatbox = document.getElementById('chatbox');
        chatbox.innerHTML += `<p><strong>Vous :</strong> ${message}</p>`;
        chatbox.scrollTop = chatbox.scrollHeight;

        // Envoie la requête au serveur
        const response = await fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ message }),
        });

        const data = await response.json();
        const botReply = data.choices[0].text.trim();

        // Affiche la réponse du bot
        chatbox.innerHTML += `<p><strong>Bot :</strong> ${botReply}</p>`;
        chatbox.scrollTop = chatbox.scrollHeight;

        // Réinitialise le champ de saisie
        document.getElementById('message').value = '';
    });
</script>
@endsection
