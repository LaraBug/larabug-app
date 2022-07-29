<?php

if (! function_exists('carbon')) {
    /**
     * Carbon helper
     *
     * @param $time
     * @param $tz
     *
     * @return Carbon\Carbon
     * @version 2.1
     */
    function carbon($time = null, $tz = null)
    {
        return app(\Carbon\Carbon::class, [$time, $tz]);
    }
}

if (! function_exists('format_euros')) {
    function format_euros($value, $prefix = true)
    {
        return ($prefix ? '€' : '').number_format($value, 2, ',', '');
    }
}

if (! function_exists('months')) {
    function months()
    {
        return [
            '1' => '1 Month',
            2 => '2 Months',
            3 => '3 Months',
            4 => '4 Months',
            5 => '5 Months',
            6 => '6 Months',
            7 => '7 Months',
            8 => '8 Months',
            9 => '9 Months',
            10 => '10 Months',
            11 => '11 Months',
            12 => '12 Months',

        ];
    }
}

if (! function_exists('canonical_url')) {
    function canonical_url()
    {
        if (! $route = Route::current()) {
            return false;
        }

        if (! $action = $route->getAction()) {
            return false;
        }

        if (! array_has($action, 'uses') || $action['uses'] instanceof Closure) {
            return false;
        }

        if (! $uses = $action['uses']) {
            return false;
        }

        return action($uses, $route->parameters() ?? []);
    }
}

