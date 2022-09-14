<html>
<h1>
    Er is een nieuwe registratie in TTIStore
    <br>
    Gegevens:
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
