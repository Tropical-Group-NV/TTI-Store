<html>
<body style="">
<p style="font-size: 15px">
    Bedankt voor het willen registreren bij TTIStore. Wij zullen uw gegevens controleren en een confirmatie email sturen als uw account geactiveerd is.
</p>
<br>
Uw gegevens:
<br>
Naam: <b>{{ $request->name }}</b>
<br>
Voornamen: <b>{{ $request->firstname }}</b>
<br>
@isset($request->company_name)
    Bedrijf: <b>{{ $request->company_name }}</b>
    <br>
    Soort bedrijf: <b>{{ $request->company_type }}</b>
    <br>
@endisset
Adres: <b>{{ $request->address }}</b>
<br>
Telefoonnummer: <b>{{ $request->phone }}</b>
<br>
Email adres: <b>{{ $request->email }}</b>
<br>
<br>
</body>
</html>
