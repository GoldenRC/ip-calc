<?php
$adres="192.168.10.25";
$maska="255.255.255.240";

//przeliczanie na binarny adresu
list($a1, $a2, $a3, $a4) = explode(".", "$adres");
$adr1 = substr("00000000",0,8 - strlen(decbin($a1))) . decbin($a1);
$adr2 = substr("00000000",0,8 - strlen(decbin($a2))) . decbin($a2);
$adr3 = substr("00000000",0,8 - strlen(decbin($a3))) . decbin($a3);
$adr4 = substr("00000000",0,8 - strlen(decbin($a4))) . decbin($a4);
echo ("Adres IP to: ".$adres."<br>"."Adres IP w postaci binarnej to: ".$adr1.$adr2.$adr3.$adr4."<br>");

//przeliczanie na binarny maski
list($m1, $m2, $m3, $m4) = explode(".", "$maska");
$mask1 = substr("00000000",0,8 - strlen(decbin($m1))) . decbin($m1);
$mask2 = substr("00000000",0,8 - strlen(decbin($m2))) . decbin($m2);
$mask3 = substr("00000000",0,8 - strlen(decbin($m3))) . decbin($m3);
$mask4 = substr("00000000",0,8 - strlen(decbin($m4))) . decbin($m4);
echo ("Adres maski to: ".$maska."<br>"."Adres maski w postaci binarnej to: ".$mask1.$mask2.$mask3.$mask4."<br>");


//tablica dla adresu ip
for($i=0;$i<32;$i++)
{   
    $x = substr($adr1.$adr2.$adr3.$adr4, $i,1);
    $tablica_adr[$i] = $x;
}

//tablica dla maski
for($i=0;$i<32;$i++)
{   
    $x = substr($mask1.$mask2.$mask3.$mask4, $i,1);
    $tablica_mask[$i] = $x;
}

//przeliczanie adresu sieci
$siec1=null;
$siec2=null;
$siec3=null;
$siec4=null;

for($i=0;$i<32;$i++)
{   
$tablica_siec[$i]=$tablica_adr[$i]*$tablica_mask[$i];
if($i<8)
{
$siec1=$siec1.$tablica_siec[$i];
}
else if($i>7&&$i<16)
{
$siec2=$siec2.$tablica_siec[$i];   
}
else if($i>15&&$i<24)
{
$siec3=$siec3.$tablica_siec[$i];   
}  
else if($i>23&&$i<32)
{
$siec4=$siec4.$tablica_siec[$i];   
}  
}

$adrsiec=bindec($siec1).".".bindec($siec2).".".bindec($siec3).".".bindec($siec4);
$adrsiecbin=$siec1.$siec2.$siec3.$siec4;

echo ("Adres sieci to: ".$adrsiec."<br>"."Adres sieci w postaci binarnej to: ".$adrsiecbin);
    
//przeliczanie adresu rozgłoszeniowego
$rozgl1=null;
$rozgl2=null;
$rozgl3=null;
$rozgl4=null;

$ile_zer=0;
for($i=0;$i<32;$i++)
{
    if($tablica_mask[$i]<1)
    {
        $ile_zer++;
    }
}

for($i=0;$i<32;$i++)
{  
if($i<(32-$ile_zer))
{
$tablica_rozgl[$i]=$tablica_adr[$i]*$tablica_mask[$i];
}
else
{
$tablica_rozgl[$i]=1;
}
}

for($i=0;$i<32;$i++)
if($i<8)
{
$rozgl1=$rozgl1.$tablica_rozgl[$i];
}
else if($i>7&&$i<16)
{
$rozgl2=$rozgl2.$tablica_rozgl[$i];   
}
else if($i>15&&$i<24)
{
$rozgl3=$rozgl3.$tablica_rozgl[$i];   
}  
else if($i>23&&$i<32)
{
$rozgl4=$rozgl4.$tablica_rozgl[$i];   
}  


$adrrozgl=bindec($rozgl1).".".bindec($rozgl2).".".bindec($rozgl3).".".bindec($rozgl4);
$adrrozglbin=$rozgl1.$rozgl2.$rozgl3.$rozgl4;

echo ("<br>"."Adres rozgłoszeniowy sieci to: ".$adrrozgl."<br>"."Adres sieci w postaci binarnej to: ".$adrrozglbin);

//liczenie hostow
$hosty=0;
for($i=0;$i<($ile_zer-1);$i++)
{
    $tabhosty[$i]="1";
    $hosty=$hosty.$tabhosty[$i];
}

$ilhostow=bindec($hosty);
echo "<br>"."Ilość hostów w sieci: ".($ilhostow*2);

?>