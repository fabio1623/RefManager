<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Language;

class InsertLanguages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->string('code', 2);
        });

        Schema::table('language_reference', function (Blueprint $table) {
            $table->dropForeign('language_reference_language_id_foreign');
            $table->dropForeign('language_reference_reference_id_foreign');
            DB::table('language_reference')->delete();
        });

        Schema::table('languages', function (Blueprint $table) {
            DB::table('languages')->truncate();

            $translation_languages = array(
                'en' => 'English' , 
                'aa' => 'Afar' , 
                'ab' => 'Abkhazian' , 
                'af' => 'Afrikaans' , 
                'am' => 'Amharic' , 
                'ar' => 'Arabic' , 
                'as' => 'Assamese' , 
                'ay' => 'Aymara' , 
                'az' => 'Azerbaijani' , 
                'ba' => 'Bashkir' , 
                'be' => 'Byelorussian' , 
                'bg' => 'Bulgarian' , 
                'bh' => 'Bihari' , 
                'bi' => 'Bislama' , 
                'bn' => 'Bengali/Bangla' , 
                'bo' => 'Tibetan' , 
                'br' => 'Breton' , 
                'ca' => 'Catalan' , 
                'co' => 'Corsican' , 
                'cs' => 'Czech' , 
                'cy' => 'Welsh' , 
                'da' => 'Danish' , 
                'de' => 'German' , 
                'dz' => 'Bhutani' , 
                'el' => 'Greek' , 
                'eo' => 'Esperanto' , 
                'es' => 'Spanish' , 
                'et' => 'Estonian' , 
                'eu' => 'Basque' , 
                'fa' => 'Persian' , 
                'fi' => 'Finnish' , 
                'fj' => 'Fiji' , 
                'fo' => 'Faeroese' , 
                'fr' => 'French' , 
                'fy' => 'Frisian' , 
                'ga' => 'Irish' , 
                'gd' => 'Scots/Gaelic' , 
                'gl' => 'Galician' , 
                'gn' => 'Guarani' , 
                'gu' => 'Gujarati' , 
                'ha' => 'Hausa' , 
                'hi' => 'Hindi' , 
                'hr' => 'Croatian' , 
                'hu' => 'Hungarian' , 
                'hy' => 'Armenian' , 
                'ia' => 'Interlingua' , 
                'ie' => 'Interlingue' , 
                'ik' => 'Inupiak' , 
                'in' => 'Indonesian' , 
                'is' => 'Icelandic' , 
                'it' => 'Italian' , 
                'iw' => 'Hebrew' , 
                'ja' => 'Japanese' , 
                'ji' => 'Yiddish' , 
                'jw' => 'Javanese' , 
                'ka' => 'Georgian' , 
                'kk' => 'Kazakh' , 
                'kl' => 'Greenlandic' , 
                'km' => 'Cambodian' , 
                'kn' => 'Kannada' , 
                'ko' => 'Korean' , 
                'ks' => 'Kashmiri' , 
                'ku' => 'Kurdish' , 
                'ky' => 'Kirghiz' , 
                'la' => 'Latin' , 
                'ln' => 'Lingala' , 
                'lo' => 'Laothian' , 
                'lt' => 'Lithuanian' , 
                'lv' => 'Latvian/Lettish' , 
                'mg' => 'Malagasy' , 
                'mi' => 'Maori' , 
                'mk' => 'Macedonian' , 
                'ml' => 'Malayalam' , 
                'mn' => 'Mongolian' , 
                'mo' => 'Moldavian' , 
                'mr' => 'Marathi' , 
                'ms' => 'Malay' , 
                'mt' => 'Maltese' , 
                'my' => 'Burmese' , 
                'na' => 'Nauru' , 
                'ne' => 'Nepali' , 
                'nl' => 'Dutch' , 
                'no' => 'Norwegian' , 
                'oc' => 'Occitan' , 
                'om' => '(Afan)/Oromoor/Oriya' , 
                'pa' => 'Punjabi' , 
                'pl' => 'Polish' , 
                'ps' => 'Pashto/Pushto' , 
                'pt' => 'Portuguese' , 
                'qu' => 'Quechua' , 
                'rm' => 'Rhaeto-Romance' , 
                'rn' => 'Kirundi' , 
                'ro' => 'Romanian' , 
                'ru' => 'Russian' , 
                'rw' => 'Kinyarwanda' , 
                'sa' => 'Sanskrit' , 
                'sd' => 'Sindhi' , 
                'sg' => 'Sangro' , 
                'sh' => 'Serbo-Croatian' , 
                'si' => 'Singhalese' , 
                'sk' => 'Slovak' , 
                'sl' => 'Slovenian' , 
                'sm' => 'Samoan' , 
                'sn' => 'Shona' , 
                'so' => 'Somali' , 
                'sq' => 'Albanian' , 
                'sr' => 'Serbian' , 
                'ss' => 'Siswati' , 
                'st' => 'Sesotho' , 
                'su' => 'Sundanese' , 
                'sv' => 'Swedish' , 
                'sw' => 'Swahili' , 
                'ta' => 'Tamil' , 
                'te' => 'Tegulu' , 
                'tg' => 'Tajik' , 
                'th' => 'Thai' , 
                'ti' => 'Tigrinya' , 
                'tk' => 'Turkmen' , 
                'tl' => 'Tagalog' , 
                'tn' => 'Setswana' , 
                'to' => 'Tonga' , 
                'tr' => 'Turkish' , 
                'ts' => 'Tsonga' , 
                'tt' => 'Tatar' , 
                'tw' => 'Twi' , 
                'uk' => 'Ukrainian' , 
                'ur' => 'Urdu' , 
                'uz' => 'Uzbek' , 
                'vi' => 'Vietnamese' , 
                'vo' => 'Volapuk' , 
                'wo' => 'Wolof' , 
                'xh' => 'Xhosa' , 
                'yo' => 'Yoruba' , 
                'zh' => 'Chinese' , 
                'zu' => 'Zulu' , 
                );
            
            foreach ($translation_languages as $key => $value) {
                $new_language = new Language;
                
                $new_language->code = $key;
                $new_language->name = $value;

                $new_language->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('languages', function (Blueprint $table) {
            DB::table('languages')->truncate();
            $table->dropColumn('code');
        });

        Schema::table('languages', function (Blueprint $table) {
            $languages = array('English', 'French', 'Spanish', 'Portuguese');

            foreach ($languages as $language) {
                $new_language = new Language;
                $new_language->name = $language;

                $new_language->save();
            }
        });
    }
}
