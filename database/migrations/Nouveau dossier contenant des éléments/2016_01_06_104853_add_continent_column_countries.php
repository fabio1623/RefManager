<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Country;

class AddContinentColumnCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $countries = Country::all();

        Schema::table('references', function (Blueprint $table) {
            $table->dropForeign('references_country_foreign');
        });

        Schema::table('country_zone', function (Blueprint $table) {
            $table->dropForeign('country_zone_country_id_foreign');
        });

        foreach ($countries as $country) {
            $country->zones()->detach();
        }
        DB::table('countries')->truncate();

        Schema::table('countries', function (Blueprint $table) {
            $table->enum('continent', ['','Africa', 'America', 'Asia', 'Europe', 'Oceanie']);
        });

        $countryList = array(
            "Africa" => array(
                "DZ" => "Algeria",
                "AO" => "Angola",
                "BJ" => "Benin",
                "BW" => "Botswana",
                "BF" => "Burkina Faso",
                "BI" => "Burundi",
                "CM" => "Cameroon",
                "CV" => "Cape Verde",
                "CF" => "Central African Republic",
                "TD" => "Chad",
                "KM" => "Comoros",
                "CG" => "Congo - Brazzaville",
                "CD" => "Congo - Kinshasa",
                "CI" => "Côte d’Ivoire",
                "DJ" => "Djibouti",
                "EG" => "Egypt",
                "GQ" => "Equatorial Guinea",
                "ER" => "Eritrea",
                "ET" => "Ethiopia",
                "GA" => "Gabon",
                "GM" => "Gambia",
                "GH" => "Ghana",
                "GN" => "Guinea",
                "GW" => "Guinea-Bissau",
                "KE" => "Kenya",
                "LS" => "Lesotho",
                "LR" => "Liberia",
                "LY" => "Libya",
                "MG" => "Madagascar",
                "MW" => "Malawi",
                "ML" => "Mali",
                "MR" => "Mauritania",
                "MU" => "Mauritius",
                "YT" => "Mayotte",
                "MA" => "Morocco",
                "MZ" => "Mozambique",
                "NA" => "Namibia",
                "NE" => "Niger",
                "NG" => "Nigeria",
                "RW" => "Rwanda",
                "RE" => "Réunion",
                "SH" => "Saint Helena",
                "SN" => "Senegal",
                "SC" => "Seychelles",
                "SL" => "Sierra Leone",
                "SO" => "Somalia",
                "ZA" => "South Africa",
                "SD" => "Sudan",
                "SZ" => "Swaziland",
                "ST" => "São Tomé and Príncipe",
                "TZ" => "Tanzania",
                "TG" => "Togo",
                "TN" => "Tunisia",
                "UG" => "Uganda",
                "EH" => "Western Sahara",
                "ZM" => "Zambia",
                "ZW" => "Zimbabwe",
            ),
            "America" => array(
                "AI" => "Anguilla",
                "AG" => "Antigua and Barbuda",
                "AR" => "Argentina",
                "AW" => "Aruba",
                "BS" => "Bahamas",
                "BB" => "Barbados",
                "BZ" => "Belize",
                "BM" => "Bermuda",
                "BO" => "Bolivia",
                "BR" => "Brazil",
                "VG" => "British Virgin Islands",
                "CA" => "Canada",
                "KY" => "Cayman Islands",
                "CL" => "Chile",
                "CO" => "Colombia",
                "CR" => "Costa Rica",
                "CU" => "Cuba",
                "DM" => "Dominica",
                "DO" => "Dominican Republic",
                "EC" => "Ecuador",
                "SV" => "El Salvador",
                "FK" => "Falkland Islands",
                "GF" => "French Guiana",
                "GL" => "Greenland",
                "GD" => "Grenada",
                "GP" => "Guadeloupe",
                "GT" => "Guatemala",
                "GY" => "Guyana",
                "HT" => "Haiti",
                "HN" => "Honduras",
                "JM" => "Jamaica",
                "MQ" => "Martinique",
                "MX" => "Mexico",
                "MS" => "Montserrat",
                "AN" => "Netherlands Antilles",
                "NI" => "Nicaragua",
                "PA" => "Panama",
                "PY" => "Paraguay",
                "PE" => "Peru",
                "PR" => "Puerto Rico",
                "BL" => "Saint Barthélemy",
                "KN" => "Saint Kitts and Nevis",
                "LC" => "Saint Lucia",
                "MF" => "Saint Martin",
                "PM" => "Saint Pierre and Miquelon",
                "VC" => "Saint Vincent and the Grenadines",
                "SR" => "Suriname",
                "TT" => "Trinidad and Tobago",
                "TC" => "Turks and Caicos Islands",
                "VI" => "U.S. Virgin Islands",
                "US" => "United States",
                "UY" => "Uruguay",
                "VE" => "Venezuela",
            ),
            "Asia" => array(
                "AF" => "Afghanistan",
                "AM" => "Armenia",
                "AZ" => "Azerbaijan",
                "BH" => "Bahrain",
                "BD" => "Bangladesh",
                "BT" => "Bhutan",
                "BN" => "Brunei",
                "KH" => "Cambodia",
                "CN" => "China",
                "CY" => "Cyprus",
                "GE" => "Georgia",
                "HK" => "Hong Kong SAR China",
                "IN" => "India",
                "ID" => "Indonesia",
                "IR" => "Iran",
                "IQ" => "Iraq",
                "IL" => "Israel",
                "JP" => "Japan",
                "JO" => "Jordan",
                "KZ" => "Kazakhstan",
                "KW" => "Kuwait",
                "KG" => "Kyrgyzstan",
                "LA" => "Laos",
                "LB" => "Lebanon",
                "MO" => "Macau SAR China",
                "MY" => "Malaysia",
                "MV" => "Maldives",
                "MN" => "Mongolia",
                "MM" => "Myanmar [Burma]",
                "NP" => "Nepal",
                "NT" => "Neutral Zone",
                "KP" => "North Korea",
                "OM" => "Oman",
                "PK" => "Pakistan",
                "PS" => "Palestinian Territories",
                "YD" => "People's Democratic Republic of Yemen",
                "PH" => "Philippines",
                "QA" => "Qatar",
                "SA" => "Saudi Arabia",
                "SG" => "Singapore",
                "KR" => "South Korea",
                "LK" => "Sri Lanka",
                "SY" => "Syria",
                "TW" => "Taiwan",
                "TJ" => "Tajikistan",
                "TH" => "Thailand",
                "TL" => "Timor-Leste",
                "TR" => "Turkey",
                "TM" => "Turkmenistan",
                "AE" => "United Arab Emirates",
                "UZ" => "Uzbekistan",
                "VN" => "Vietnam",
                "YE" => "Yemen",
            ),
            "Europe" => array(
                "AL" => "Albania",
                "AD" => "Andorra",
                "AT" => "Austria",
                "BY" => "Belarus",
                "BE" => "Belgium",
                "BA" => "Bosnia and Herzegovina",
                "BG" => "Bulgaria",
                "HR" => "Croatia",
                "CY" => "Cyprus",
                "CZ" => "Czech Republic",
                "DK" => "Denmark",
                "DD" => "East Germany",
                "EE" => "Estonia",
                "FO" => "Faroe Islands",
                "FI" => "Finland",
                "FR" => "France",
                "DE" => "Germany",
                "GI" => "Gibraltar",
                "GR" => "Greece",
                "GG" => "Guernsey",
                "HU" => "Hungary",
                "IS" => "Iceland",
                "IE" => "Ireland",
                "IM" => "Isle of Man",
                "IT" => "Italy",
                "JE" => "Jersey",
                "LV" => "Latvia",
                "LI" => "Liechtenstein",
                "LT" => "Lithuania",
                "LU" => "Luxembourg",
                "MK" => "Macedonia",
                "MT" => "Malta",
                "FX" => "Metropolitan France",
                "MD" => "Moldova",
                "MC" => "Monaco",
                "ME" => "Montenegro",
                "NL" => "Netherlands",
                "NO" => "Norway",
                "PL" => "Poland",
                "PT" => "Portugal",
                "RO" => "Romania",
                "RU" => "Russia",
                "SM" => "San Marino",
                "RS" => "Serbia",
                "CS" => "Serbia and Montenegro",
                "SK" => "Slovakia",
                "SI" => "Slovenia",
                "ES" => "Spain",
                "SJ" => "Svalbard and Jan Mayen",
                "SE" => "Sweden",
                "CH" => "Switzerland",
                "UA" => "Ukraine",
                "SU" => "Union of Soviet Socialist Republics",
                "GB" => "United Kingdom",
                "VA" => "Vatican City",
                "AX" => "Åland Islands",
            ),
            "Oceania" => array(
                "AS" => "American Samoa",
                "AQ" => "Antarctica",
                "AU" => "Australia",
                "BV" => "Bouvet Island",
                "IO" => "British Indian Ocean Territory",
                "CX" => "Christmas Island",
                "CC" => "Cocos [Keeling] Islands",
                "CK" => "Cook Islands",
                "FJ" => "Fiji",
                "PF" => "French Polynesia",
                "TF" => "French Southern Territories",
                "GU" => "Guam",
                "HM" => "Heard Island and McDonald Islands",
                "KI" => "Kiribati",
                "MH" => "Marshall Islands",
                "FM" => "Micronesia",
                "NR" => "Nauru",
                "NC" => "New Caledonia",
                "NZ" => "New Zealand",
                "NU" => "Niue",
                "NF" => "Norfolk Island",
                "MP" => "Northern Mariana Islands",
                "PW" => "Palau",
                "PG" => "Papua New Guinea",
                "PN" => "Pitcairn Islands",
                "WS" => "Samoa",
                "SB" => "Solomon Islands",
                "GS" => "South Georgia and the South Sandwich Islands",
                "TK" => "Tokelau",
                "TO" => "Tonga",
                "TV" => "Tuvalu",
                "UM" => "U.S. Minor Outlying Islands",
                "VU" => "Vanuatu",
                "WF" => "Wallis and Futuna",
            ),
        );

        foreach ($countryList as $key => $continent) {
            foreach ($continent as $country) {
                $new_country = new Country;
                $new_country->name = $country;
                $new_country->continent = $key;

                $new_country->save();
            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('countries')->truncate();

        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

        foreach ($countries as $country) {
            $new_country = new Country;
            $new_country->name = $country;
        
            $new_country->save();
        }

        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('continent');
        });
    }
}
