<!DOCTYPE html>
<html>
<head>
    <title>Jelentkezés Visszajelzés</title>
</head>
<body>
    <h2>{{ $status === 'accepted' ? 'Gratulálunk!' : 'Sajnáljuk!' }}</h2>
    <p>
        Tisztelt {{ $applicant->student->first()->user->name }}!
    </p>
    <p>
        Örömmel értesítjük, hogy jelentkezéséről döntés született a "{{ $applicant->diplomaTheses->first()->title }}" című dolgozatra.
    </p>
    <p>
        @if($status === 'accepted')
            Nagy örömmel tájékoztatjuk, hogy jelentkezését elfogadtuk. Kérjük, vegye fel a kapcsolatot konzulens tanárával a további részletek egyeztetése érdekében.
        @else
            Sajnálattal értesítjük, hogy jelentkezését nem áll módunkban elfogadni. Köszönjük megértését és további sok sikert kívánunk a jövőbeni pályázataihoz.
        @endif
    </p>
    <p>
        Üdvözlettel,
    </p>
    <p>
        Sapientia GI
    </p>
</body>
</html>
