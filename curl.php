<?php

 permintaan fungsi ( $ url , $ token = null , $ data = null , $ pin = null ){
$ header [] = "Host: app.oneaset.com" ;
$ header [] = "User-Agent: okhttp/3.10.0" ;
$ header [] = "Terima: aplikasi/json" ;
$ header [] = "Bahasa Terima: en-ID" ;
$ header [] = "Jenis Konten: application/json; charset=UTF-8" ;
$ header [] = "Versi X-App: 3.30.2" ;
$ header [] = "X-UniqueId: " . waktu (). "57" . mt_rand ( 1000 , 9999 );
$ header [] = "Koneksi: tetap hidup" ;
$ header [] = "Lokal Pengguna-X: en_ID" ;
$ header [] = "Lokasi X: -6.246265,106.690718" ;
$ header [] = "X-Location-Accuracy: 3.0" ;
jika ( $ pin ):
$ header [] = "pin: $pin" ;
    endif ;
jika ( $ token ):
$ header [] = "Otorisasi: Pembawa $token" ;
endif ;
$ c = curl_init ( "https://app.oneaset.com" . $ url );
    curl_setopt ( $ c , CURLOPT_FOLLOWLOCATION , benar );
    curl_setopt ( $ c , CURLOPT_SSL_VERIFYPEER , salah );
    jika ( $ data ):
    curl_setopt ( $ c , CURLOPT_POSTFIELDS , $ data );
    curl_setopt ( $ c , CURLOPT_POST , benar );
    endif ;
    curl_setopt ( $ c , CURLOPT_SSL_VERIFYHOST , 0 );
    curl_setopt ( $ c , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt ( $ c , CURLOPT_HEADER , benar );
    curl_setopt ( $ c , CURLOPT_HTTPHEADER , $ tajuk );
    $ respons = curl_exec ( $ c );
    $ httpcode = curl_getinfo ( $ c );
    jika (! $ httpcode )
        kembali  salah ;
    lain {
        $ header = substr ( $ respons , 0 , curl_getinfo ( $ c , CURLINFO_HEADER_SIZE ));
        $ body    = substr ( $ respons , curl_getinfo ( $ c , CURLINFO_HEADER_SIZE ));
    }
    $ json = json_decode ( $ body , true );
    kembali  $ json ;
}
fungsi  simpan ( $ nama file , $ konten )
{
    $ simpan = fopen ( $ namafile , "a" );
    fputs ( $ simpan , "$konten\r\n" );
    fclose ( $ simpan );
}

 nama fungsi ()
    {
    $ ch = curl_init ();
    curl_setopt ( $ ch , CURLOPT_URL , "http://ninjaname.horseridersupply.com/indonesian_name.php" );
    curl_setopt ( $ ch , CURLOPT_SSL_VERIFYPEER , 0 );
    curl_setopt ( $ ch , CURLOPT_SSL_VERIFYHOST , 0 );
    curl_setopt ( $ ch , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt ( $ ch , CURLOPT_FOLLOWLOCATION , 1 );
    $ ex = curl_exec ( $ ch );

    preg_match_all ( '~(• (.*?)<br/>• )~' , $ ex , $ name );
    kembalikan  $ nama [ 2 ][ mt_rand ( 0 , 14 ) ];
    }

fungsi  register ( $ tidak )
    {
    $ nama = nama ();
    $ email = str_replace ( " " , "" , $ nama ). mt_rand ( 100 , 999 );
    $ data = '{"email":"' . $ email . '@gmail.com","name":"' . $ nama . '","phone":"+' . $ no . '"," sign_up_country":"ID"}' ;
    $ register = permintaan ( "/v5/pelanggan" , "" ,, $ data );
    if ( $ register [ 'berhasil' ] == 1 )
        {
        kembali  $ register [ 'data' ][ 'otp_token' ];
        }
      lain
        {
      simpan ( "error_log.txt" , json_encode ( $ register ));
        kembali  salah ;
        }
    }

    fungsi  masuk ( $ tidak )
    {

    $ data = '{"telepon":"+' . $ no . '"}' ;
    $ register = permintaan ( "/v4/customers/login_with_phone" , "" ,, $ data );
   
    if ($register['success'] == 1)
        {
        return $register['data']['login_token'];
        }
      else
        {
      save("error_log.txt", json_encode($register));
        return false;
        }
    }

function veriflogin($otp, $token)
    {
    $data = '{"client_name":"oneaset:cons:android","client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e","data":{"otp":"'.$otp.'","otp_token":"'.$token.'"},"grant_type":"otp","scopes":"gojek:customer:transaction gojek:customer:readonly"}';
    $verif = request("/v4/customers/login/verify", "", $data);
    if ($verif['success'] == 1)
        {
        return $verif['data']['access_token'];
        }
      else
        {
      save("error_log.txt", json_encode($verif));
        return false;
        }
    }
function change($no)
{
    $data = '{"email":"' .$email . '","name":"'.$nama.'","phone":"+'.$no.'"}';
    $change = request("/v4/customers" ,"", $data);
    if ($change['success'] == 1) {
        return $change;
    }
    else{
        save("error_log.txt", json_encode($change));
        return false;
    }
}
function verifchange($otp,$uid)
{
    $data = '{"id":'.$uid.',"phone":"+'.$no.'","verificationCode":"'.$otp.'"}';
        $verifchange = request("/v4/customer/verificationUpdateProfil" ,"",$data);
        if ($verifchange['success'] == 1) {
            return $verifchange;
        }
        else{
            save("error_log.txt", json_encode($verifchange));
        return false;
        }
    }
?>
