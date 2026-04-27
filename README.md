

NETWAVE
------------------------------------------------------------------------------------------------------
Ky projekt përfaqëson një website informativ dhe funksional për kompaninë “NetWave” , e cila ofron shërbime të telekomunikacionit si: Mobile, TV, Internet dhe E-Shop  për pajisje elektronike. Website-i është ndërtuar për qëllime mësimore dhe demonstruese duke përdorur teknologjitë bazë të web-it.

Përshkrimi i Projektit
------------------------------------------------------------------------------------------------------
Website-i i NetWave është dizajnuar për të informuar dhe tërhequr klientët përmes një strukture të qartë dhe përmbajtjeje të organizuar mirë.  
Ai përmban disa seksione kryesore që paraqesin shërbimet dhe ofertat e kompanisë, si dhe forma interaktive për aktivizimin e pakove.


Homepage
------------------------------------------------------------------------------------------------------
Faqja kryesore përmban:
- Menu navigimi me linqe: Rreth Nesh, Mobile, TV, Internet.
- Prezantim të pakove dhe ofertave promocionale.
- Seksion informues “Rreth Nesh”, ku shpjegohen informatat kryesore të kompanisë NetWave
Homepage është ndërtuar duke përdorur HTML, CSS dhe JavaScript për strukturë, dizajn dhe ndërveprim.

Seksioni TV
------------------------------------------------------------------------------------------------------
Seksioni TV përmban:
- Pako vetëm për TV
- Pako të kombinuara TV + Internet
- Listën e kanaleve televizive që ofron NetWave 
- Formë për aktivizimin e pakove online

Seksioni Internet
------------------------------------------------------------------------------------------------------
Ky seksion përfaqëson shërbimet e internetit që NetWave ofron për përdorim familjar, personal dhe biznesor.
Përfshin tre nënseksione kryesore:
Fiber Internet
- Internet me fibër optike
- Shpejtësi e lartë dhe stabilitet maksimal
5G Internet
- Internet me valë me teknologjinë më të fundit 5G
- Përdorim pa kabllo në zona me mbulim 5G
Telefoni Fiks
- Shërbim i telefonisë fikse
- Komunikim i qëndrueshëm dhe ekonomik për shtëpi dhe biznese

Seksioni E-Shop
------------------------------------------------------------------------------------------------------
E-Shop është dyqani online i NetWave, ku përdoruesit mund të blejnë pajisje elektronike dhe smart-device.
Përfshin katër kategori kryesore:
Telefona
- Smartphone nga brende të njohura
Laptopë
- Laptopë për studime, punë dhe dizajn
- Konfigurime të ndryshme sipas nevojës
Televizorë
- Televizorë modernë nga brende të njohura
Routera
- Routera për lidhje stabile & shpejtësi interneti

Teknologjitë e Përdorura
------------------------------------------------------------------------------------------------------
- HTML5 – Struktura e faqes
- CSS3 – Dizajni dhe layout-i
- JavaScript – Funksionaliteti dhe ndërveprimi
- PHP - Gjenerimi dinamik i faqeve, menaxhimi i sesioneve (login/logout) dhe organizimi modular përmes includes
- GitHub – Menaxhimi i punës dhe bashkëpunimi në grup

Struktura e Projektit
------------------------------------------------------------------------------------------------------

```
Ueb1_Projekti_Grupi/
│
├── assets/
│   ├── css/
│   │   ├── 5G.css
│   │   ├── abonohu.css
│   │   ├── channels-list.css
│   │   ├── fiber_internet.css
|   |   ├── pagesa.css
|   |   ├── telecomoperator.css
|   |   ├── telefona.css
|   |   ├── telefoniafikse.css
|   |   ├── tv-packages.css
|   |   ├── tv+internet.css
│   │
│   │
│   ├── images/
│   │   ├── fiber/
│   │   ├── icons/
│   │   ├── kanalet-arte-marciale/
|   |   ├── kanalet-e-muzikes/
|   |   ├── kanalet-e-sportit/
|   |   ├── kanalet-informuese/
|   |   ├── kanalet-motosport/
|   |   ├── kanalet-per-dokumentarë/
|   |   ├── kanalet-per-femije/
|   |   ├── kanalet-per-filma/
|   |   ├── laptopa/
|   |   ├── phones/
|   |   ├── routera/
|   |   ├── telecomoperator_foto/
|   |   └── televizora/
│   │   
│   │
│   └── js/
│       ├── abonohu.js
│       ├── pagesa.js
|       ├── telecomoperator.js
|       ├── tv-packages.js
|       └── tv+internet.js
├── classes
|   ├── MenaxheriProdukteve.php
|   ├── Produkti.php
|   └── Telefoni.php
├── includes
|   ├── footer.php
|   ├── header.php
|   └── navbar.php
├── netwave(React)
|   ├── node_modules/
|   ├── public/
|   ├── src/
|   ├── package-lock.json
|   └── package.json
├── pages
|   ├── 5G.php
|   ├── abonohu.php
|   ├── admin.php
|   ├── channels-list.php
|   ├── fiber_internet.php
|   ├── laptopa.php
|   ├── pagesa.php
|   ├── perdoruesit.php
|   ├── routera.php
|   ├── telecomeoperator.php
|   ├── telefona.php
|   ├── telefoniafikse.php
|   ├── televizora.php
|   ├── tv-packages.php
|   └── tv+internet.php
├── config.php
├── index.html
├── login.php
├── logout.php
└── README.md
```

Si të Ekzekutohet Projekti
------------------------------------------------------------------------------------------------------
1.	Klono repository-n:
 	git clone https://github.com/FinesaMaxhuni/UEB2_Projekti_Grupi36.git
2.	Hape folderin e projektit ne Visual Studio
3.	Bej ndryshime dhe ekzekutoji ato

