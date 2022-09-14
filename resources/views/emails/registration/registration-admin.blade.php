<html>
<body style="">
<p style="font-size: 15px">
    Er is een nieuwe registratie in TTIStore
</p>
<br>
Gegevens:
<br>
Naam: <b>{{ $request->name }}</b>
<br>
Voornamen: <b>{{ $request->firstname }}</b>
<br>
@isset($request->company_name)
    Bedrijf: <b>{{ $request->company_name }}</b>{{ $request->company_name }}
    <br>
    Soort bedrijf: <b>{{ $request->company_type }}</b>
    <br>
@endisset
Adres: <b>{{ $request->address }}</b>
<br>
Telefoonnummer: <b>{{ $request->phone }}</b>
<br>
Email adres: <b>{{ $request->email }}</b>
</body>
</html>