if (! function_exists('countries')) {
    function countries($key = null)
    {
        $arr = [
            "af" => "Afghanistan",
            "al" => "Albania",
            "dz" => "Algeria",
            "as" => "American Samoa",
            "ad" => "Andorra",
            "ao" => "Angola",
            "ai" => "Anguilla",
            "aq" => "Antarctica",
            "ag" => "Antigua and Barbuda",
            "ar" => "Argentina",
            "am" => "Armenia",
            "aw" => "Aruba",
            "au" => "Australia",
            "at" => "Austria",
            "az" => "Azerbaijan",
            "bs" => "Bahamas",
            "bh" => "Bahrain",
            "bd" => "Bangladesh",
            "bb" => "Barbados",
            "by" => "Belarus",
            "be" => "Belgium",
            "bz" => "Belize",
            "bj" => "Benin",
            "bm" => "Bermuda",
            "bt" => "Bhutan",
            "bo" => "Bolivia",
            "ba" => "Bosnia and Herzegovina",
            "bw" => "Botswana",
            "bv" => "Bouvet Island",
            "br" => "Brazil",
            "bq" => "British Antarctic Territory",
            "io" => "British Indian Ocean Territory",
            "vg" => "British Virgin Islands",
            "bn" => "Brunei",
            "bg" => "Bulgaria",
            "bf" => "Burkina Faso",
            "bi" => "Burundi",
            "kh" => "Cambodia",
            "cm" => "Cameroon",
            "ca" => "Canada",
            "ct" => "Canton and Enderbury Islands",
            "cv" => "Cape Verde",
            "ky" => "Cayman Islands",
            "cf" => "Central African Republic",
            "td" => "Chad",
            "cl" => "Chile",
            "cn" => "China",
            "cx" => "Christmas Island",
            "cc" => "Cocos [Keeling] Islands",
            "co" => "Colombia",
            "km" => "Comoros",
            "cg" => "Congo - Brazzaville",
            "cd" => "Congo - Kinshasa",
            "ck" => "Cook Islands",
            "cr" => "Costa Rica",
            "hr" => "Croatia",
            "cu" => "Cuba",
            "cy" => "Cyprus",
            "cz" => "Czech Republic",
            "ci" => "Côte d’Ivoire",
            "dk" => "Denmark",
            "dj" => "Djibouti",
            "dm" => "Dominica",
            "do" => "Dominican Republic",
            "nq" => "Dronning Maud Land",
            "dd" => "East Germany",
            "ec" => "Ecuador",
            "eg" => "Egypt",
            "sv" => "El Salvador",
            "gq" => "Equatorial Guinea",
            "er" => "Eritrea",
            "ee" => "Estonia",
            "et" => "Ethiopia",
            "fk" => "Falkland Islands",
            "fo" => "Faroe Islands",
            "fj" => "Fiji",
            "fi" => "Finland",
            "fr" => "France",
            "gf" => "French Guiana",
            "pf" => "French Polynesia",
            "tf" => "French Southern Territories",
            "fq" => "French Southern and Antarctic Territories",
            "ga" => "Gabon",
            "gm" => "Gambia",
            "ge" => "Georgia",
            "de" => "Germany",
            "gh" => "Ghana",
            "gi" => "Gibraltar",
            "gr" => "Greece",
            "gl" => "Greenland",
            "gd" => "Grenada",
            "gp" => "Guadeloupe",
            "gu" => "Guam",
            "gt" => "Guatemala",
            "gg" => "Guernsey",
            "gn" => "Guinea",
            "gw" => "Guinea-Bissau",
            "gy" => "Guyana",
            "ht" => "Haiti",
            "hm" => "Heard Island and McDonald Islands",
            "hn" => "Honduras",
            "hk" => "Hong Kong SAR China",
            "hu" => "Hungary",
            "is" => "Iceland",
            "in" => "India",
            "id" => "Indonesia",
            "ir" => "Iran",
            "iq" => "Iraq",
            "ie" => "Ireland",
            "im" => "Isle of Man",
            "il" => "Israel",
            "it" => "Italy",
            "jm" => "Jamaica",
            "jp" => "Japan",
            "je" => "Jersey",
            "jt" => "Johnston Island",
            "jo" => "Jordan",
            "kz" => "Kazakhstan",
            "ke" => "Kenya",
            "ki" => "Kiribati",
            "kw" => "Kuwait",
            "kg" => "Kyrgyzstan",
            "la" => "Laos",
            "lv" => "Latvia",
            "lb" => "Lebanon",
            "ls" => "Lesotho",
            "lr" => "Liberia",
            "ly" => "Libya",
            "li" => "Liechtenstein",
            "lt" => "Lithuania",
            "lu" => "Luxembourg",
            "mo" => "Macau SAR China",
            "mk" => "Macedonia",
            "mg" => "Madagascar",
            "mw" => "Malawi",
            "my" => "Malaysia",
            "mv" => "Maldives",
            "ml" => "Mali",
            "mt" => "Malta",
            "mh" => "Marshall Islands",
            "mq" => "Martinique",
            "mr" => "Mauritania",
            "mu" => "Mauritius",
            "yt" => "Mayotte",
            "fx" => "Metropolitan France",
            "mx" => "Mexico",
            "fm" => "Micronesia",
            "mi" => "Midway Islands",
            "md" => "Moldova",
            "mc" => "Monaco",
            "mn" => "Mongolia",
            "me" => "Montenegro",
            "ms" => "Montserrat",
            "ma" => "Morocco",
            "mz" => "Mozambique",
            "mm" => "Myanmar [Burma]",
            "na" => "Namibia",
            "nr" => "Nauru",
            "np" => "Nepal",
            "nl" => "Netherlands",
            "an" => "Netherlands Antilles",
            "nt" => "Neutral Zone",
            "nc" => "New Caledonia",
            "nz" => "New Zealand",
            "ni" => "Nicaragua",
            "ne" => "Niger",
            "ng" => "Nigeria",
            "nu" => "Niue",
            "nf" => "Norfolk Island",
            "kp" => "North Korea",
            "vd" => "North Vietnam",
            "mp" => "Northern Mariana Islands",
            "no" => "Norway",
            "om" => "Oman",
            "pc" => "Pacific Islands Trust Territory",
            "pk" => "Pakistan",
            "pw" => "Palau",
            "ps" => "Palestinian Territories",
            "pa" => "Panama",
            "pz" => "Panama Canal Zone",
            "pg" => "Papua New Guinea",
            "py" => "Paraguay",
            "yd" => "People's Democratic Republic of Yemen",
            "pe" => "Peru",
            "ph" => "Philippines",
            "pn" => "Pitcairn Islands",
            "pl" => "Poland",
            "pt" => "Portugal",
            "pr" => "Puerto Rico",
            "qa" => "Qatar",
            "ro" => "Romania",
            "ru" => "Russia",
            "rw" => "Rwanda",
            "re" => "Réunion",
            "bl" => "Saint Barthélemy",
            "sh" => "Saint Helena",
            "kn" => "Saint Kitts and Nevis",
            "lc" => "Saint Lucia",
            "mf" => "Saint Martin",
            "pm" => "Saint Pierre and Miquelon",
            "vc" => "Saint Vincent and the Grenadines",
            "ws" => "Samoa",
            "sm" => "San Marino",
            "sa" => "Saudi Arabia",
            "sn" => "Senegal",
            "rs" => "Serbia",
            "cs" => "Serbia and Montenegro",
            "sc" => "Seychelles",
            "sl" => "Sierra Leone",
            "sg" => "Singapore",
            "sk" => "Slovakia",
            "si" => "Slovenia",
            "sb" => "Solomon Islands",
            "so" => "Somalia",
            "za" => "South Africa",
            "gs" => "South Georgia and the South Sandwich Islands",
            "kr" => "South Korea",
            "es" => "Spain",
            "lk" => "Sri Lanka",
            "sd" => "Sudan",
            "sr" => "Suriname",
            "sj" => "Svalbard and Jan Mayen",
            "sz" => "Swaziland",
            "se" => "Sweden",
            "ch" => "Switzerland",
            "sy" => "Syria",
            "st" => "São Tomé and Príncipe",
            "tw" => "Taiwan",
            "tj" => "Tajikistan",
            "tz" => "Tanzania",
            "th" => "Thailand",
            "tl" => "Timor-Leste",
            "tg" => "Togo",
            "tk" => "Tokelau",
            "to" => "Tonga",
            "tt" => "Trinidad and Tobago",
            "tn" => "Tunisia",
            "tr" => "Turkey",
            "tm" => "Turkmenistan",
            "tc" => "Turks and Caicos Islands",
            "tv" => "Tuvalu",
            "um" => "U.S. Minor Outlying Islands",
            "pu" => "U.S. Miscellaneous Pacific Islands",
            "vi" => "U.S. Virgin Islands",
            "ug" => "Uganda",
            "ua" => "Ukraine",
            "su" => "Union of Soviet Socialist Republics",
            "ae" => "United Arab Emirates",
            "en" => "United Kingdom",
            "us" => "United States",
            "zz" => "Unknown or Invalid Region",
            "uy" => "Uruguay",
            "uz" => "Uzbekistan",
            "vu" => "Vanuatu",
            "va" => "Vatican City",
            "ve" => "Venezuela",
            "vn" => "Vietnam",
            "wk" => "Wake Island",
            "wf" => "Wallis and Futuna",
            "eh" => "Western Sahara",
            "ye" => "Yemen",
            "zm" => "Zambia",
            "zw" => "Zimbabwe",
            "ax" => "Åland Islands",
        ];

        if ($key) {
            return $arr[strtoupper($key)];
        }

        return $arr;
    }
}
