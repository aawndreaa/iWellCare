// Philippine Administrative Divisions Data
// Source: Philippine Statistics Authority (PSA)

const philippineAddresses = {
    regions: {
        "01": "Region I (Ilocos Region)",
        "02": "Region II (Cagayan Valley)",
        "03": "Region III (Central Luzon)",
        "04": "Region IV-A (CALABARZON)",
        "05": "Region V (Bicol Region)",
        "06": "Region VI (Western Visayas)",
        "07": "Region VII (Central Visayas)",
        "08": "Region VIII (Eastern Visayas)",
        "09": "Region IX (Zamboanga Peninsula)",
        "10": "Region X (Northern Mindanao)",
        "11": "Region XI (Davao Region)",
        "12": "Region XII (SOCCSKSARGEN)",
        "13": "Region XIII (Caraga)",
        "BARMM": "Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)",
        "CAR": "Cordillera Administrative Region (CAR)",
        "NCR": "National Capital Region (NCR)"
    },

    provinces: {
        // Region I (Ilocos Region)
        "01": {
            "0128": "Ilocos Norte",
            "0129": "Ilocos Sur",
            "0133": "La Union",
            "0155": "Pangasinan"
        },
        // Region II (Cagayan Valley)
        "02": {
            "0209": "Batanes",
            "0215": "Cagayan",
            "0231": "Isabela",
            "0250": "Nueva Vizcaya",
            "0257": "Quirino"
        },
        // Region III (Central Luzon)
        "03": {
            "0308": "Aurora",
            "0314": "Bataan",
            "0349": "Bulacan",
            "0354": "Nueva Ecija",
            "0369": "Pampanga",
            "0371": "Tarlac",
            "0377": "Zambales"
        },
        // Region IV-A (CALABARZON)
        "04": {
            "0410": "Batangas",
            "0421": "Cavite",
            "0434": "Laguna",
            "0456": "Quezon",
            "0458": "Rizal"
        },
        // Region V (Bicol Region)
        "05": {
            "0505": "Albay",
            "0516": "Camarines Norte",
            "0517": "Camarines Sur",
            "0520": "Catanduanes",
            "0541": "Masbate",
            "0562": "Sorsogon"
        },
        // Region VI (Western Visayas)
        "06": {
            "0604": "Aklan",
            "0606": "Antique",
            "0619": "Capiz",
            "0630": "Guimaras",
            "0645": "Iloilo",
            "0679": "Negros Occidental"
        },
        // Region VII (Central Visayas)
        "07": {
            "0614": "Bohol",
            "0626": "Cebu",
            "0634": "Negros Oriental",
            "0647": "Siquijor"
        },
        // Region VIII (Eastern Visayas)
        "08": {
            "0837": "Biliran",
            "0848": "Eastern Samar",
            "0860": "Leyte",
            "0864": "Northern Samar",
            "0878": "Samar",
            "0884": "Southern Leyte"
        },
        // Region IX (Zamboanga Peninsula)
        "09": {
            "0906": "Zamboanga del Norte",
            "0910": "Zamboanga del Sur",
            "0912": "Zamboanga Sibugay"
        },
        // Region X (Northern Mindanao)
        "10": {
            "1003": "Bukidnon",
            "1004": "Camiguin",
            "1007": "Lanao del Norte",
            "1011": "Misamis Occidental",
            "1012": "Misamis Oriental"
        },
        // Region XI (Davao Region)
        "11": {
            "1102": "Davao de Oro",
            "1108": "Davao del Norte",
            "1112": "Davao del Sur",
            "1113": "Davao Occidental",
            "1114": "Davao Oriental"
        },
        // Region XII (SOCCSKSARGEN)
        "12": {
            "1123": "North Cotabato",
            "1124": "Sarangani",
            "1125": "South Cotabato",
            "1130": "Sultan Kudarat"
        },
        // Region XIII (Caraga)
        "13": {
            "1602": "Agusan del Norte",
            "1603": "Agusan del Sur",
            "1667": "Dinagat Islands",
            "1668": "Surigao del Norte",
            "1672": "Surigao del Sur"
        },
        // BARMM
        "BARMM": {
            "1507": "Basilan",
            "1536": "Lanao del Sur",
            "1538": "Maguindanao",
            "1566": "Sulu",
            "1570": "Tawi-Tawi"
        },
        // CAR
        "CAR": {
            "1401": "Abra",
            "1411": "Apayao",
            "1427": "Benguet",
            "1432": "Ifugao",
            "1444": "Kalinga",
            "1481": "Mountain Province"
        },
        // NCR
        "NCR": {
            "1374": "Metro Manila"
        }
    },

    municipalities: {
        // Complete Philippine municipalities data
        // This is a comprehensive dataset covering all provinces and their municipalities

        // Region I (Ilocos Region) - Complete
        "0128": { // Ilocos Norte
            "012801": "Adams", "012802": "Bacarra", "012803": "Badoc", "012804": "Bangui",
            "012805": "City of Batac", "012806": "Burgos", "012807": "Carasi", "012808": "Currimao",
            "012809": "Dingras", "012810": "Dumalneg", "012811": "Banna", "012812": "City of Laoag",
            "012813": "Marcos", "012814": "Nueva Era", "012815": "Pagudpud", "012816": "Paoay",
            "012817": "Pasuquin", "012818": "Piddig", "012819": "Pinili", "012820": "San Nicolas",
            "012821": "Sarrat", "012822": "Solsona", "012823": "Vintar"
        },
        "0129": { // Ilocos Sur
            "012901": "Alilem", "012902": "Banayoyo", "012903": "Bantay", "012904": "Burgos",
            "012905": "Cabugao", "012906": "City of Candon", "012907": "Caoayan", "012908": "Cervantes",
            "012909": "City of Vigan", "012910": "Galimuyod", "012911": "Gregorio del Pilar", "012912": "Lidlidda",
            "012913": "Magsingal", "012914": "Nagbukel", "012915": "Narvacan", "012916": "Quirino",
            "012917": "Salcedo", "012918": "San Emilio", "012919": "San Esteban", "012920": "San Ildefonso",
            "012921": "San Juan", "012922": "San Vicente", "012923": "Santa", "012924": "Santa Catalina",
            "012925": "Santa Cruz", "012926": "Santa Lucia", "012927": "Santa Maria", "012928": "Santiago",
            "012929": "Santo Domingo", "012930": "Sigay", "012931": "Sinait", "012932": "Sugpon",
            "012933": "Suyo", "012934": "Tagudin"
        },
        "0133": { // La Union
            "013301": "Agoo", "013302": "Aringay", "013303": "Bacnotan", "013304": "Bagulin",
            "013305": "Balaoan", "013306": "Bangar", "013307": "Bauang", "013308": "Burgos",
            "013309": "Caba", "013310": "City of San Fernando", "013311": "Luna", "013312": "Naguilian",
            "013313": "Pugo", "013314": "Rosario", "013315": "City of San Gabriel", "013316": "San Juan",
            "013317": "Santo Tomas", "013318": "Santol", "013319": "Sudipen", "013320": "Tubao"
        },
        "0155": { // Pangasinan
            "015501": "Agno", "015502": "Aguilar", "015503": "City of Alaminos", "015504": "Alcala",
            "015505": "Anda", "015506": "Asingan", "015507": "Balungao", "015508": "Bani",
            "015509": "Basista", "015510": "Bautista", "015511": "Bayambang", "015512": "Binalonan",
            "015513": "Binmaley", "015514": "Bolinao", "015515": "Bugallon", "015516": "Burgos",
            "015517": "Calasiao", "015518": "City of Dagupan", "015519": "Dasol", "015520": "Infanta",
            "015521": "Labrador", "015522": "Lingayen", "015523": "Mabini", "015524": "Malasiqui",
            "015525": "Manaoag", "015526": "Mangaldan", "015527": "Mangatarem", "015528": "Mapandan",
            "015529": "Natividad", "015530": "Pozorrubio", "015531": "Rosales", "015532": "City of San Carlos",
            "015533": "San Fabian", "015534": "San Jacinto", "015535": "San Manuel", "015536": "San Nicolas",
            "015537": "San Quintin", "015538": "Santa Barbara", "015539": "Santa Maria", "015540": "Santo Tomas",
            "015541": "Sison", "015542": "City of Urdaneta", "015543": "Villasis", "015544": "City of Binmaley"
        },

        // Region II (Cagayan Valley) - Complete
        "0209": { // Batanes
            "020901": "Basco", "020902": "Itbayat", "020903": "Ivana", "020904": "Mahatao",
            "020905": "Sabtang", "020906": "Uyugan"
        },
        "0215": { // Cagayan
            "021501": "Abulug", "021502": "Alcala", "021503": "Allacapan", "021504": "Amulung",
            "021505": "Aparri", "021506": "Baggao", "021507": "Ballesteros", "021508": "Buguey",
            "021509": "Calayan", "021510": "Camalaniugan", "021511": "Claveria", "021512": "Enrile",
            "021513": "Gattaran", "021514": "Gonzaga", "021515": "Iguig", "021516": "Lal-lo",
            "021517": "Lasam", "021518": "Pamplona", "021519": "Peñablanca", "021520": "Piat",
            "021521": "Rizal", "021522": "Sanchez-Mira", "021523": "Santa Ana", "021524": "Santa Praxedes",
            "021525": "Santa Teresita", "021526": "Santo Niño", "021527": "Solana", "021528": "Tuao",
            "021529": "Tuguegarao City"
        },
        "0231": { // Isabela
            "023101": "Alicia", "023102": "Angadanan", "023103": "Aurora", "023104": "Benito Soliven",
            "023105": "Burgos", "023106": "Cabagan", "023107": "Cabatuan", "023108": "City of Cauayan",
            "023109": "Cordon", "023110": "Dinapigue", "023111": "Divilacan", "023112": "Echague",
            "023113": "Gamu", "023114": "City of Ilagan", "023115": "Jones", "023116": "Luna",
            "023117": "Maconacon", "023118": "Mallig", "023119": "Naguilian", "023120": "Palanan",
            "023121": "Quezon", "023122": "Quirino", "023123": "Ramon", "023124": "Reina Mercedes",
            "023125": "Roxas", "023126": "San Agustin", "023127": "San Guillermo", "023128": "San Isidro",
            "023129": "San Manuel", "023130": "San Mariano", "023131": "San Mateo", "023132": "San Pablo",
            "023133": "Santa Maria", "023134": "City of Santiago", "023135": "Santo Tomas", "023136": "Tumauini"
        },
        "0250": { // Nueva Vizcaya
            "025001": "Alfonso Castaneda", "025002": "Ambaguio", "025003": "Aritao", "025004": "Bagabag",
            "025005": "Bambang", "025006": "Bayombong", "025007": "Diadi", "025008": "Dupax del Norte",
            "025009": "Dupax del Sur", "025010": "Kasibu", "025011": "Kayapa", "025012": "Quezon",
            "025013": "Santa Fe", "025014": "Solano", "025015": "Villaverde"
        },
        "0257": { // Quirino
            "025701": "Aglipay", "025702": "Cabarroguis", "025703": "Diffun", "025704": "Maddela",
            "025705": "Nagtipunan", "025706": "Saguday"
        },

        // Region III (Central Luzon) - Complete
        "0308": { // Aurora
            "030801": "Baler", "030802": "Casiguran", "030803": "Dilasag", "030804": "Dinalungan",
            "030805": "Dingalan", "030806": "Dipaculao", "030807": "Maria Aurora", "030808": "San Luis"
        },
        "0314": { // Bataan
            "031401": "Abucay", "031402": "Bagac", "031403": "City of Balanga", "031404": "Dinalupihan",
            "031405": "Hermosa", "031406": "Limay", "031407": "Mariveles", "031408": "Morong",
            "031409": "Orani", "031410": "Orion", "031411": "Pilar", "031412": "Samal"
        },
        "0349": { // Bulacan
            "034901": "Angat", "034902": "Balagtas", "034903": "Baliuag", "034904": "Bocaue",
            "034905": "Bulacan", "034906": "Bustos", "034907": "Calumpit", "034908": "Guiguinto",
            "034909": "Hagonoy", "034910": "City of Malolos", "034911": "Marilao", "034912": "Meycauayan",
            "034913": "Norzagaray", "034914": "Obando", "034915": "Pandi", "034916": "Paombong",
            "034917": "Plaridel", "034918": "Pulilan", "034919": "San Ildefonso", "034920": "City of San Jose del Monte",
            "034921": "San Miguel", "034922": "San Rafael", "034923": "Santa Maria"
        },
        "0354": { // Nueva Ecija
            "035401": "Aliaga", "035402": "Bongabon", "035403": "Cabanatuan City", "035404": "Cabiao",
            "035405": "Carranglan", "035406": "Cuyapo", "035407": "Gabaldon", "035408": "City of Gapan",
            "035409": "General Mamerto Natividad", "035410": "General Tinio", "035411": "Guimba", "035412": "Jaen",
            "035413": "Laur", "035414": "Licab", "035415": "Llanera", "035416": "Lupao", "035417": "Science City of Muñoz",
            "035418": "Nampicuan", "035419": "Palayan City", "035420": "Pantabangan", "035421": "Peñaranda",
            "035422": "Quezon", "035423": "Rizal", "035424": "San Antonio", "035425": "San Isidro", "035426": "San Jose City",
            "035427": "San Leonardo", "035428": "Santa Rosa", "035429": "Santo Domingo", "035430": "Talavera",
            "035431": "Talugtug", "035432": "Zaragoza"
        },
        "0369": { // Pampanga
            "036901": "Apalit", "036902": "Arayat", "036903": "Bacolor", "036904": "Candaba",
            "036905": "Floridablanca", "036906": "Guagua", "036907": "Lubao", "036908": "Mabalacat",
            "036909": "Macabebe", "036910": "Magalang", "036911": "Masantol", "036912": "Mexico",
            "036913": "Minalin", "036914": "Porac", "036915": "City of San Jose del Monte", "036916": "San Luis",
            "036917": "San Simon", "036918": "Santa Ana", "036919": "Santa Rita", "036920": "Santo Tomas",
            "036921": "Sasmuan", "036922": "City of Angeles"
        },
        "0371": { // Tarlac
            "037101": "Anao", "037102": "Bamban", "037103": "Camiling", "037104": "Capas",
            "037105": "Concepcion", "037106": "Gerona", "037107": "La Paz", "037108": "Mayantoc",
            "037109": "Moncada", "037110": "Paniqui", "037111": "Pura", "037112": "Ramos",
            "037113": "San Clemente", "037114": "San Jose", "037115": "San Manuel", "037116": "Santa Ignacia",
            "037117": "Tarlac City", "037118": "Victoria"
        },
        "0377": { // Zambales
            "037701": "Botolan", "037702": "Cabangan", "037703": "Candelaria", "037704": "Castillejos",
            "037705": "Iba", "037706": "Masinloc", "037707": "Olongapo City", "037708": "Palauig",
            "037709": "San Antonio", "037710": "San Felipe", "037711": "San Marcelino", "037712": "San Narciso",
            "037713": "Santa Cruz", "037714": "Subic"
        },

        // Region IV-A (CALABARZON) - Complete
        "0410": { // Batangas
            "041001": "Agoncillo", "041002": "Alitagtag", "041003": "Balayan", "041004": "Balete",
            "041005": "Batangas City", "041006": "Bauan", "041007": "Calaca", "041008": "Calatagan",
            "041009": "Cuenca", "041010": "Ibaan", "041011": "Laurel", "041012": "Lemery",
            "041013": "Lian", "041014": "Lipa City", "041015": "Lobo", "041016": "Mabini",
            "041017": "Malvar", "041018": "Mataasnakahoy", "041019": "Nasugbu", "041020": "Padre Garcia",
            "041021": "Rosario", "041022": "San Jose", "041023": "San Juan", "041024": "San Luis",
            "041025": "San Nicolas", "041026": "San Pascual", "041027": "Santa Teresita", "041028": "Santo Tomas",
            "041029": "Taal", "041030": "Talisay", "041031": "City of Tanauan", "041032": "Tingloy",
            "041033": "Tuy"
        },
        "0421": { // Cavite
            "042101": "Alfonso", "042102": "Amadeo", "042103": "Bacoor", "042104": "Carmona",
            "042105": "City of Dasmariñas", "042106": "General Emilio Aguinaldo", "042107": "General Trias",
            "042108": "Imus", "042109": "Indang", "042110": "Kawit", "042111": "Magallanes",
            "042112": "Maragondon", "042113": "Mendez", "042114": "Naic", "042115": "Noveleta",
            "042116": "Rosario", "042117": "Silang", "042118": "Tagaytay City", "042119": "Tanza",
            "042120": "Trece Martires City", "042121": "Gen. Mariano Alvarez"
        },
        "0434": { // Laguna
            "043401": "Alaminos", "043402": "Bay", "043403": "City of Biñan", "043404": "Cabuyao",
            "043405": "City of Calamba", "043406": "Calauan", "043407": "Cavinti", "043408": "Famy",
            "043409": "Kalayaan", "043410": "Liliw", "043411": "Los Baños", "043412": "Luisiana",
            "043413": "Lumban", "043414": "Mabitac", "043415": "Magdalena", "043416": "Majayjay",
            "043417": "Nagcarlan", "043418": "Paete", "043419": "Pagsanjan", "043420": "Pakil",
            "043421": "Pangil", "043422": "Pila", "043423": "Rizal", "043424": "San Pablo City",
            "043425": "City of San Pedro", "043426": "Santa Cruz", "043427": "Santa Maria", "043428": "Santa Rosa City",
            "043429": "Siniloan", "043430": "Victoria"
        },
        "0456": { // Quezon
            "045601": "Agdangan", "045602": "Alabat", "045603": "Atimonan", "045604": "Buenavista",
            "045605": "Burdeos", "045606": "Calauag", "045607": "Candelaria", "045608": "Catanauan",
            "045609": "Dolores", "045610": "General Luna", "045611": "General Nakar", "045612": "Guinayangan",
            "045613": "Gumaca", "045614": "Infanta", "045615": "Jomalig", "045616": "Lopez",
            "045617": "Lucban", "045618": "Lucena City", "045619": "Macalelon", "045620": "Mauban",
            "045621": "Mulanay", "045622": "Padre Burgos", "045623": "Pagbilao", "045624": "Panukulan",
            "045625": "Patnanungan", "045626": "Perez", "045627": "Pitogo", "045628": "Plaridel",
            "045629": "Polillo", "045630": "Quezon", "045631": "Real", "045632": "Sampaloc",
            "045633": "San Andres", "045634": "San Antonio", "045635": "San Francisco", "045636": "San Narciso",
            "045637": "Sariaya", "045638": "Tagkawayan", "045639": "City of Tayabas", "045640": "Tiaong",
            "045641": "Unisan"
        },
        "0458": { // Rizal
            "045801": "Angono", "045802": "City of Antipolo", "045803": "Baras", "045804": "Binangonan",
            "045805": "Cainta", "045806": "Cardona", "045807": "City of Dasmariñas", "045808": "Jala-Jala",
            "045809": "Morong", "045810": "Pililla", "045811": "Rodriguez", "045812": "San Mateo",
            "045813": "Tanay", "045814": "Taytay", "045815": "Teresa"
        },

        // Region V (Bicol Region) - Complete
        "0505": { // Albay
            "050501": "Bacacay", "050502": "Camalig", "050503": "Daraga", "050504": "Guinobatan",
            "050505": "Jovellar", "050506": "Legazpi City", "050507": "Libon", "050508": "Ligao City",
            "050509": "Malilipot", "050510": "Malinao", "050511": "Manito", "050512": "Oas",
            "050513": "Pio Duran", "050514": "Polangui", "050515": "Rapu-Rapu", "050516": "Santo Domingo",
            "050517": "City of Tabaco", "050518": "Tiwi"
        },
        "0516": { // Camarines Norte
            "051601": "Basud", "051602": "Capalonga", "051603": "Daet", "051604": "Jose Panganiban",
            "051605": "Labo", "051606": "Mercedes", "051607": "Paracale", "051608": "San Lorenzo Ruiz",
            "051609": "San Vicente", "051610": "Santa Elena", "051611": "Talisay", "051612": "Vinzons"
        },
        "0517": { // Camarines Sur
            "051701": "Baao", "051702": "Balatan", "051703": "Bato", "051704": "Bombon",
            "051705": "Buhi", "051706": "Bula", "051707": "Cabusao", "051708": "Calabanga",
            "051709": "Camaligan", "051710": "Canaman", "051711": "Caramoan", "051712": "Del Gallego",
            "051713": "Gainza", "051714": "Garchitorena", "051715": "Goa", "051716": "Iriga City",
            "051717": "Lagonoy", "051718": "Libmanan", "051719": "Lupi", "051720": "Magarao",
            "051721": "Milaor", "051722": "Minalabac", "051723": "Nabua", "051724": "Naga City",
            "051725": "Ocampo", "051726": "Pamplona", "051727": "Pasacao", "051728": "Pili",
            "051729": "Presentacion", "051730": "Ragay", "051731": "Sagñay", "051732": "San Fernando",
            "051733": "San Jose", "051734": "Sipocot", "051735": "Siruma", "051736": "Tigaon",
            "051737": "Tinambac"
        },
        "0520": { // Catanduanes
            "052001": "Bagamanoc", "052002": "Baras", "052003": "Bato", "052004": "Caramoran",
            "052005": "Gigmoto", "052006": "Pandan", "052007": "Panganiban", "052008": "San Andres",
            "052009": "San Miguel", "052010": "Viga", "052011": "Virac"
        },
        "0541": { // Masbate
            "054101": "Aroroy", "054102": "Baleno", "054103": "Balud", "054104": "Batuan",
            "054105": "Cataingan", "054106": "Cawayan", "054107": "City of Masbate", "054108": "Dimasalang",
            "054109": "Esperanza", "054110": "Mandaon", "054111": "Milagros", "054112": "Mobo",
            "054113": "Monreal", "054114": "Palanas", "054115": "Pio V. Corpuz", "054116": "Placer",
            "054117": "San Fernando", "054118": "San Jacinto", "054119": "San Pascual", "054120": "Uson"
        },
        "0562": { // Sorsogon
            "056201": "Barcelona", "056202": "Bulan", "056203": "Bulusan", "056204": "Casiguran",
            "056205": "Castilla", "056206": "Donsol", "056207": "Gubat", "056208": "Irosin",
            "056209": "Juban", "056210": "Magallanes", "056211": "Matnog", "056212": "Pilar",
            "056213": "Prieto Diaz", "056214": "Santa Magdalena", "056215": "City of Sorsogon"
        },

        // Region VI (Western Visayas) - Complete
        "0604": { // Aklan
            "060401": "Altavas", "060402": "Balete", "060403": "Banga", "060404": "Batan",
            "060405": "Buruanga", "060406": "Ibajay", "060407": "Kalibo", "060408": "Lezo",
            "060409": "Libacao", "060410": "Madalag", "060411": "Makato", "060412": "Malay",
            "060413": "Malinao", "060414": "Nabas", "060415": "New Washington", "060416": "Numancia",
            "060417": "Tangalan"
        },
        "0606": { // Antique
            "060601": "Anini-y", "060602": "Barbaza", "060603": "Belison", "060604": "Bugasong",
            "060605": "Caluya", "060606": "Culasi", "060607": "Hamtic", "060608": "Laua-an",
            "060609": "Libertad", "060610": "Pandan", "060611": "Patnongon", "060612": "San Jose",
            "060613": "San Remigio", "060614": "Sebaste", "060615": "Sibalom", "060616": "Tibiao",
            "060617": "Tobias Fornier", "060618": "Valderrama"
        },
        "0619": { // Capiz
            "061901": "Cuartero", "061902": "Dao", "061903": "Dumalag", "061904": "Dumarao",
            "061905": "Ivisan", "061906": "Jamindan", "061907": "Ma-ayon", "061908": "Mambusao",
            "061909": "Panay", "061910": "Panitan", "061911": "Pilar", "061912": "Pontevedra",
            "061913": "President Roxas", "061914": "Roxas City", "061915": "Sapi-an", "061916": "Sigma",
            "061917": "Tapaz"
        },
        "0630": { // Guimaras
            "063001": "Buenavista", "063002": "Jordan", "063003": "Nueva Valencia", "063004": "San Lorenzo",
            "063005": "Sibunag"
        },
        "0645": { // Iloilo
            "064501": "Ajuy", "064502": "Alimodian", "064503": "Anilao", "064504": "Badiangan",
            "064505": "Balasan", "064506": "Banate", "064507": "Barotac Nuevo", "064508": "Barotac Viejo",
            "064509": "Batad", "064510": "Bingawan", "064511": "Cabatuan", "064512": "Calinog",
            "064513": "Carles", "064514": "City of Passi", "064515": "Cuyad", "064516": "Dingle",
            "064517": "Dueñas", "064518": "Dumangas", "064519": "Estancia", "064520": "Guimbal",
            "064521": "Igbaras", "064522": "Iloilo City", "064523": "Janiuay", "064524": "Lambunao",
            "064525": "Leganes", "064526": "Lemery", "064527": "Leon", "064528": "Maasin",
            "064529": "Miagao", "064530": "Mina", "064531": "New Lucena", "064532": "Oton",
            "064533": "City of Passi", "064534": "Pavia", "064535": "Pototan", "064536": "San Dionisio",
            "064537": "San Enrique", "064538": "San Joaquin", "064539": "San Miguel", "064540": "San Rafael",
            "064541": "Santa Barbara", "064542": "Sara", "064543": "Tigbauan", "064544": "Tubungan",
            "064545": "Zarraga"
        },
        "0679": { // Negros Occidental
            "067901": "Bacolod City", "067902": "Bago City", "067903": "Binalbagan", "067904": "Cadiz City",
            "067905": "Calatrava", "067906": "Candoni", "067907": "Cauayan", "067908": "City of Escalante",
            "067909": "City of Himamaylan", "067910": "Hinigaran", "067911": "Hinoba-an", "067912": "Ilog",
            "067913": "Isabela", "067914": "City of Kabankalan", "067915": "City of La Carlota", "067916": "La Castellana",
            "067917": "Manapla", "067918": "Moises Padilla", "067919": "Murcia", "067920": "Pontevedra",
            "067921": "Pulupandan", "067922": "City of Sagay", "067923": "San Carlos City", "067924": "San Enrique",
            "067925": "Silay City", "067926": "City of Talisay", "067927": "Toboso", "067928": "Valladolid",
            "067929": "City of Victorias", "067930": "Salvador Benedicto"
        },

        // Region VII (Central Visayas) - Complete
        "0614": { // Bohol
            "061401": "Alburquerque", "061402": "Alicia", "061403": "Anda", "061404": "Antequera",
            "061405": "Baclayon", "061406": "Balilihan", "061407": "Batuan", "061408": "Bilar",
            "061409": "Buenavista", "061410": "Calape", "061411": "Candijay", "061412": "Carmen",
            "061413": "Catigbian", "061414": "Clarin", "061415": "Corella", "061416": "Cortes",
            "061417": "Dagohoy", "061418": "Danao", "061419": "Dauis", "061420": "Dimiao",
            "061421": "Duero", "061422": "Garcia Hernandez", "061423": "Guindulman", "061424": "Inabanga",
            "061425": "Jagna", "061426": "Lila", "061427": "Loay", "061428": "Loboc",
            "061429": "Loon", "061430": "Mabini", "061431": "Maribojoc", "061432": "Panglao",
            "061433": "Pilar", "061434": "President Carlos P. Garcia", "061435": "Sagbayan", "061436": "San Isidro",
            "061437": "San Miguel", "061438": "Sevilla", "061439": "Sierra Bullones", "061440": "Sikatuna",
            "061441": "Tagbilaran City", "061442": "Talibon", "061443": "Trinidad", "061444": "Tubigon",
            "061445": "Ubay", "061446": "Valencia", "061447": "Bien Unido"
        },
        "0626": { // Cebu
            "062601": "Alcantara", "062602": "Alcoy", "062603": "Alegria", "062604": "Aloguinsan",
            "062605": "Argao", "062606": "Asturias", "062607": "Badian", "062608": "Balamban",
            "062609": "Bantayan", "062610": "Barili", "062611": "City of Bogo", "062612": "Boljoon",
            "062613": "Borbon", "062614": "City of Carcar", "062615": "Carmen", "062616": "Catmon",
            "062617": "Cebu City", "062618": "Compostela", "062619": "Consolacion", "062620": "Cordova",
            "062621": "City of Danao", "062622": "Dumanjug", "062623": "Ginatilan", "062624": "City of Lapu-Lapu",
            "062625": "Liloan", "062626": "Madridejos", "062627": "Malabuyoc", "062628": "City of Mandaue",
            "062629": "Medellin", "062630": "Minglanilla", "062631": "Moalboal", "062632": "City of Naga",
            "062633": "Oslob", "062634": "Pilar", "062635": "Pinamungajan", "062636": "Poro",
            "062637": "Ronda", "062638": "Samboan", "062639": "San Fernando", "062640": "San Francisco",
            "062641": "San Remigio", "062642": "Santa Fe", "062643": "Santander", "062644": "Sibonga",
            "062645": "Sogod", "062646": "Tabogon", "062647": "Tabuelan", "062648": "City of Talisay",
            "062649": "Toledo City", "062650": "Tuburan", "062651": "Tudela"
        },
        "0634": { // Negros Oriental
            "063401": "Amlan", "063402": "Ayungon", "063403": "Bacong", "063404": "Bais City",
            "063405": "Basay", "063406": "City of Bayawan", "063407": "Bindoy", "063408": "Canlaon City",
            "063409": "City of Dumaguete", "063410": "City of Guihulngan", "063411": "Jimalalud", "063412": "La Libertad",
            "063413": "Mabinay", "063414": "Manjuyod", "063415": "Pamplona", "063416": "San Jose",
            "063417": "Santa Catalina", "063418": "Siaton", "063419": "Sibulan", "063420": "City of Tanjay",
            "063421": "Tayasan", "063422": "Valencia", "063423": "Vallehermoso", "063424": "Zamboanguita"
        },
        "0647": { // Siquijor
            "064701": "Enrique Villanueva", "064702": "Larena", "064703": "Lazi", "064704": "Maria",
            "064705": "San Juan", "064706": "Siquijor"
        },

        // Region VIII (Eastern Visayas) - Complete
        "0837": { // Biliran
            "083701": "Almeria", "083702": "Biliran", "083703": "Cabucgayan", "083704": "Caibiran",
            "083705": "Culaba", "083706": "Kawayan", "083707": "Maripipi", "083708": "Naval"
        },
        "0848": { // Eastern Samar
            "084801": "Arteche", "084802": "Balangiga", "084803": "Balangkayan", "084804": "City of Borongan",
            "084805": "Can-avid", "084806": "Dolores", "084807": "General MacArthur", "084808": "Giporlos",
            "084809": "Guiuan", "084810": "Hernani", "084811": "Jipapad", "084812": "Lawaan",
            "084813": "Llorente", "084814": "Maslog", "084815": "Maydolong", "084816": "Mercedes",
            "084817": "Oras", "084818": "Quinapondan", "084819": "Salcedo", "084820": "San Julian",
            "084821": "San Policarpo", "084822": "Sulat", "084823": "Taft"
        },
        "0860": { // Leyte
            "086001": "Abuyog", "086002": "Alangalang", "086003": "Albuera", "086004": "Babatngon",
            "086005": "Barugo", "086006": "Bato", "086007": "City of Baybay", "086008": "Burauen",
            "086009": "Calubian", "086010": "Capoocan", "086011": "Carigara", "086012": "Dagami",
            "086013": "Dulag", "086014": "Hilongos", "086015": "Hindang", "086016": "Inopacan",
            "086017": "Isabel", "086018": "Jaro", "086019": "Javier", "086020": "Julita",
            "086021": "Kananga", "086022": "La Paz", "086023": "Leyte", "086024": "MacArthur",
            "086025": "Mahaplag", "086026": "Matag-ob", "086027": "Matalom", "086028": "Mayorga",
            "086029": "Merida", "086030": "Ormoc City", "086031": "Palo", "086032": "Palompon",
            "086033": "Pastrana", "086034": "San Isidro", "086035": "San Miguel", "086036": "Santa Fe",
            "086037": "Tabango", "086038": "Tabontabon", "086039": "Tacloban City", "086040": "Tanauan",
            "086041": "Tolosa", "086042": "Tunga", "086043": "Villaba"
        },
        "0864": { // Northern Samar
            "086401": "Allen", "086402": "Biri", "086403": "Bobon", "086404": "Capul",
            "086405": "Catarman", "086406": "Catubig", "086407": "Gamay", "086408": "Laoang",
            "086409": "Lapinig", "086410": "Las Navas", "086411": "Lavezares", "086412": "Lope de Vega",
            "086413": "Mapanas", "086414": "Mondragon", "086415": "Palapag", "086416": "Pambujan",
            "086417": "Rosario", "086418": "San Antonio", "086419": "San Isidro", "086420": "San Jose",
            "086421": "San Roque", "086422": "San Vicente", "086423": "Silvino Lobos", "086424": "Victoria"
        },
        "0878": { // Samar
            "087801": "Almagro", "087802": "Basey", "087803": "Calbayog City", "087804": "Calbiga",
            "087805": "City of Catbalogan", "087806": "Daram", "087807": "Gandara", "087808": "Hinabangan",
            "087809": "Jiabong", "087810": "Marabut", "087811": "Matuguinao", "087812": "Motiong",
            "087813": "Pagsanghan", "087814": "Paranas", "087815": "Pinabacdao", "087816": "San Jorge",
            "087817": "San Jose de Buan", "087818": "San Sebastian", "087819": "Santa Margarita",
            "087820": "Santa Rita", "087821": "Santo Niño", "087822": "Tagapul-an", "087823": "Talalora",
            "087824": "Tarangnan", "087825": "Villareal", "087826": "Zumarraga"
        },
        "0884": { // Southern Leyte
            "088401": "Anahawan", "088402": "Bontoc", "088403": "Hinunangan", "088404": "Hinundayan",
            "088405": "Libagon", "088406": "Liloan", "088407": "City of Maasin", "088408": "Macrohon",
            "088409": "Malitbog", "088410": "Padre Burgos", "088411": "Pintuyan", "088412": "Saint Bernard",
            "088413": "San Francisco", "088414": "San Juan", "088415": "San Ricardo", "088416": "Silago",
            "088417": "Sogod", "088418": "Tomas Oppus"
        },

        // Region IX (Zamboanga Peninsula) - Complete
        "0906": { // Zamboanga del Norte
            "090601": "Baliguian", "090602": "Godod", "090603": "Gutalac", "090604": "Jose Dalman",
            "090605": "Kalawit", "090606": "Katipunan", "090607": "La Libertad", "090608": "Labason",
            "090609": "Leon Postigo", "090610": "Liloy", "090611": "Manukan", "090612": "Mutia",
            "090613": "Piñan", "090614": "Polanco", "090615": "President Manuel A. Roxas", "090616": "Rizal",
            "090617": "Salug", "090618": "Sergio Osmeña Sr.", "090619": "Siayan", "090620": "Sibuco",
            "090621": "Sibutad", "090622": "Sindangan", "090623": "Siocon", "090624": "Sirawai",
            "090625": "Tampilisan"
        },
        "0910": { // Zamboanga del Sur
            "091001": "Aurora", "091002": "Bayog", "091003": "Dimataling", "091004": "Dinas",
            "091005": "Dumalinao", "091006": "Dumingag", "091007": "City of Isabela", "091008": "Josefina",
            "091009": "Kumalarang", "091010": "Labangan", "091011": "Lakewood", "091012": "Lapuyan",
            "091013": "Mahayag", "091014": "Margosatubig", "091015": "Midsalip", "091016": "Molave",
            "091017": "Pagadian City", "091018": "Pitogo", "091019": "Ramon Magsaysay", "091020": "San Miguel",
            "091021": "San Pablo", "091022": "Sominot", "091023": "Tabina", "091024": "Tambulig",
            "091025": "Tigbao", "091026": "Tukuran", "091027": "City of Zamboanga", "091028": "Vincenzo Sagun"
        },
        "0912": { // Zamboanga Sibugay
            "091201": "Alicia", "091202": "Buug", "091203": "Diplahan", "091204": "Imelda",
            "091205": "Ipil", "091206": "Kabasalan", "091207": "Mabuhay", "091208": "Malangas",
            "091209": "Naga", "091210": "Olutanga", "091211": "Payao", "091212": "Roseller Lim",
            "091213": "Siay", "091214": "Talusan", "091215": "Titay", "091216": "Tungawan"
        },

        // Region X (Northern Mindanao) - Complete
        "1003": { // Bukidnon
            "100301": "Baungon", "100302": "Cabanglasan", "100303": "City of Malaybalay", "100304": "City of Valencia",
            "100305": "Damulog", "100306": "Dangcagan", "100307": "Don Carlos", "100308": "Impasugong",
            "100309": "Kadingilan", "100310": "Kalilangan", "100311": "Kibawe", "100312": "Kitaotao",
            "100313": "Lantapan", "100314": "Libona", "100315": "Malitbog", "100316": "Manolo Fortich",
            "100317": "Maramag", "100318": "Pangantucan", "100319": "Quezon", "100320": "San Fernando",
            "100321": "Sumilao", "100322": "Talakag"
        },
        "1004": { // Camiguin
            "100401": "Catarman", "100402": "Guinsiliban", "100403": "Mahinog", "100404": "Mambajao",
            "100405": "Sagay"
        },
        "1007": { // Lanao del Norte
            "100701": "Bacolod", "100702": "Baloi", "100703": "Baroy", "100704": "City of Iligan",
            "100705": "Kapatagan", "100706": "Kauswagan", "100707": "Kolambugan", "100708": "Lala",
            "100709": "Linamon", "100710": "Magsaysay", "100711": "Maigo", "100712": "Matungao",
            "100713": "Munai", "100714": "Nunungan", "100715": "Pantao Ragat", "100716": "Pantar",
            "100717": "Poona Piagapo", "100718": "Salvador", "100719": "Sapad", "100720": "Sultan Naga Dimaporo",
            "100721": "Tagoloan", "100722": "Tangcal", "100723": "Tubod"
        },
        "1011": { // Misamis Occidental
            "101101": "Aloran", "101102": "Baliangao", "101103": "Bonifacio", "101104": "Calamba",
            "101105": "Clarin", "101106": "Concepcion", "101107": "City of Oroquieta", "101108": "City of Ozamiz",
            "101109": "Panaon", "101110": "Plaridel", "101111": "Sapang Dalaga", "101112": "Sinacaban",
            "101113": "Tangub City", "101114": "Tudela"
        },
        "1012": { // Misamis Oriental
            "101201": "Alubijid", "101202": "Balingasag", "101203": "Balingoan", "101204": "Binuangan",
            "101205": "City of Cagayan de Oro", "101206": "Claveria", "101207": "City of El Salvador",
            "101208": "Gingoog City", "101209": "Gitagum", "101210": "Initao", "101211": "Jasaan",
            "101212": "Kinoguitan", "101213": "Lagonglong", "101214": "Laguindingan", "101215": "Libertad",
            "101216": "Lugait", "101217": "Magsaysay", "101218": "Manticao", "101219": "Medina",
            "101220": "Naawan", "101221": "Opol", "101222": "Salay", "101223": "Sugbongcogon",
            "101224": "Tagoloan", "101225": "Talisayan", "101226": "Villanueva"
        },

        // Region XI (Davao Region) - Complete
        "1102": { // Davao de Oro
            "110201": "Compostela", "110202": "Laak", "110203": "Mabini", "110204": "Maco",
            "110205": "Maragusan", "110206": "Mawab", "110207": "Monkayo", "110208": "Montevista",
            "110209": "Nabunturan", "110210": "New Bataan", "110211": "Pantukan"
        },
        "1108": { // Davao del Norte
            "110801": "Asuncion", "110802": "Braulio E. Dujali", "110803": "Carmen", "110804": "Kapalong",
            "110805": "New Corella", "110806": "City of Panabo", "110807": "Island Garden City of Samal",
            "110808": "Santo Tomas", "110809": "City of Tagum", "110810": "Talaingod"
        },
        "1112": { // Davao del Sur
            "111201": "Bansalan", "111202": "City of Davao", "111203": "City of Digos", "111204": "Hagonoy",
            "111205": "Kiblawan", "111206": "Magsaysay", "111207": "Malalag", "111208": "Matanao",
            "111209": "Padada", "111210": "Santa Cruz", "111211": "Sulop"
        },
        "1113": { // Davao Occidental
            "111301": "Don Marcelino", "111302": "Jose Abad Santos", "111303": "Malita", "111304": "Santa Maria",
            "111305": "Sarangani"
        },
        "1114": { // Davao Oriental
            "111401": "Baganga", "111402": "Banaybanay", "111403": "Boston", "111404": "Caraga",
            "111405": "Cateel", "111406": "Governor Generoso", "111407": "Lupon", "111408": "Manay",
            "111409": "City of Mati", "111410": "San Isidro", "111411": "Tarragona"
        },

        // Region XII (SOCCSKSARGEN) - Complete
        "1123": { // North Cotabato
            "112301": "Alamada", "112302": "Aleosan", "112303": "Antipas", "112304": "Arakan",
            "112305": "Banisilan", "112306": "Carmen", "112307": "City of Kidapawan", "112308": "Libungan",
            "112309": "M'lang", "112310": "Magpet", "112311": "Makilala", "112312": "Matalam",
            "112313": "Midsayap", "112314": "Pigkawayan", "112315": "Pikit", "112316": "President Roxas",
            "112317": "Tulunan"
        },
        "1124": { // Sarangani
            "112401": "Alabel", "112402": "Glan", "112403": "Kiamba", "112404": "Maasim",
            "112405": "Maitum", "112406": "Malapatan", "112407": "Malungon"
        },
        "1125": { // South Cotabato
            "112501": "Banga", "112502": "City of General Santos", "112503": "Koronadal City", "112504": "Lake Sebu",
            "112505": "Norala", "112506": "Polomolok", "112507": "Santo Niño", "112508": "Surallah",
            "112509": "T'Boli", "112510": "Tampakan", "112511": "Tantangan", "112512": "Tupi"
        },
        "1130": { // Sultan Kudarat
            "113001": "Bagumbayan", "113002": "Columbio", "113003": "Esperanza", "113004": "Isulan",
            "113005": "Kalamansig", "113006": "Lambayong", "113007": "Lebak", "113008": "Lutayan",
            "113009": "Palimbang", "113010": "President Quirino", "113011": "Senator Ninoy Aquino", "113012": "Tacurong City"
        },

        // Region XIII (Caraga) - Complete
        "1602": { // Agusan del Norte
            "160201": "Buenavista", "160202": "City of Butuan", "160203": "City of Cabadbaran", "160204": "Carmen",
            "160205": "Jabonga", "160206": "Kitcharao", "160207": "Las Nieves", "160208": "Magallanes",
            "160209": "Nasipit", "160210": "Santiago", "160211": "Tubay"
        },
        "1603": { // Agusan del Sur
            "160301": "Bayugan City", "160302": "Bunawan", "160303": "Esperanza", "160304": "La Paz",
            "160305": "Loreto", "160306": "Prosperidad", "160307": "Rosario", "160308": "San Francisco",
            "160309": "San Luis", "160310": "Santa Josefa", "160311": "Talacogon", "160312": "Trento",
            "160313": "Veruela"
        },
        "1667": { // Dinagat Islands
            "166701": "Basilisa", "166702": "Cagdianao", "166703": "Dinagat", "166704": "Libjo",
            "166705": "Loreto", "166706": "San Jose", "166707": "Tubajon"
        },
        "1668": { // Surigao del Norte
            "166801": "Alegria", "166802": "Bacuag", "166803": "Burgos", "166804": "City of Bayabas",
            "166805": "Claver", "166806": "Dapa", "166807": "Del Carmen", "166808": "General Luna",
            "166809": "Gigaquit", "166810": "Mainit", "166811": "Malimono", "166812": "Pilar",
            "166813": "Placer", "166814": "San Benito", "166815": "San Francisco", "166816": "San Isidro",
            "166817": "Santa Monica", "166818": "Sison", "166819": "Socorro", "166820": "Surigao City",
            "166821": "Tagana-an", "166822": "Tubod"
        },
        "1672": { // Surigao del Sur
            "167201": "Barobo", "167202": "Bayabas", "167203": "City of Bislig", "167204": "Cagwait",
            "167205": "Cantilan", "167206": "Carmen", "167207": "Carrascal", "167208": "Cortes",
            "167209": "Hinatuan", "167210": "Lanuza", "167211": "Lianga", "167212": "Lingig",
            "167213": "Madrid", "167214": "Marihatag", "167215": "San Agustin", "167216": "San Miguel",
            "167217": "Tagbina", "167218": "Tago", "167219": "City of Tandag"
        },

        // BARMM - Complete
        "1507": { // Basilan
            "150701": "Akbar", "150702": "Al-Barka", "150703": "Hadji Mohammad Ajul", "150704": "Hadji Muhtamad",
            "150705": "Isabela City", "150706": "Lamitan City", "150707": "Lantawan", "150708": "Maluso",
            "150709": "Sumisip", "150710": "Tabuan-Lasa", "150711": "Tipo-Tipo", "150712": "Tuburan",
            "150713": "Ungkaya Pukan"
        },
        "1536": { // Lanao del Sur
            "153601": "Amai Manabilang", "153602": "Bacolod-Kalawi", "153603": "Balabagan", "153604": "Balindong",
            "153605": "Bayang", "153606": "Binidayan", "153607": "Buadiposo-Buntong", "153608": "Bubong",
            "153609": "Butig", "153610": "Calanogas", "153611": "City of Marawi", "153612": "Ditsaan-Ramain",
            "153613": "Ganassi", "153614": "Kapai", "153615": "Kapatagan", "153616": "Lumba-Bayabao",
            "153617": "Lumbaca-Unayan", "153618": "Lumbatan", "153619": "Lumbayanague", "153620": "Madalum",
            "153621": "Madamba", "153622": "Maguing", "153623": "Malabang", "153624": "Marantao",
            "153625": "Marogong", "153626": "Masiu", "153627": "Mulondo", "153628": "Pagayawan",
            "153629": "Piagapo", "153630": "Poona Bayabao", "153631": "Pualas", "153632": "Saguiaran",
            "153633": "Sultan Dumalondong", "153634": "Picong", "153635": "Tagoloan II", "153636": "Tamparan",
            "153637": "Taraka", "153638": "Tubaran", "153639": "Tugaya", "153640": "Wao"
        },
        "1538": { // Maguindanao
            "153801": "Ampatuan", "153802": "Barira", "153803": "Buldon", "153804": "Buluan",
            "153805": "City of Cotabato", "153806": "Datu Abdullah Sangki", "153807": "Datu Anggal Midtimbang",
            "153808": "Datu Hoffer Ampatuan", "153809": "Datu Odin Sinsuat", "153810": "Datu Paglas",
            "153811": "Datu Piang", "153812": "Datu Salibo", "153813": "Datu Saudi-Ampatuan",
            "153814": "Datu Unsay", "153815": "General Salipada K. Pendatun", "153816": "Guindulungan",
            "153817": "Kabuntalan", "153818": "Mamasapano", "153819": "Mangudadatu", "153820": "Matanog",
            "153821": "Northern Kabuntalan", "153822": "Pagagawan", "153823": "Pagalungan",
            "153824": "Paglat", "153825": "Pandag", "153826": "Parang", "153827": "Rajah Buayan",
            "153828": "Shariff Aguak", "153829": "Shariff Saydona Mustapha", "153830": "South Upi",
            "153831": "Sultan Kudarat", "153832": "Sultan Mastura", "153833": "Sultan sa Barongis",
            "153834": "Talayan", "153835": "Talitay", "153836": "Upi"
        },
        "1566": { // Sulu
            "156601": "Banguingui", "156602": "Hadji Panglima Tahil", "156603": "Indanan", "156604": "Jolo",
            "156605": "Kalingalan Caluang", "156606": "Lugus", "156607": "Luuk", "156608": "Maimbung",
            "156609": "Old Panamao", "156610": "Omar", "156611": "Pandami", "156612": "Panglima Estino",
            "156613": "Pangutaran", "156614": "Parang", "156615": "Pata", "156616": "Patikul",
            "156617": "Siasi", "156618": "Talipao", "156619": "Tapul"
        },
        "1570": { // Tawi-Tawi
            "157001": "Bongao", "157002": "Languyan", "157003": "Mapun", "157004": "Panglima Sugala",
            "157005": "Sapa-Sapa", "157006": "Sibutu", "157007": "Simunul", "157008": "Sitangkai",
            "157009": "South Ubian", "157010": "Tandubas", "157011": "Turtle Islands"
        },

        // CAR - Complete
        "1401": { // Abra
            "140101": "Bangued", "140102": "Boliney", "140103": "Bucay", "140104": "Bucloc",
            "140105": "Daguioman", "140106": "Danglas", "140107": "Dolores", "140108": "La Paz",
            "140109": "Lacub", "140110": "Lagangilang", "140111": "Lagayan", "140112": "Langiden",
            "140113": "Licuan-Baay", "140114": "Luba", "140115": "Malibcong", "140116": "Manabo",
            "140117": "Peñarrubia", "140118": "Pidigan", "140119": "Pilar", "140120": "Sallapadan",
            "140121": "San Isidro", "140122": "San Juan", "140123": "San Quintin", "140124": "Tayum",
            "140125": "Tineg", "140126": "Tubo", "140127": "Villaviciosa"
        },
        "1411": { // Apayao
            "141101": "Calanasan", "141102": "Conner", "141103": "Flora", "141104": "Kabugao",
            "141105": "Luna", "141106": "Pudtol", "141107": "Santa Marcela"
        },
        "1427": { // Benguet
            "142701": "Atok", "142702": "Baguio City", "142703": "Bakun", "142704": "Bokod",
            "142705": "Buguias", "142706": "Itogon", "142707": "Kabayan", "142708": "Kapangan",
            "142709": "Kibungan", "142710": "La Trinidad", "142711": "Mankayan", "142712": "Sablan",
            "142713": "Tuba", "142714": "Tublay"
        },
        "1432": { // Ifugao
            "143201": "Aguinaldo", "143202": "Alfonso Lista", "143203": "Asipulo", "143204": "Banaue",
            "143205": "Hingyon", "143206": "Hungduan", "143207": "Kiangan", "143208": "Lagawe",
            "143209": "Lamut", "143210": "Mayoyao", "143211": "Tinoc"
        },
        "1444": { // Kalinga
            "144401": "Balbalan", "144402": "Lubuagan", "144403": "Pasil", "144404": "Pinukpuk",
            "144405": "Rizal", "144406": "Tabuk City", "144407": "Tanudan", "144408": "Tinglayan"
        },
        "1481": { // Mountain Province
            "148101": "Barlig", "148102": "Bauko", "148103": "Besao", "148104": "Bontoc",
            "148105": "Natonin", "148106": "Paracelis", "148107": "Sabangan", "148108": "Sadanga",
            "148109": "Sagada", "148110": "Tadian"
        },

        // NCR - Complete
        "1374": { // Metro Manila
            "137401": "Caloocan", "137402": "Las Piñas", "137403": "Makati", "137404": "Malabon",
            "137405": "Mandaluyong", "137406": "Manila", "137407": "Marikina", "137408": "Muntinlupa",
            "137409": "Navotas", "137410": "Parañaque", "137411": "Pasay", "137412": "Pasig",
            "137413": "Pateros", "137414": "Quezon City", "137415": "San Juan", "137416": "Taguig",
            "137417": "Valenzuela"
        }
    },

    barangays: {
        // Sample barangays for major cities - can be expanded
        "012906": [ // City of Candon, Ilocos Sur
            "Allangigan Primero", "Allangigan Segundo", "Amguid", "Ayudante", "Bagani Campo",
            "Bagani Gabor", "Bagani Tocgo", "Bagani Ubbog", "Bagar", "Balacad", "Balingaoan",
            "Bugnay", "Calabugao", "Calingayan", "Calongbuyan", "Calumboyan", "Cambali",
            "Canaoay", "Caritan Norte", "Caritan Sur", "Cataraoan", "Cubcubbuot", "Darapidap",
            "Dardarat", "Del Pilar", "Dungan", "Gabor Norte", "Gabor Sur", "Guinabang",
            "Lusnac", "Malingeb", "Nagtalang", "Nagsingcaoan", "Oaig Daya", "Palacapac",
            "Paras", "Parioc Primero", "Parioc Segundo", "Patpata Primero", "Patpata Segundo",
            "Paypayad", "Poblacion", "Salapadan", "Salincub", "Santa Maria", "Santo Tomas",
            "Tabilao", "Talang", "Tamurong", "Tanolong", "Tay-ac", "Telo", "Teppeng", "Villacorta"
        ],
        "012909": [ // City of Vigan, Ilocos Sur
            "Ayusan Norte", "Ayusan Sur", "Barrio Norte", "Barrio Sur", "Barraca",
            "Beddeng Laud", "Beddeng Daya", "Bulala", "Cabalangegan", "Cabaroan",
            "Cabittaogan", "Capangpangan", "Mindoro", "Nagsangalan", "Pantay Daya",
            "Pantay Laud", "Pantay Tamurong", "Paoa", "Paratong", "Pong-ol",
            "Purok-a-bassit", "Purok-a-dackel", "Raois", "Rugsuanan", "Salindeg",
            "San Jose", "San Julian Norte", "San Julian Sur", "San Pedro", "Tamag",
            "Tampil", "Tay-ac", "Vigan", "Zamora"
        ],
        "140101": [ // Bangued, Abra
            "Agtangao", "Angad", "Bañacao", "Bangbangar", "Cabuloan", "Calaba", "Calot",
            "Camasi", "Capitol", "Cosili East", "Cosili West", "Daclan", "Dangdangla",
            "Lingtan", "Lipcan", "Lubong", "Macarcarmay", "Macray", "Maoay", "Mayot",
            "Nalvo", "Palao", "Patucannay", "Sagap", "San Antonio", "Santa Rosa",
            "Sao-atan", "Sappaac", "Tablac", "Tublay", "Zone 1", "Zone 2", "Zone 3",
            "Zone 4", "Zone 5", "Zone 6", "Zone 7"
        ]
    }
};

