<html>
<h1>
    Bedankt voor het registreren bij TTIStore. Wij zullen uw gegevens controleren en een confirmatie email sturen als u account geactiveerd is.
    <br>
    Uw gegevens:
    <br>
    Naam: {{ $request->name }}
    <br>
    Voornamen: {{ $request->firstname }}
    <br>
    @isset($request->company_name)
        Bedrijf: {{ $request->company_name }}
        <br>
        Soort bedrijf: {{ $request->company_type }}
        <br>
    @endisset
    Adres: {{ $request->address }}
    <br>
    Telefoonnummer: {{ $request->phone }}
    <br>
    Email adres: {{ $request->email }}
</h1>
</html>
