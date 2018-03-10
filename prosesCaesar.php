<?php
/**
 * Created by PhpStorm.
 * User: ano
 * Date: 3/2/18
 * Time: 10:46 AM
 */
//terdapat error karena fungsi belum dipanggil.
if (!empty($_POST['submit'])) {//jika variabel post tidak kosong, maka program dalam if akan di eksekusi
    $kunci = $_POST['key'];
    $teks = $_POST['kata'];
    enkripsicaesar::utama($teks,$kunci);
}
//teks dekripsi masih salah, karena teks awal adalah the, untuk menangani kesalahan ini kita masukkan variabel teks yang sudah terenkripsi ke fungsi dekripsi

class enkripsicaesar
{//membuat kelas enkripsi caesar
    public static function utama($t, $y)
    {//fungsi utama yang akan dipanggi paling awal nantinya
        $enkripsi = self::enkripsi($t, $y);
        $dekripsi = self::dekripsi($enkripsi, $y);
        echo '<h1>Teks Terenkripsi = ' . $enkripsi . '</h1>';
        echo '<h1>Teks Terdekripsi = ' . $dekripsi . '</h1>';
    }

    function ciper($ch, $key)
    {
        if (!ctype_alpha($ch))//mengecek teks yg dimasukkan, apakah karakter atau bukan, kalau bukan, dia akan kembali ke nilai variabel utama
            return $ch;
        $batas = ord(ctype_upper($ch) ? 'A' : 'a');//mengatur variabel batas, ord digunkan untuk convert dari string ke ASCII. dan ctype_upper digunkan untuk mengecek apakah semua karakter berhuruf kapital
        //jika iya, maka string A yang akan dipakai, jika tidak string a yg dipakai.
        return chr(fmod(((ord($ch) + $key) - $batas), 26) + $batas);//chr digunkan untuk convert ASCII ke string kebalikan dri ord. fmod digunakan untuk mencari sisa bagi yng bisa digunkan untuk tipe data float jg
    }

    function enkripsi($input, $key)
    {
        $keluaran = " "; // mengatur keluaran awal dengan string kosong.
        $masukanarr = str_split($input);//str_split memisahkan string menjadi karakter, misalkan aku, menjadi "a","k","u"
        foreach ($masukanarr as $ch) {//masing2 karakter akan dikeluarkan di perulangan ini
            $keluaran .= self::ciper($ch, $key); //memanggil fungsi ciper, yang membawa karakter ch.
        }
        return $keluaran;
    }

    function dekripsi($input, $key)
    {//fungsi ini akan mengembalikan teks yang terenkripsi ke plain teks.
        return self::enkripsi($input, 26 - $key);//memanggil fungsi enkripsi dengan membawa variabel input,
    }

}