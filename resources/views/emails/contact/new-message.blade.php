<html>
<h1>
    Er is een nieuw bericht binnen gekomen van {{ $mesg->name }}
</h1>
<br>
<h2>Subject: {{ $mesg->subject }}</h2>
<p>
    {{$mesg->message}}
</p>
<p>
    <i>Gegevens zender:</i>
    <br>
    <i>
        - Naam: {{ $mesg->name }}
    <br>
        - Telefoon: {{ $mesg->phone }}
        <br>
        - Email: {{ $mesg->email }}
    </i>
</p>
</html>
