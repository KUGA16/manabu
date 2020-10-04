<?php
// php artisan で作成したクラス
use App\Enums\CategoryId;
use App\Enums\Laddress;

return [
  CategoryId::class=> [
      CategoryId::PROGRAMMING => 'プログラミング',
      CategoryId::DESIGN => 'デザイン',
      CategoryId::VIDEOPHOTO => '動画・写真',
      CategoryId::ENTERPRENEURSHIPMANAGEMENT => '起業・経営',
      CategoryId::MUSICS => '音楽',
      CategoryId::HOBBY => '趣味',
      CategoryId::TROUBLE => '悩み',
      CategoryId::STUDY => '学習',
      CategoryId::OTHER => 'その他',
    ],

    Laddress::class => [
        Laddress::TOKYO => '東京都',
        Laddress::SAITAMA => '埼玉県',
        Laddress::CHIBA => '千葉県',
        Laddress::KANAGAWA => '神奈川県',
        Laddress::IBARAKI => '茨城県',
        Laddress::GUNMA => '群馬県',
        Laddress::TOCHIGI => '栃木県',
    ],
];