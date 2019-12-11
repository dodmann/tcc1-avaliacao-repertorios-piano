<?php
set_time_limit(0);

include("simple_html_dom.php");

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "syllabus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$compositores = ['Abram J.', 'Absil J.', 'Adair Y.', 'Adam A.', 'Adams C.', 'Adams E.', 'Adams J.', 'Agay D.', 'Agnew R.',
    'Albeniz I.', 'Albeniz M.', 'Alberga E.', 'Albright W.', 'Alcock J.', 'Alcon S.', 'Alexander D.', 'Alkan C.',
    'Allen P. and Barry J.', 'Alt H.', 'Alwyn W.', 'Anderson A.', 'Anderson B.', 'Anderson J.', 'Andersson B.',
    'Andersson B. and Ulvaeus B.', 'Andre J.', 'Anhalt I.', 'Anon.', 'Archer V.', 'Arensky A.', 'Arlen H.',
    'Arlen/Harburg', 'Armstrong J.', 'Arne T.', 'Arnold M.', 'Arnold S.', 'Attwood T.', 'Atwell W.', 'Aubert L.',
    'Aucott C.', 'Axtens P.', 'Babbitt M.', 'Babell W.', 'Bach C.P.E.', 'Bach J.C.', 'Bach J.C.F.', 'Bach J.S.',
    'Bach W.F.', 'Bachinskaya N.', 'Bailey J.', 'Bailey K.', 'Baker M.', 'Balakirev M.', 'Balazs A.', 'Balch G.',
    'Barber S.', 'Barenboim L.', 'Barratt C.', 'Barrell B.', 'Bart L.', 'Bartok B.', 'Bastien J.', 'Baumer S.',
    'Baumfelder F.', 'Baustetter J.', 'Bax A.', 'Beach A.', 'Beath B.', 'Beckwith J.', 'Becvarovsky A.',
    'Beethoven L. van', 'Behrens J.', 'Belkin A.', 'Bell A.', 'Benda F.', 'Benda G.', 'Benda J.', 'Benedict R.',
    'Benjamin A.', 'Bennett R.', 'Berens H.', 'Beresford S.', 'Berg A.', 'Berio L.', 'Berkahn J.', 'Berkeley L.',
    'Berkovitch I.', 'Berlin B.', 'Berlin I.', 'Berlioz H.', 'Bernard F.', 'Bernie B.', 'Bernstein L.', 'Bernstein S.',
    'Berr B.', 'Bertini H.', 'Beyer F.', 'Bibby G.', 'Biehl A.', 'Birch S.', 'Bischoff K.', 'Bishop S.', 'Bissell K.',
    'Bizet G.', 'Bjelinski B.', 'Blackwell D.', 'Blake C.', 'Blake H.', 'Bland E.', 'Blatny', 'Bloch E.', 'Blok V.',
    'Blow J.', 'Blumenfeld F.', 'Bober M.', 'Bodorova S.', 'Body J.', 'Bohm G.', 'Boismortier J. de.', 'Boke J.',
    'Bolck J.', 'Bolcom W.', 'Bonds M.', 'Bonis M.', 'Bonsor B.', 'Borodin A.', 'Bortkiewicz S.', 'Botsford G.',
    'Boublil and Schonberg', 'Bouchard R.', 'Boulanger L.', 'Boulez P.', 'Bowen Y.', 'Bowles P.', 'Boyce W.', 'Boyd B.',
    'Brahms J.', 'Brandman M.', 'Bray J.', 'Bregent M.-G.', 'Bridge F.', 'Britten B.', 'Broadstock B.', 'Brophy G.',
    'Brown R.', 'Brown S.', 'Brown T.', 'Brubeck D.', 'Bruce R.', 'Bruch M.', 'Brumby C.', 'Buckley J.', 'Buczynski W.',
    'Buhr G.', 'Bullard A.', 'Burgmuller J.F.', 'Burton T.', 'Busoni F.', 'Butler M.', 'Butterley N.', 'Buttstedt J.',
    'Byers R.', 'Cage J.', 'Cairos R. de', 'Camidge M.', 'Camilleri C.', 'Capers V.', 'Caramia T.', 'Carey R.',
    'Carley I.', 'Carmichael H.', 'Carmichael H. and Arodin S.', 'Carr E.', 'Carr-Boyd A.', 'Carrabre T.', 'Carroll W.',
    'Carter E.', 'Carter-Varney G.', 'Carvalho J. de S.', 'Casanovas', 'Casella A.', 'Caskie H.', 'Cetera P. and Foster D.',
    'Chabrier E.', 'Chadwick G.', 'Chaminade C.', 'Champagne C.', 'Chan K.', 'Chapple B.', 'Charles J.', 'Charlton K.',
    'Chatman S.', 'Cherney B.', 'Chopin F.', 'Chovan K.', 'Christopher R.', 'Chua S.', 'Churchill/Morey', 'Chwatal F.',
    'Cimarosa D.', 'Clapton E.', 'Clark E.', 'Clarke J.', 'Clarke S.', 'Cleaver S.', 'Clementi M.', 'Coburn W.',
    'Colborne-Veel J.', 'Coleridge-Taylor S.', 'Concone G.', 'Confrey Z.', 'Copland A.', 'Corea C.', 'Corelli A.',
    'Corigliano J.', 'Cornick M.', 'Cosentino S.', 'Coulthard J.', 'Couperin F.', 'Cowan C.', 'Cowan M.', 'Cramer J.',
    'Crawley C.', 'Cree Brown C.', 'Cresswell T.', 'Creston P.', 'Crews R.', 'Crosby A.', 'Crosland', 'Crowe P.', 'Crumb G.',
    'Cui C.', 'Cullen D.', 'Curtun H.', 'Czerny C.', 'Dahlgren D.', 'Dallapiccola L.', 'Dandrieu J.', 'Daquin L.',
    'Dargomizhsky A.', 'Davidsson E.', 'Davies E.', 'De Jong S.', 'De Senneville P.', 'Debussy C.', 'Decoursey R.',
    'DeHolt J.', 'Dela M.', 'Delibes L.', 'Delius F.', 'Dello Joio N.', 'Deshevov V.', 'Desmond P.', 'Despic D.',
    'Despreaux', 'Dett R.', 'Diabelli A.', 'Diamond N.', 'Dichler', 'Diendorfer C.', 'Dieupart C.', 'Dieupart E.', '
    DIndy V.', 'Ding S.', 'Dittersdorf C.', 'Dohnanyi E.', 'Dolin S.', 'Donkin C.', 'Doolittle Q.', 'Doorly G.', '
    Doring', 'Dorsey T.', 'Drayton P.', 'Dring M.', 'Du M. and Wu Z.', 'Dubois P.', 'Duke D.', 'Dun T.', 'Duncan M.',
    'Duncombe W.', 'Dunhill T.', 'Durham B.', 'Durko Z.', 'Duro S.', 'Dusek F.', 'Dussek J.', 'Dutilleux H.',
    'Duvernoy F.', 'Duvernoy J.', 'Dvorak A.', 'Dylan Jones M.', 'Dyson G.', 'Eabunksl W.', 'Eagles M.', 'Earl D.',
    'Easton M.', 'Eben P.', 'Eckhardt-Gramatte S.', 'Edwards R.', 'Eggleston A.', 'Elaine S.', 'Elfman D.', 'Elgar E.',
    'Elias B.', 'Ellington D.', 'Elmsly J.', 'Emonts F.', 'Enckhausen', 'Espla', 'Estevez', 'Eurina L.', 'Eustace B.',
    'Evangelista J.', 'Evans B.', 'Evans L.', 'Evans W.', 'Fairbank N.', 'Faith R.', 'Falla M. de.', 'Faltermeyer M.',
    'Farquar D.', 'Farquhar D.', 'Farr G.', 'Farrenc J.', 'Faure G.', 'Feldman M.', 'Ferguson H.', 'Ferguson S.',
    'Ferrell B.', 'Ferrer J.', 'Fiala G.', 'Fibich Z.', 'Field J.', 'Filtz B.', 'Fina J.', 'Finch D.', 'Fine I.',
    'Finney R.', 'Finnissy M.', 'Fiocco J.', 'Fischer J.', 'Fischer L.', 'Fisher J.', 'Fisher M.', 'Fitch G.',
    'Flagello N.', 'Fleming R.', 'Fly L.', 'Fogerty J.', 'Ford A.', 'Forsyth M.', 'Foster', 'Francaix J.', 'Franck C.',
    'Franklin J.', 'Fredrich F.', 'Freed D.', 'Freed D. ed. Bibby', 'Freedman H.', 'Frey G.', 'Frid G.', 'Fuchs R.',
    'Gade N.', 'Gallant P.', 'Galuppi B.', 'Garant S.', 'Gardiner M.', 'Garner E.', 'Garscia J.', 'Garztecka I.',
    'Gayrhos E.', 'Gellman S.', 'Gellnick F.', 'George J.', 'Gershwin G.', 'Giazotto R.', 'Gibbons O.', 'Gibson M.',
    'Gibson R.', 'Gillock W.', 'Ginastera A.', 'Glanert D.', 'Glanville-Hicks P.', 'Glaser W.', 'Glass P.', 'Glazunov A.',
    'Gliere R.', 'Glinka M.', 'Glover D.', 'Gluck C.', 'Gnesina Y.', 'Godard B.', 'Goedicke A.', 'Goldston C.', 'Goldston M.',
    'Gossec F.', 'Gottschalk L.', 'Gould M.', 'Gounod C.', 'Grainger P.', 'Granados E.', 'Graupner C.', 'Greaves T.',
    'Grechaninov A.', 'Greenbaum (Ed).', 'Gregson', 'Grieg E.', 'Griesdale S.', 'Griffes C.', 'Griffiths D.', 'Gritton P.',
    'Gross E.', 'Grovlez G.', 'Gruber', 'Gruber J.', 'Gruber U.', 'Grutzmacher F.', 'Grybaitis G.', 'Gubaidulina S.',
    'Gurlitt C.', 'Haas', 'Haberbier E.', 'Haffner E.', 'Hair G.', 'Hakim N.', 'Hall P.', 'Hall/Drayton', 'Hamilton D.',
    'Hammond H.', 'Hancock H.', 'Hancock-Child R.', 'Handel A.', 'Handel G.', 'Hanna Barbera', 'Hannan E.', 'Hannan M.',
    'Hansen J.', 'Hanson H.', 'Harbison J.', 'Harley J.', 'Harline L.', 'Harmer D.', 'Harris G.', 'Harris P.', 'Harris R.',
    'Hart L. and Rogers R.', 'Hartsell', 'Harvey P.', 'Haslinger T.', 'Hassler J.', 'Haughton A.', 'Hawkins J.', 'Haydn J.',
    'Headington C.', 'Hedges A.', 'Hefti N.', 'Heller S.', 'Helps R.', 'Helyer M.', 'Henderson R.', 'Hengeveld G.',
    'Henley D. and Frey G.', 'Henley L.', 'Hensel F.', 'Henselt A.', 'Henze', 'Hetu J.', 'Heumann H.', 'Hicks-Ward K.',
    'Hiller J.', 'Hindemith P.', 'Hindson M.', 'Hiscocks W.', 'Ho V.', 'Hoddinott A.', 'Hoey D.', 'Hoffmann R.',
    'Hofmann H.', 'Hofmann J.', 'Hold T.', 'Holland D.', 'Holohan M.', 'Holst G.', 'Honegger A.', 'Hook J.', 'Hopkins A.',
    'Horner J.', 'Hough S.', 'Houlihan P.', 'Hounsome', 'Hovhaness A.', 'Hradecky E.', 'Huang A.', 'Humble K.', 'Hummel B.',
    'Hummel J.', 'Hunten F.', 'Hunter G.', 'Hurd M.', 'Hurley P.', 'Hutchens F.', 'Hyde M.', 'Ibert J.', 'Iles N.', 'Illinsky A.',
    'Ilynsky A.', 'Iordansky M.', 'Ireland J.', 'Isaacs M.', 'Ishchenko Y.', 'Ives C.', 'Jackson G.', 'Jadin', 'James H. and Ellington D.',
    'Janacek L.', 'Jaque R.', 'Jardanyi P.', 'Jarre M.', 'Jarrett K.', 'Jensen A.', 'Jenson A.', 'Jeroen S.', 'Jirovec', 'Joachim O.',
    'Jobim A.', 'Joel B.', 'John E.', 'Johnson', 'Johnston F.', 'Johnston P.', 'Jolivet A.', 'Jones Q. and Temperton R.',
    'Jones R.', 'Joplin S.', 'Jordansky', 'Jun Yu J.', 'Kabalevsky D.', 'Kadosa P.', 'Kalinnikov V.', 'Kaneda', 'Kapustin N.',
    'Karganov G.', 'Kasemets U.', 'Kaski', 'Kats-Chernin E.', 'Keane R.', 'Kellner J.C.', 'Kember J.', 'Kendell', 'Kenins T.',
    'Kennan K.', 'Kern F.', 'Kern J.', 'Kershaw R .', 'Keveren P.', 'Keyworth', 'Khachaturian A.', 'Kirchner L.', 'Kirchner T.',
    'Kirnberger J.', 'Kisbey-Hicks M.', 'Klein L.', 'Klose C', 'Klose C.', 'Kocsar M.', 'Kodaly Z.', 'Koechlin C.', 'Koehler L.',
    'Koehne G.', 'Koelling C.', 'Kohler C.', 'Kohler L.', 'Kolb B.', 'Kolling C.', 'Kolodub J.', 'Kondo J.', 'Koprowski P.',
    'Korganov', 'Kossenko V.', 'Kotchie J.', 'Kowalchyk G. and Lancaster E.', 'Kozeluch L.', 'Kraehenbuehl D.', 'Krausas V.',
    'Krebs J.', 'Krenek E.', 'Kress', 'Krieger J.', 'Krug', 'Kuhlau F.', 'Kuhnau J.', 'Kulesha G.', 'Kullak T.', 'Kunz', 'Kunz K.',
    'Kunz M.', 'Kutnowski M.', 'Kuzmenko L.', 'Kymlicka M.', 'Labunksi W.', 'Laburda J.', 'Ladd I.', 'Lambro P.', 'Lane', 'Lang C.',
    'Last J.', 'Latour', 'Lavallee C.', 'Le Couppey F.', 'Le Coz M.', 'Le Gallienne D.', 'Lebeda M.', 'Lecuona E.', 'Lecussant S.',
    'Leek S.', 'Lees H.', 'Lefeld J.', 'Legrand M.', 'Leiber/Stoller', 'Lemoine A.', 'Lemoine H.', 'Lennon J.', 'Lennon J. and McCartney P.',
    'Lesage J.', 'Lhotka-Kalinski', 'Li Yinghai', 'Lichner H.', 'Liebermann L.', 'Ligeti G.', 'Lilburn D.', 'Linn J.',
    'Liszt F.', 'Liu Z.', 'Livingston J. and Evans R.', 'Lloyd Webber A.', 'Loam A.', 'Lockhart', 'Loeillet J.', 'Loeschhorn A.',
    'Lohlein G.', 'Louie A.', 'Lully J.', 'Lutoslawski W.', 'Lyadov A.', 'Lyapunov S.', 'Lynch S.', 'Lynes', 'Lysenko',
    'Macardle F.', 'MacDowell E.', 'MacFarlane R.', 'MacGregor J.', 'Maddox R.', 'Madsen T.', 'Mageau M.', 'Maikapar S.',
    'Mancini F.', 'Manzano M.', 'Marasco M.', 'Marcello B.', 'Marianelli D.', 'Markow A.', 'Marlanelli D.', 'Martin F.',
    'Martin P.', 'Martinez M.', 'Martini G.', 'Martino D.', 'Martinu B.', 'Martirano S.', 'Massenet J.', 'Masser M.',
    'Mather B.', 'Mattheson', 'Matthews M.', 'Maxwell Davies P.', 'Mayer C.', 'Maykapar S.', 'Mays S.', 'Mcbroom A.',
    'McCabe', 'McCartney P.', 'McClure P.', 'McCombe C.', 'McDonald B.', 'McGuire', 'McIntyre D.', 'Mckern B.', 'McKinnon G.',
    'McLean E.', 'McLeod J.', 'McMillan', 'McNeill', 'Meale R.', 'Medtner N.', 'Melartin E.', 'Mendelssohn F.', 'Menotti G.',
    'Merath S.', 'Mercer J.', 'Merikanto', 'Merkel G.', 'Messiaen O.', 'Mier M.', 'Milhaud D.', 'Miller B.', 'Miller M.',
    'Miller-Stott R.', 'Milligan J.', 'Milne E.', 'Mitchell J.', 'Miyoshi A.', 'Mizzy V.', 'Mllhaud D.', 'Moeran', 'Mompou F.',
    'Mongomery', 'Monk T.', 'Monn', 'Moore', 'Morawetz O.', 'Morel F.', 'Morley T.', 'Morricone E.', 'Morton F.',
    'Moscheles I.', 'Moser J.', 'Moskowski M.', 'Moss E.', 'Mould W.', 'Mower', 'Moy', 'Mozart L.', 'Mozart W.',
    'Mozetich M.', 'Mrozinski M.', 'Muczynski R.', 'Muller A.', 'Murphy K.', 'Musorgsky M.', 'Mussorgsky M.',
    'Myers S. and Williams J.', 'Myslivecek', 'Nakada Y.', 'Nancarrow C.', 'Naudot', 'Nazareth E.', 'Neefe C.',
    'Nettheim D.', 'Neugasimov V.', 'Nevada', 'Nevin E.', 'Niamath L.', 'Nichelmann', 'Nicklaus M.', 'Nickol',
    'Nielsen C.', 'Niemann W.', 'Niverd R.', 'Nock M.', 'Nolck A.', 'Noona W. and Noona C.', 'Norman M.', 'North A.',
    'Norton C.', 'Nyman M.', 'Nystedt K.', 'Oesten T.', 'Offenbach J.', 'Ohana M.', 'Olson K.', 'Olson L.', 'Orff C.',
    'Oriol E.', 'Ornstein', 'Ouchterlony D.', 'O’Hearn A.', 'Pachelbel J.', 'Pachulski H.', 'Paderewski I.', 'Palmer W.',
    'Palmgren S.', 'Papineau-Couture J.', 'Papp L.', 'Paradis M.', 'Paradisi P.', 'Parish M. and Miller G.', 'Parker B.',
    'Parker K.', 'Parsons G.', 'Parsons M.', 'Part A.', 'Pascal C.', 'Paterson L.', 'Paul D.', 'Paulus S.', 'Paynter J.',
    'Pearce E.', 'Pearson J.', 'Peerson', 'Peeters F.', 'Pentland B.', 'Pepin C.', 'Pergolesi G.', 'Perle G.', 'Perry N.',
    'Persichetti V.', 'Pescetti G.', 'Peters E.', 'Peterson O.', 'Pezold C.', 'Piazzolla A.', 'Pieczonka A.', 'Pinto G.F.',
    'Pinto O.', 'Plakidis P.', 'Ple S.', 'Pleyel I.', 'Podgornov N.', 'Poe J.', 'Polden A.', 'Poldini E.', 'Pollard M.',
    'Ponce M.', 'Ponchielli A.', 'Poole C.', 'Poulenc F.', 'Pousseur H.', 'Powell K.', 'Pozzoli E.', 'Praetorius',
    'Previn A.', 'Price F.', 'Prokofiev S.', 'Proksch', 'Pruden L.', 'Psathas J.', 'Puccini G.', 'Purcell H.',
    'Pustilnik F.', 'Quilter R.', 'Rachmaninoff S.', 'Rae A.', 'Raff J.', 'Raichev A.', 'Rameau J.-P.', 'Rapoport A.',
    'Ravel M.', 'Rawsthorne A.', 'Rea', 'Readdy W.', 'Rebello J.', 'Rebikoff V.', 'Reeder H.', 'Reger M.', 'Reichardt J.',
    'Reinagle A.', 'Reinecke C.', 'Reinhold H.', 'Reizenstein F.', 'Rejino M.', 'Renfrow K.', 'Reubart D.',
    'Rimmer J.', 'Rimsky-Korsakov N.', 'Ritchie A.', 'Rochberg G.', 'Rocherolle E.', 'Rockefeller H.', 'Rodgers R.',
    'Rodrigo J.', 'Rohde E.', 'Roland B.', 'Rollin C.', 'Rorem N.', 'Rose M.', 'Rosetti A.', 'Rossi W.', 'Rossini G.',
    'Rowcroft J.', 'Rowley A.', 'Roxburgh', 'Rozin A.', 'Rozsa M.', 'Rubinstein A.', 'Ruders P.', 'Rudnytskyi A.',
    'Ruiz F.', 'Russell O.', 'Russell-Smith G.', 'Ryba J.', 'Rybicki F.', 'Rzewski F.', 'Saban H. and Levy S.',
    'Sabin N.', 'Saint-Saens C.', 'Salmon C.', 'Salter L.', 'Salter T.', 'Salutrinskaya T.', 'Sancan P.', 'Sandre G.',
    'Sands V.', 'Sarauer', 'Satie E.', 'Sawer D.', 'Scarlatti D.', 'Schafer R.', 'Schale', 'Scharwenka X.',
    'Schaum W.', 'Schawersaschwili T.', 'Schein', 'Scher', 'Schifrin L.', 'Schmidt H.', 'Schmitt J.', 'Schmitz M.',
    'Schmoll A.', 'Schnittke A.', 'Schoenberg A.', 'Schonberg C.', 'Schonmehl M.', 'Schubert F.', 'Schumann C.',
    'Schumann R.', 'Schwandt F. and Andre W.', 'Schwantner J.', 'Schwertberger G.', 'Schytte L.', 'Scott C.',
    'Scott R.', 'Scriabin A.', 'Sculthorpe P.', 'Sebba', 'Seiber M.', 'Seixas C. de', 'Sessions R.', 'Severac D. de',
    'Sharman E.', 'Sharman L.', 'Shchedrin R.', 'Shearing G.', 'Sheeles J.', 'Sheftel P.', 'Shostakovich D.',
    'Shu San C.', 'Sibelius J.', 'Siegmeister E.', 'Silvester F.', 'Silvestri A.', 'Simon P.', 'Sinding C.',
    'Sitsky L.', 'Skarecky J.', 'Slavicky', 'Smalley R.', 'Smetana B.', 'Smith G.', 'Smither M.', 'Snell K. and Hidy D.',
    'Sneyd A. &amp; Utting C.', 'Solal M.', 'Soler A.', 'Somers H.', 'Sondheim S.', 'Southam A.', 'Speak J.', 'Speirs J.',
    'Spindler F.', 'Stamaty C.', 'Stanford C.', 'Stapleton D.', 'Starer R.', 'Steibelt D.', 'Stenhammar', 'Stevens H.',
    'Stockhausen K.', 'Stolzel G.', 'Stone C.', 'Storace S.', 'Storer S.', 'Strauss J.', 'Strauss R.', 'Stravinsky I.',
    'Stravinsky S.', 'Strayhorn B.', 'Suk', 'Sullivan A.', 'Sutermeister', 'Sutherland M.', 'Swayne G.', 'Sweelinck J.',
    'Swinstead F.', 'Symons J.', 'Szelenyi I.', 'Szymanowska M.', 'Szymanowski K.', 'Tadman-Robins', 'Taggart',
    'Tajcevic M.', 'Takacs J.', 'Takemitsu T.', 'Tan C.', 'Tanaka K.', 'Tanner', 'Tansman A.', 'Taranta I.', 'Tarenghi M.',
    'Tarp S.', 'Tarrega F.', 'Tchaikovsky P.', 'Tcherepnin A.', 'Telemann G.', 'Telfer N.', 'Tenney J.', 'Terry J.',
    'Thiman', 'Thompson J.', 'Thomson V.', 'Thurgood G.', 'Ticciati', 'Tilanus R.', 'Tingley G.', 'Tippett M.',
    'Torjussen T.', 'Torres J.', 'Tower J.', 'Trad. American', 'Trad. Catalan', 'Trad. Chinese', 'Trad. English',
    'Trad. English', 'Trad. Latvian', 'Trad. Spanish', 'Traditional', 'Transman', 'Tremain R.', 'Trynes J.',
    'Tsitsaros C.', 'Turina J.', 'Turk D.', 'Turnage M.', 'Tyner M.', 'Utting C.', 'Vandall R.', 'Vangelis', 'Vanhal J.',
    'Vasks P.', 'Vaughan Williams R.', 'Verdi G.', 'Villa-Lobos H.', 'Vine C.', 'Vis E.', 'Vivaldi A.', 'Vivienne S.',
    'Vivier C.', 'Vogel J.', 'Volkmann R.', 'Von der Hofe', 'Vorisek J.', 'Wagenseil G.', 'Wagner R.', 'Waldteufel E.',
    'Walker', 'Walker T.', 'Wallen E.', 'Waller T.', 'Wang J.Z.', 'Warren H.', 'Warren H. and Dubin A.', 'Washburn R.',
    'Watts S.', 'Waxman D.', 'Webber A.', 'Weber B.', 'Weber C.', 'Webern A.', 'Webster P. &amp; Burke S.', 'Wedgwood P.',
    'Weiner L.', 'Weinzweig J.', 'Wells J.', 'Werder F.', 'Wesley S.', 'Wesley-Smith M.', 'Westlake N.', 'Whiffen L.',
    'Whitehead G.', 'Whiticker M.', 'Whitton J.', 'Wilby G.', 'Wilcher P.', 'Wilkinson G.', 'Willan H.', 'Williams C.',
    'Williams C. and Monk T.', 'Williams J.', 'Williams M.', 'Williams S.', 'Williamson M.', 'Wilson C.', 'Wilson R.',
    'Wilton', 'Windsperger', 'Wohlfahrt F.', 'Wolf', 'Wolfahrt F.', 'Wollenhaupt H.', 'Wolpe S.', 'Wood', 'Wooding K.',
    'Wright R. and Forrest G.', 'Wuensch G.', 'Wuorinen C.', 'Xenakis I.', 'Yeager J.', 'Yi C.', 'Yiruma', 'York',
    'Youmans V.', 'Young A.', 'Young K.', 'Yun I.', 'Yuyama', 'Zachau', 'Zhuravytsky V.', 'Zilcher', 'Ziliskis',
    'Zipoli D.', 'Zuckermann A.'];