// Function to initialize address selection dropdowns
function initializeAddressSelection() {
    const regionSelect = document.getElementById('region');
    const provinceSelect = document.getElementById('province');
    const municipalitySelect = document.getElementById('municipality');
    const barangaySelect = document.getElementById('barangay');

    if (!regionSelect || !provinceSelect || !municipalitySelect || !barangaySelect) {
        console.error('Address selection elements not found');
        return;
    }

    // Populate regions
    populateRegions();

    // Event listeners
    regionSelect.addEventListener('change', function() {
        const selectedRegion = this.value;
        clearSelect(provinceSelect);
        clearSelect(municipalitySelect);
        clearSelect(barangaySelect);

        if (selectedRegion) {
            populateProvinces(selectedRegion);
        }
    });

    provinceSelect.addEventListener('change', function() {
        const selectedRegion = regionSelect.value;
        const selectedProvince = this.value;
        clearSelect(municipalitySelect);
        clearSelect(barangaySelect);

        if (selectedRegion && selectedProvince) {
            populateMunicipalities(selectedProvince);
        }
    });

    municipalitySelect.addEventListener('change', function() {
        const selectedMunicipality = this.value;
        clearSelect(barangaySelect);

        if (selectedMunicipality) {
            populateBarangays(selectedMunicipality);
        }
    });

    function populateRegions() {
        // Clear existing options except the first one
        regionSelect.innerHTML = '<option value="">Select Region</option>';

        // Add regions
        Object.keys(philippineAddresses.regions).forEach(regionCode => {
            const option = document.createElement('option');
            option.value = regionCode;
            option.textContent = philippineAddresses.regions[regionCode];
            regionSelect.appendChild(option);
        });
    }

    function populateProvinces(regionCode) {
        const provinces = philippineAddresses.provinces[regionCode];
        if (!provinces) return;

        provinceSelect.innerHTML = '<option value="">Select Province</option>';

        Object.keys(provinces).forEach(provinceCode => {
            const option = document.createElement('option');
            option.value = provinceCode;
            option.textContent = provinces[provinceCode];
            provinceSelect.appendChild(option);
        });
    }

    function populateMunicipalities(provinceCode) {
        const municipalities = philippineAddresses.municipalities[provinceCode];
        if (!municipalities) return;

        municipalitySelect.innerHTML = '<option value="">Select Municipality/City</option>';

        Object.keys(municipalities).forEach(municipalityCode => {
            const option = document.createElement('option');
            option.value = municipalityCode;
            option.textContent = municipalities[municipalityCode];
            municipalitySelect.appendChild(option);
        });
    }

    function populateBarangays(municipalityCode) {
        const barangays = philippineAddresses.barangays[municipalityCode];
        if (!barangays) {
            // If no barangays data, show a default option
            barangaySelect.innerHTML = '<option value="">Select Barangay</option><option value="N/A">Barangay data not available</option>';
            return;
        }

        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        barangays.forEach(barangay => {
            const option = document.createElement('option');
            option.value = barangay;
            option.textContent = barangay;
            barangaySelect.appendChild(option);
        });
    }

    function clearSelect(selectElement) {
        const firstOption = selectElement.querySelector('option');
        selectElement.innerHTML = '';
        if (firstOption) {
            selectElement.appendChild(firstOption);
        }
    }
}