<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;

class LocalizableSeeder extends Seeder
{
    public function run()
    {
        $smokes = [
            'smoker' => [
                'en-US' => 'smoker',
                'ja-JP' => '喫煙者',
                'ko-KR' => '흡연자',
            ],
            'non_smoker' => [
                'en-US' => 'non smoker',
                'ja-JP' => '非喫煙者',
                'ko-KR' => '비흡연자',
            ],
        ];

        $religions = [
            'irreligion' => [
                'en-US' => 'irreligion',
                'ja-JP' => '無宗教',
                'ko-KR' => '무교',
            ],
            'christianity' => [
                'en-US' => 'christianity',
                'ja-JP' => 'キリスト教',
                'ko-KR' => '기독교',
            ],
            'catholicism' => [
                'en-US' => 'catholicism',
                'ja-JP' => 'カトリシズム',
                'ko-KR' => '천주교',
            ],
            'buddhism' => [
                'en-US' => 'buddhism',
                'ja-JP' => '仏教',
                'ko-KR' => '불교',
            ],
        ];

        $language = [
            'de-DE' => [
                'de-DE' => 'Deutsch',
                'el-GR' => 'Γερμανικά',
                'en-US' => 'German',
                'es-ES' => 'alemán',
                'fr-FR' => 'allemand',
                'it-IT' => 'tedesco',
                'ja-JP' => 'ドイツ語',
                'ru-RU' => 'немецкий',
                'ko-KR' => '독일어',
                'vi-VN' => 'tiếng Đức',
                'zh-CN' => '德国',
                'zh-TW' => '德國',
            ],
            'el-GR' => [
                'de-DE' => 'griechisch',
                'el-GR' => 'ελληνικά',
                'en-US' => 'Greek',
                'es-ES' => 'griego',
                'fr-FR' => 'grecque',
                'it-IT' => 'greco',
                'ja-JP' => 'ギリシヤ語',
                'ru-RU' => 'греческий',
                'ko-KR' => '그리스어',
                'vi-VN' => 'tiếng Hy Lạp',
                'zh-CN' => '希腊语',
                'zh-TW' => '希臘語',
            ],
            'en-US' => [
                'de-DE' => 'Englisch',
                'el-GR' => 'Αγγλικά',
                'en-US' => 'English',
                'es-ES' => 'Inglés',
                'fr-FR' => 'anglais',
                'it-IT' => 'inglese',
                'ja-JP' => '英語',
                'ru-RU' => 'английский',
                'ko-KR' => '영어',
                'vi-VN' => 'tiếng Anh',
                'zh-CN' => '英语',
                'zh-TW' => '英語',
            ],
            'es-ES' => [
                'de-DE' => 'Spanisch',
                'el-GR' => 'ισπανικά',
                'en-US' => 'Spanish',
                'es-ES' => 'español',
                'fr-FR' => 'Espagnol',
                'it-IT' => 'spagnolo',
                'ja-JP' => 'スペイン語',
                'ru-RU' => 'испанский',
                'ko-KR' => '스페인어',
                'vi-VN' => 'tiếng Tây Ban Nha',
                'zh-CN' => '西班牙语',
                'zh-TW' => '西班牙語',
            ],
            'fr-FR' => [
                'de-DE' => 'Französisch',
                'el-GR' => 'Γαλλίδα',
                'en-US' => 'French',
                'es-ES' => 'francés',
                'fr-FR' => 'français',
                'it-IT' => 'francese',
                'ja-JP' => 'フランス語',
                'ru-RU' => 'французский',
                'ko-KR' => '프랑스어',
                'vi-VN' => 'tiếng Pháp',
                'zh-CN' => '法语',
                'zh-TW' => '法語',
            ],
            'it-IT' => [
                'de-DE' => 'Italienisch',
                'el-GR' => 'ιταλικά',
                'en-US' => 'Italian',
                'es-ES' => 'italiano',
                'fr-FR' => 'italien',
                'it-IT' => 'italiano',
                'ja-JP' => 'イタリア語',
                'ru-RU' => 'итальянский',
                'ko-KR' => '이탈리아어',
                'vi-VN' => 'tiếng Ý',
                'zh-CN' => '意大利语',
                'zh-TW' => '意大利語',
            ],
            'ja-JP' => [
                'de-DE' => 'japanisch',
                'el-GR' => 'Ιαπωνικά',
                'en-US' => 'Japanese',
                'es-ES' => 'japonés',
                'fr-FR' => 'japonais',
                'it-IT' => 'giapponése',
                'ja-JP' => '日本語',
                'ru-RU' => 'японский',
                'ko-KR' => '일본어',
                'vi-VN' => 'tiếng Nhật',
                'zh-CN' => '日语',
                'zh-TW' => '日語',
            ],
            'ru-RU' => [
                'de-DE' => 'Koreanisch',
                'el-GR' => 'Κορεατικά',
                'en-US' => 'Korean',
                'es-ES' => 'coreano',
                'fr-FR' => 'coréen',
                'it-IT' => 'coreano',
                'ja-JP' => '韓國語',
                'ru-RU' => 'корейский',
                'ko-KR' => '한국어',
                'vi-VN' => 'tiếng Hàn Quốc',
                'zh-CN' => '韩国语',
                'zh-TW' => '韓國語',
            ],
            'ko-KR' => [
                'de-DE' => 'Russisch',
                'el-GR' => 'Ρωσικά',
                'en-US' => 'Russian',
                'es-ES' => 'ruso',
                'fr-FR' => 'russe',
                'it-IT' => 'rùsso',
                'ja-JP' => 'ロシア語',
                'ru-RU' => 'русский',
                'ko-KR' => '러시아어',
                'vi-VN' => 'tiếng Nga',
                'zh-CN' => '俄国语',
                'zh-TW' => '俄語',
            ],
            'vi-VN' => [
                'de-DE' => 'Vietnamesisch',
                'el-GR' => 'βιετναμέζικα',
                'en-US' => 'Vietnamese',
                'es-ES' => 'vietnamita',
                'fr-FR' => 'vietnamien',
                'it-IT' => 'vietnamita',
                'ja-JP' => 'ベトナム語',
                'ru-RU' => 'вьетнамский',
                'ko-KR' => '베트남어',
                'vi-VN' => 'tiếng Việt',
                'zh-CN' => '越南语',
                'zh-TW' => '越南語',
            ],
            'zh-CN' => [
                'de-DE' => 'Chinesisch (vereinfacht)',
                'el-GR' => 'κινέζικα (απλοποιημένα)',
                'en-US' => 'Chinese (Simplified)',
                'es-ES' => 'chino (simplificado)',
                'fr-FR' => 'Chinois (simplifié)',
                'it-IT' => 'cinése (semplicità)',
                'ja-JP' => '中国語 (簡体字)',
                'ru-RU' => 'Китайский (упрощенный)',
                'ko-KR' => '중국어(간체자)',
                'vi-VN' => 'tiếng Trung Quốc (giản thể)',
                'zh-CN' => '简体中文',
                'zh-TW' => '簡體中文',
            ],
            'zh-TW' => [
                'de-DE' => 'Chinesisch (Traditionelles)',
                'el-GR' => 'κινέζικα (Παραδοσιακά)',
                'en-US' => 'Chinese (Traditional)',
                'es-ES' => 'chino (tradicional)',
                'fr-FR' => 'Chinois (traditionnelle)',
                'it-IT' => 'cinése (tradizione)',
                'ja-JP' => '中国語 (繁体字)',
                'ru-RU' => 'Китайский (традиционный)',
                'ko-KR' => '중국어(번체자)',
                'vi-VN' => 'tiếng Trung Quốc (phồn thể)',
                'zh-CN' => '传统中文',
                'zh-TW' => '繁体中文',
            ],
        ];

        $character = [
            'en-US' => 'character',
            'ja-JP' => '性格',
            'ko-KR' => '성격',
        ];

        $careers = [
            'table' => [
                'en-US' => 'table',
                'ja-JP' => '目録',
                'ko-KR' => '목록',
            ],
            'section' => [
                'en-US' => 'section',
                'ja-JP' => 'セクション',
                'ko-KR' => '대분류',
            ],
            'division' => [
                'en-US' => 'division',
                'ja-JP' => 'ディビジョン',
                'ko-KR' => '중분류',
            ],
            'group' => [
                'en-US' => 'group',
                'ja-JP' => 'グループ',
                'ko-KR' => '소분류',
            ],
            'class' => [
                'en-US' => 'class',
                'ja-JP' => 'クラス',
                'ko-KR' => '세분류',
            ],
            'sub_class' => [
                'en-US' => 'sub_class',
                'ja-JP' => 'サブクラス',
                'ko-KR' => '세세분류',
            ],
        ];

        $body = [
            'slim' => [
                'en-US' => 'slim',
                'ja-JP' => 'スリム',
                'ko-KR' => '마른 편',
            ],
            'little_slim' => [
                'en-US' => 'a little slim',
                'ja-JP' => '少しスリム',
                'ko-KR' => '조금 마른 편',
            ],
            'normal' => [
                'en-US' => 'normal',
                'ja-JP' => '平凡な',
                'ko-KR' => '평범한 편',
            ],
            'muscular' => [
                'en-US' => 'muscular',
                'ja-JP' => '筋肉質な',
                'ko-KR' => '근육질인 편',
            ],
            'little_plump' => [
                'en-US' => 'a little plump',
                'ja-JP' => '少しぽっちゃり',
                'ko-KR' => '조금 통통한 편',
            ],
            'plump' => [
                'en-US' => 'plump',
                'ja-JP' => 'ぽっちゃり',
                'ko-KR' => '통통한 편',
            ],
        ];

        $ageRange = [
            'min' => [
                'en-US' => 'more than %',
                'ja-JP' => '% 以上',
                'ko-KR' => '% 이상',
            ],
            'max' => [
                'en-US' => 'less than %',
                'ja-JP' => '% 以下',
                'ko-KR' => '% 이하',
            ],
        ];

        $appearance = [
            'en-US' => 'appearance',
            'ja-JP' => '外貌',
            'ko-KR' => '외모',
        ];

        $blood = [
            'A' => [
                'en-US' => 'A type',
                'ja-JP' => 'A 型',
                'ko-KR' => 'A 형',
            ],
            'B' => [
                'en-US' => 'B type',
                'ja-JP' => 'B 型',
                'ko-KR' => 'B 형',
            ],
            'O' => [
                'en-US' => 'O type',
                'ja-JP' => 'O 型',
                'ko-KR' => 'O 형',
            ],
            'AB' => [
                'en-US' => 'AB type',
                'ja-JP' => 'AB 型',
                'ko-KR' => 'AB 형',
            ],
        ];

        $drink = [
            'can_not_drink' => [
                'en-US' => 'can\'t Drink',
                'ja-JP' => '飲めない',
                'ko-KR' => '못 마신다',
            ],
            'do_not_drink' => [
                'en-US' => 'do not drink',
                'ja-JP' => '飲まない',
                'ko-KR' => '마시지 않는다.',
            ],
            'drink_occasionally' => [
                'en-US' => 'drink occasionally',
                'ja-JP' => '時折飲む',
                'ko-KR' => '가끔 마신다.',
            ],
            'drink_a_little_frequently' => [
                'en-US' => 'drink a little frequently',
                'ja-JP' => 'よく少し飲む',
                'ko-KR' => '자주 조금씩 마신다.',
            ],
            'drink_a_lot_frequently' => [
                'en-US' => 'drink a lot frequently',
                'ja-JP' => 'よくたくさん飲む',
                'ko-KR' => '자주 많이 마신다.',
            ],
        ];

        $languageCodes = [
            'en-US' => 'hobby',
            'ja-JP' => '趣味',
            'ko-KR' => '취미',
        ];

        $localizables = [
            'en-US' => [
                'ideal_type' => 'ideal type',
            ],
            'ja-JP' => [
                'ideal_type' => '理想型',
            ],
            'ko-KR' => [
                'ideal_type' => '이상형',
            ],
        ];
    }
}
