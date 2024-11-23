<form action="{{ route('chat.send') }}" method="POST">
    @csrf
    <input type="text" name="message" placeholder="Votre message">
    <button type="submit">Envoyer</button>
</form>
