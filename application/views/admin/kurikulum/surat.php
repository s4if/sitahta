<?php

/* 
 * The MIT License
 *
 * Copyright 2015 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

$arr_surat = [
    1 => 'Al Fatihah',
    2 => 'Al Baqarah',
    3 => 'Ali \'Imran',
    4 => 'An Nisa\'',
    5 => 'Al Ma\'idah',
    6 => 'Al An\'am',
    7 => 'Al A\'raf',
    8 => 'Al Anfal',
    9 => 'At Taubah',
    10 => 'Yunus',
    11 => 'Hud',
    12 => 'Yusuf',
    13 => 'Ar Ra\'d',
    14 => 'Ibrahim',
    15 => 'Al Hijr',
    16 => 'An Nahl',
    17 => 'Al Isra\'',
    18 => 'Al Kahf',
    19 => 'Maryam',
    20 => 'Ta Ha',
    21 => 'Al Anbiya',
    22 => 'Al Hajj',
    23 => 'Al Mu\'minun',
    24 => 'An Nur',
    25 => 'Al Furqan',
    26 => 'Asy Syu\'ara\'',
    27 => 'An Naml',
    28 => 'Al Qasas',
    29 => 'Al \'Ankabut',
    30 => 'Ar Rum',
    31 => 'Luqman',
    32 => 'As Sajdah',
    33 => 'Al Ahzab',
    34 => "Saba\'",
    35 => 'Al Fatir',
    36 => 'Ya Sin',
    37 => 'As Saffat',
    38 => 'Sad',
    39 => 'Az Zumar',
    40 => 'Al Mu\'min',
    41 => 'Fussilat',
    42 => 'Asy Syura',
    43 => 'Az Zukhruf',
    44 => 'Ad Dukhan',
    45 => 'Al Jasiyah',
    46 => 'Al Ahqaf',
    47 => 'Muhammad',
    48 => 'Al Fath',
    49 => 'Al Hujurat',
    50 => 'Qaf',
    51 => 'Az Zariyat',
    52 => 'At Tur',
    53 => 'An Najm',
    54 => 'Al Qamar',
    55 => 'Ar Rahman',
    56 => 'Al Waqi\'ah',
    57 => 'Al Hadid',
    58 => 'Al Mujadilah',
    59 => 'Al Hasyr',
    60 => 'Al Mumtahanah',
    61 => 'As Saff',
    62 => 'Al Jumu\'ah',
    63 => 'Al Munafiqun',
    64 => 'At Tagabun',
    65 => 'At Talaq',
    66 => 'At Tahrim',
    67 => 'Al Mulk',
    68 => 'Al Qalam',
    69 => 'Al Haqqah',
    70 => 'Al Ma\'arij',
    71 => 'Nuh',
    72 => 'Al Jinn',
    73 => 'Al Muzammil',
    74 => 'Al Muddassir',
    75 => 'Al Qiyamah',
    76 => 'Al Insan',
    77 => 'Al Mursalat',
    78 => 'An Naba\'',
    79 => 'An Nazi\'at',
    80 => '\'Abasa',
    81 => 'At Takwir',
    82 => 'Al Infitar',
    83 => 'Al Mutaffifin',
    84 => 'Al Insyiqaq',
    85 => 'Al Buruj',
    86 => 'At Tariq',
    87 => 'Al A\'la',
    88 => 'Al Ghasyiyah',
    89 => 'Al Fajr',
    90 => 'Al Balad',
    91 => 'Asy Syams',
    92 => 'Al Lail',
    93 => 'Ad Duha',
    94 => 'Al Insyirah',
    95 => 'At Tin',
    96 => 'Al \'Alaq',
    97 => 'Al Qadr',
    98 => 'Al Bayyinah',
    99 => 'Al Zalzalah',
    100 => 'Al \'Adiyat',
    101 => 'Al Qari\'ah',
    102 => 'At Takasur',
    103 => 'Al \'Asr',
    104 => 'Al Humazah',
    105 => 'Al Fil',
    106 => 'Quraisy',
    107 => 'Al Ma\'un',
    108 => 'Al Kautsar',
    109 => 'Al Kafirun',
    110 => 'An Nasr',
    111 => 'Al Lahab',
    112 => 'Al Ikhlas',
    113 => 'Al Falaq',
    114 => 'An Nas'
];


// Zelectnya belum siap
?>
<?php if ($pos == 'awaluw'):?>
<style>
    #intro .zelect {
      display: inline-block;
      background-color: white;
      min-width: 300px;
      cursor: pointer;
      line-height: 36px;
      border: 1px solid #dbdece;
      border-radius: 6px;
      position: relative;
    }
    #intro .zelected {
      font-weight: bold;
      padding-left: 10px;
    }
    #intro .zelected.placeholder {
      color: #999f82;
    }
    #intro .zelected:hover {
      border-color: #c0c4ab;
      box-shadow: inset 0px 5px 8px -6px #dbdece;
    }
    #intro .zelect.open {
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }
    #intro .dropdown {
      background-color: white;
      border-bottom-left-radius: 5px;
      border-bottom-right-radius: 5px;
      border: 1px solid #dbdece;
      border-top: none;
      position: absolute;
      left:-1px;
      right:-1px;
      top: 36px;
      z-index: 2;
      padding: 3px 5px 3px 3px;
    }
    #intro .dropdown input {
      font-family: sans-serif;
      outline: none;
      font-size: 14px;
      border-radius: 4px;
      border: 1px solid #dbdece;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      width: 100%;
      padding: 7px 0 7px 10px;
    }
    #intro .dropdown ol {
      padding: 0;
      margin: 3px 0 0 0;
      list-style-type: none;
      max-height: 150px;
      overflow-y: scroll;
    }
    #intro .dropdown li {
      padding-left: 10px;
    }
    #intro .dropdown li.current {
      background-color: #e9ebe1;
    }
</style>
<?php endif;?>

<select id="combo_<?=$pos?>" class="form-control" name="surat_<?=$pos?>">
<?php foreach ($arr_surat as $surat) :?>
<option value="<?=$surat?>"><?=$surat?></option>
<?php endforeach;?>
</select>

<?php if ($pos == 'awaluw'):?>
<!-- zelect Js -->
<script src="<?=  base_url() ?>assets/js/zelect.js"></script>
<?php endif;?>

<!--<script type="text/javascript">
    $('#combo_<? =$pos?>').zelect();
</script>-->