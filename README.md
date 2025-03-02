# Skladiše, TSD

- Predmet: Dizajn baze podataka
- Mentor: Krešimir Ećimović
- Izradio: [Alexander Gustovaracg](https://alexandergustovarac.from.hr/), 3.RT (2023)
- Obrazovna ustanova: [Tehnička škola Daruvar, Daruvar (TSD)](https://www.tsd.hr/site)

## Dokumentacija

- Zahtijev i zadatak: [PDF](/docs/Skladište%20zahtijev.pdf)
- Analiza zahtijeva: [PDF](/docs/AG20221103%20-%20Skladište%20-%20Analiza%20zahtijeva.pdf), [WORD](/docs/AG20221103%20-%20Skladište%20-%20Analiza%20zahtijeva.docx)
- Izvedba: [PDF](/docs/AG20230501%20-%20Skladište.pdf), [WORD](/docs/AG20230501%20-%20Skladište.docx)

## Opis

## O radu

Potrebno je osmisliti i realizirati bazu podataka koja može učinkovito poslužiti za
potrebe skladišnog prostora. U fazi analize, utvrđeno je da skladište raspolaže s
odredbenom količinom polica na kojima se može skladištiti materijal. Svaka
polica je označena šifrom i pojedina roba može zauzeti jednu ili više polica.

Skladišni prostor se iznajmljuje i skladište vodi evidenciju o svom prostoru
(zauzetosti), vrsti robe koja je uskladištena, starosti i roku upotrebe (za kvarljivu
robu). Na kraju svakog tjedna se radi pregled podataka i provjerava da li postoji
roba kojoj ističe rok u slijedećih mjesec dana — u slušaju da postoji — mora se
poslati obavijest zakupcu police s informacijom da se robi bliži istek roka
upotrebe i da ju mora preuzeti u slijedećih mjesec dana. Također postoji
evidencija zakupaca prostora (kojima skladište iznajmljuje police) gdje su
uneseni osnovni podaci 0 njima (naziv, adresa, kontakt podaci, ...) i ukupan broj
polica koje su dosad iznajmili. Osnovni zahtjevi korisnika su slijedeći:
- omogućiti uvid u postojeće stanje: zauzetost i raspoloživost prostora
- omogućiti pregled uskladištene robe kojoj uskoro istječe rok upotrebe — i
kojem zakupcu roba pripada
- zakup prostora (polica) u skladištu

Baza podataka treba biti u što većoj mjeri normalizirana, zadaci:
1. Napraviti ER dijagram (entity-relationship diagram) dijagram sa svim
bitnim elementima.
2. Napraviti relacijski model
3. Dati kradi tekstualni opis odabranog rješenja uz osvrt na eventualne
specifičnosti, pretpostavke ili ograničenja u modelu.
4. Napraviti SQL naredbe za kreiranje baze podataka koja odgovara
relacijskom modelu.
5. Napraviti SQL naredbe kojima se baza puni podacima za potrebe
testiranja.
6. Napraviti primjer SQL upita za koje se očekuje da će biti najčešće
upotrebljavani od strane korisnika baze podataka (prema zahtjevima u opisu
zadatka), opisati ih riječima (koja je svrha upita?) i dati konkretni primjer
rezultata kakav se dobije takvim upitom.

## Baza podataka (ER dijagram)

ER dijagram: [PNG](/docs/AG20221103%20-%20Skladište.png), [GRAPHML](/docs/AG20221103%20-%20Skladište.graphml)

![ER dijegram: slika](/docs/AG20221103%20-%20Skladište.png)

## Zaključak

Tijekom zadaće stekli smo osnovna znanja o bazama podataka te se upoznali
sa samim radom mysql baze podataka (XAMPP). Kroz proces učenja savladali smo
osnovne naredbe SQL jezika kao što su SELECT, INSERT, UPDATE, JOIN, AS,
DELETE, AND. Također smo primijetili da postoje različite vrste baza podataka, od
kojih se posebno ističe vrsta InnoDB jer dopušta korištenje stranih ključeva i
ograničenja u bazi podataka.
XAMPP samo koristili jer je vrlo mali i jednostavan program sa svim potrebnim
dodacima. Za crtanje ER digrama korišten je program YedGrph Editor, a za
ispitivanje uvjeta korišten je program PHPmyAdmin. Njime je ispitivano da li su uvjeti
pri ispisu podataka zadovoljeni.