foreach ($compositores as $compositor) {
    salvarPartiturasPorCompositor($compositor, $conn);
}
$conn->close();

/**
 * Consultar dados de pianosyllabus.com através de requisição HTTP.
 *
 * @param $compositor string
 * @param $grade string
 * @return bool|str_get_html
 */
function getByCompositorAndGrade($compositor, $grade)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'http://pianosyllabus.com/default.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "composer=$compositor&title=&kochel=&grade=$grade");
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Cache-Control: max-age=0';
    $headers[] = 'Origin: http://pianosyllabus.com';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36';
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
    $headers[] = 'Referer: http://pianosyllabus.com/default.php';
    $headers[] = 'Accept-Encoding: gzip, deflate';
    $headers[] = 'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7';
    $headers[] = 'Cookie: _ga=GA1.2.855860855.1573000268; _gid=GA1.2.409377102.1573000268';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $html = str_get_html($result);
    return $html;
}

/**
 * Persiste informações da música.
 *
 * @param $conn mysqli
 * @param $composer string
 * @param $title string
 * @param $id string
 * @param $grade string
 * @param $consenso string
 */
function salvar($conn, $composer, $title, $id, $grade, $consenso)
{
    $title = str_replace('"', "'", $title);

    $sql = $conn->prepare("INSERT INTO music(composer, title, id, grade, consenso)
VALUES(?,?,?,?,?);");
    $sql->bind_param("sssss", $composer, $title, $id, $grade, $consenso);

    if ($sql->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $sql->error;
        die();
    }
}

/**
 * Salva todas as músicas de um compositor.
 *
 * @param $compositor string
 * @param $conn mysqli
 */
function salvarPartiturasPorCompositor($compositor, $conn)
{
    for ($i = 0; $i <= 10; $i++) {
        $html = getByCompositorAndGrade($compositor, $i);

        $registros = $html->find('tr');
        array_shift($registros);
        foreach ($registros as $registro) {
            salvar($conn, $registro->children(0)->innertext, $registro->children(1)->innertext,
            $registro->children(2)->children(0)->innertext, $registro->children(3)->children(0)->innertext,
            $registro->children(4)->children(0)->innertext);
        }
    }
}
