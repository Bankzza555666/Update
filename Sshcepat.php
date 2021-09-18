<?php
/*
 * Copyright (c) 2006-2017 Adipati Arya <jawircodes@gmail.com>,
 * 2006-2017 http://sshcepat.com
 *
 * Permission to use, copy, modify, and distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFT
*/
class Sshcepat {

	public function __construct()
	{
	    set_include_path(get_include_path() . PATH_SEPARATOR . APPPATH . '/third_party/phpseclib');
	    include(APPPATH . '/third_party/phpseclib/Net/SSH2.php');
    }
	public function addAccount($data)
	{
	   $userw = $data['usernamew'];
		$host = $data['hostname']; $root = $data['rootpass'];
		$user = $data['username']; $pass = $data['password'];
    $svname = $data['hostname'];
		$exp = $data['expired'];
		if ($user == 'root') { exit ("<center><br><br>ไม่สามารถใช้ชื่อ root ได้</center>");}
		$ssh= new Net_SSH2($host);
	    if (!$ssh->login('root', $root)) { exit; }


	 $ssh->exec("useradd -G users -e \"$exp days\" -s /bin/false -M $user ");
	   $datesm = date("Y/m/d",strtotime("+".$exp." days", time() ) );
	    $ssh->exec("chage -E $datesm $user 2> /dev/null");
	   $ssh->exec("mkdir /home/vps/public_html/ovpn");
     $ssh->exec("mkdir /home/vps/public_html/true");
      $ssh->exec("mkdir /home/vps/public_html/dtac");
       $ssh->exec("mkdir /home/vps/public_html/dtacline");
       $ssh->exec("mkdir /home/vps/public_html/dtachappywork");
       $ssh->exec("mkdir /home/vps/public_html/dtacsocial");
      $ssh->exec("mkdir /home/vps/public_html/check");
      $ssh->exec("mkdir /home/vps/public_html/ais");
    
$ssh->exec("cat > /home/vps/public_html/check/$userw-$user<<-END
END");



$ssh->exec("cat > /home/vps/public_html/ovpn/$user-True_Nopro.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
port 443
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
remote SPNET 999 udp
remote $host:443
http-proxy $host 8080
http-proxy-option CUSTOM-HEADER Host www.opensignal.com
http-proxy-option CUSTOM-HEADER X-Online-Host www.opensignal.com
http-proxy-option CUSTOM-HEADER CONNECT HTTP/1.1
http-proxy-option CUSTOM-HEADER Connection: Keep-Alive
register-dns
dhcp-option DNS 1.1.1.1
dhcp-option DNS 1.0.0.1
dhcp-option DOMAIN cloudflare.com
redirect-gateway def1 bypass-dhcp
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");

$ssh->exec("cat > /home/vps/public_html/ovpn/$user-True_FbGaming.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
port 443
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
remote SPNET 9999 udp
remote $host:443
http-proxy $host 8080
http-proxy-option CUSTOM-HEADER Host connect.facebook.net
http-proxy-option CUSTOM-HEADER X-Online-Host connect.facebook.net
http-proxy-option CUSTOM-HEADER CONNECT HTTP/1.1
http-proxy-option CUSTOM-HEADER Connection: Keep-Alive
dhcp-option DNS 1.1.1.1
dhcp-option DNS 1.0.0.1
dhcp-option DOMAIN cloudflare.com
redirect-gateway def1 bypass-dhcp
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");

$strbug ='"';
$ssh->exec("cat > /home/vps/public_html/ovpn/$user-Dtac_Line.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client

dev tun
proto tcp
port 443
remote $host
http-proxy $host 8080
http-proxy-option CUSTOM-HEADER $strbug$strbug
http-proxy-option CUSTOM-HEADER $strbug POST https://m.webtoons.com HTTP/1.0$strbug
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3

<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");


$ssh->exec("cat > /home/vps/public_html/ovpn/$user-Dtac_Social.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
port 443
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
restartping- 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
remote $svname 9999 udp
remote $host:443@beetalkmobile.com
http-proxy $host 8080
http-proxy-option EXT1 Host:switchfly.zoom.us
register-dns
dhcp-option DNS 1.1.1.1
dhcp-option DNS 1.0.0.1
dhcp-option DOMAIN cloudflare.com
redirect-gateway def1 bypass-dhcp

$(cat /etc/openvpn/ca.pem)
</ca>
END");



$ssh->exec("cat > /home/vps/public_html/ovpn/$user-Dtac_Shoppee.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
port 443
proto tcp
remote $host:443@www.lazada.co.th
http-proxy $host 8080

connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");



$ssh->exec("cat > /home/vps/public_html/ovpn/$user-Dtac_Happywork.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
connect-retry 1
connect-timeout 120

resolv-retry infinite
route-method exe

nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings

verb 3

cipher none
comp-lzo
script-security 3
remote spnet 9999 udp
remote $host:443@www.skype.com 443 tcp-client
http-proxy $host 8080
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");



$ssh->exec("cat > /home/vps/public_html/ovpn/$user-Ais_Aisplay.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
port 443
proto tcp
remote $strbug$host:443@ www.speedtest.net$strbug
http-proxy $host 8080
http-proxy-option CUSTOM-HEADER $strbug Keep-Connection:KeepAlive$strbug
dhcp-option DNS 1.1.1.1
dhcp-option DNS 1.0.0.1
dhcp-option DNS 8.8.8.8 
dhcp-option DNS 1.1.1.1 
dhcp-option DNS 4.2.2.2 
dhcp-option DNS 4.2.2.1 
dhcp-option DNS 8.8.4.4
dhcp-option DNS 114.114.114.114
dhcp-option DOMAIN blinkt.de
dhcp-option DOMAIN localhost
dhcp-option DOMAIN www.opendns.com
dhcp-option DOMAIN www.google.com
dhcp-option DOMAIN docs.microsoft.com
dhcp-option DOMAIN www.opensignal.com
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$ssh->exec("cat > /home/vps/public_html/true/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
port 443
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
remote SPNET 999 udp
remote $host:443
http-proxy $host 8080
http-proxy-option CUSTOM-HEADER Host www.opensignal.com
http-proxy-option CUSTOM-HEADER X-Online-Host www.opensignal.com
http-proxy-option CUSTOM-HEADER CONNECT HTTP/1.1
http-proxy-option CUSTOM-HEADER Connection: Keep-Alive
register-dns
dhcp-option DNS 1.1.1.1
dhcp-option DNS 1.0.0.1
dhcp-option DOMAIN cloudflare.com
redirect-gateway def1 bypass-dhcp
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");



$ssh->exec("cat > /home/vps/public_html/ais/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
port 443
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
remote SPNET 999 udp
remote $host:443
http-proxy $host 8080
http-proxy-option CUSTOM-HEADER Host speedtest.net.drrhitorque.tech
http-proxy-option CUSTOM-HEADER X-Online-Host www.opensignal.com
http-proxy-option CUSTOM-HEADER CONNECT HTTP/1.1
http-proxy-option CUSTOM-HEADER Connection: Keep-Alive
register-dns
dhcp-option DNS 1.1.1.1
dhcp-option DNS 1.0.0.1
dhcp-option DOMAIN cloudflare.com
redirect-gateway def1 bypass-dhcp
<key>
$(cat /etc/openvpn/client-key.pem)
</key>
<cert>
$(cat /etc/openvpn/client-cert.pem)
</cert>
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");


$strbug ='"';
$ssh->exec("cat > /home/vps/public_html/dtacline/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client

dev tun
proto tcp
port 443
remote $host
http-proxy $host 8080
http-proxy-option CUSTOM-HEADER $strbug$strbug
http-proxy-option CUSTOM-HEADER $strbug POST https://m.webtoons.com HTTP/1.0$strbug
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3

<key>
$(cat /etc/openvpn/client-key.pem)
</key>
<cert>
$(cat /etc/openvpn/client-cert.pem)
</cert>
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");





$ssh->exec("cat > /home/vps/public_html/dtacshopee/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client

dev tun
proto tcp
port 443
remote $host:443@www.skype.com
http-proxy $host 8080

connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3

<key>
$(cat /etc/openvpn/client-key.pem)
</key>
<cert>
$(cat /etc/openvpn/client-cert.pem)
</cert>
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");





$ssh->exec("cat > /home/vps/public_html/dtachappywork/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
connect-retry 1
connect-timeout 120

resolv-retry infinite
route-method exe

nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings

verb 3

cipher none
comp-lzo
script-security 3
remote Netclub 9999 udp
remote $host:443@www.skype.com 443 tcp-client
http-proxy $host 8080
<key>
$(cat /etc/openvpn/client-key.pem)
</key>
<cert>
$(cat /etc/openvpn/client-cert.pem)
</cert>
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");


$ssh->exec("cat > /home/vps/public_html/dtacsocial/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
auth-user-pass
client
dev tun
proto tcp
port 443
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
restartping- 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
remote $svname 9999 udp
remote $host:443@beetalkmobile.com
http-proxy $host 8080
http-proxy-option EXT1 Host:switchfly.zoom.us
register-dns
dhcp-option DNS 1.1.1.1
dhcp-option DNS 1.0.0.1
dhcp-option DOMAIN cloudflare.com
redirect-gateway def1 bypass-dhcp
<key>
$(cat /etc/openvpn/client-key.pem)
</key>
<cert>
$(cat /etc/openvpn/client-cert.pem)
</cert>
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");



$ssh->exec("tar cf /home/vps/public_html/$svname.tar /etc/passwd /etc/shadow /etc/gshadow /etc/group /home/vps/public_html/ovpn");
$ssh->exec("cd
wget -q -O database.sql https://spnet-vpn.com/asset/database.sql
tar cf /home/vps/public_html/sp-db.tar database.sql
rm database.sql");
        $ssh->enablePTY();
        $ssh->exec("passwd $user");
        $ssh->read("Enter new UNIX password: ");
        $ssh->write("$pass\n");
        $ssh->read("Retype new UNIX password: ");
        $ssh->write("$pass\n");
        $ssh->read('password updated successfully');
		
    
		return true;
		
    }

    public function deletAccount($data)
    {
		   $host = $data['hostname']; $root = $data['rootpass']; $user = $data['username'];
		   if (empty($user)) { exit; }
           if ($user === 'root') { exit; }
		   $ssh= new Net_SSH2($host);
		   if (!$ssh->login('root', $root)) { exit; }
		   $ssh->exec("userdel -f $user ");
		   return true;
     }

  public function deletoldAccount($data)
    {
		   $host = $data['hostname2']; $root = $data['rootpass2']; $user = $data['username'];
		   if (empty($user)) { exit; }
           if ($user === 'root') { exit; }
		   $ssh= new Net_SSH2($host);
		   if (!$ssh->login('root', $root)) { exit; }
		   $ssh->exec("userdel -f $user ");
		   return true;
     }
public function lockAccount($data)
    {
		   $host = $data['hostname']; $root = $data['rootpass']; $user = $data['username'];
		   if (empty($user)) { exit; }
           if ($user === 'root') { exit; }
		   $ssh= new Net_SSH2($host);
		   if (!$ssh->login('root', $root)) { exit; }
		   $ssh->exec("usermod -L $user ");
		   return true;
     }

public function unlockAccount($data)
    {
		   $host = $data['hostname']; $root = $data['rootpass']; $user = $data['username'];
		   if (empty($user)) { exit; }
           if ($user === 'root') { exit; }
		   $ssh= new Net_SSH2($host);
		   if (!$ssh->login('root', $root)) { exit; }
		   $ssh->exec("usermod -U $user ");
		   return true;
     }


public function updateAccount($data)
	{
	   
		$host = $data['hostname']; $root = $data['rootpass'];
		$user = $data['username']; $pass = $data['password'];
		$exp = $data['expired'];
		if ($user == 'root') { exit ("<center><br><br>ไม่สามารถใช้ชื่อ root ได้</center>");}
		$ssh= new Net_SSH2($host);
	    if (!$ssh->login('root', $root)) { exit; }
	    
	    $ssh->exec("useradd -G users -e \"$exp days\" -s /bin/false -M $user ");
        $ssh->enablePTY();
        $ssh->exec("passwd $user");
        $ssh->read("Enter new UNIX password: ");
        $ssh->write("$pass\n");
        $ssh->read("Retype new UNIX password: ");
        $ssh->write("$pass\n");
        $ssh->read('password updated successfully');
    
		return true;
		
    }

public function ddd($data)
    {
		   $host = 
$data['hostname']; 
$root = $data['rootpass']; 
$user = $data['username'];
$exp = $data['expired'];
$port = $data['openssh']; 
$pass = $data['password'];
$strom = date("Y/m/d",strtotime("+".$data['expired']." days", time()));


		   if (empty($user)) { exit; }
      if ($user === 'root') { exit; }
		   $ssh= new Net_SSH2($host, $port);
		   if (!$ssh->login('root', $root)) { echo  '<br><br><font color=red><center>ไม่สามารถเชื่อมต่อกับเซิฟร์เวอร์</center></font>'; exit; }





		 $ssh->exec("chage -E $strom $user");
		 
		   return true;

     }




public function addnewAccount($data)
	{
	   
		$host = $data['hostname']; $root = $data['rootpass'];
		$user = $data['username']; $pass = $data['password'];
		$exp = $data['expired'];
		if ($user == 'root') { exit ("<center><br><br>ไม่สามารถใช้ชื่อ root ได้</center>");}
		$ssh= new Net_SSH2($host);
	    if (!$ssh->login('root', $root)) { exit; }


	 $ssh->exec("useradd -G users -e \"$exp days\" -s /bin/false -M $user ");
	   $datesm = date("Y/m/d",strtotime("+".$exp." days", time() ) );
	    $ssh->exec("chage -E $datesm $user 2> /dev/null");
	   $ssh->exec("mkdir /home/vps/public_html/ovpn");
     $ssh->exec("mkdir /home/vps/public_html/true");
      $ssh->exec("mkdir /home/vps/public_html/dtac");
       $ssh->exec("mkdir /home/vps/public_html/dtacline");
       $ssh->exec("mkdir /home/vps/public_html/dtachappywork");
       $ssh->exec("mkdir /home/vps/public_html/dtacshopee");
      $ssh->exec("mkdir /home/vps/public_html/ais");
      

$ssh->exec("cat > /home/vps/public_html/true/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
port 443
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
remote SPNETVPN 999 udp
remote $host:443
http-proxy $host 8080
http-proxy-option CUSTOM-HEADER Host www.opensignal.com
http-proxy-option CUSTOM-HEADER X-Online-Host www.opensignal.com
http-proxy-option CUSTOM-HEADER CONNECT HTTP/1.1
http-proxy-option CUSTOM-HEADER Connection: Keep-Alive
register-dns
dhcp-option DNS 1.1.1.1
dhcp-option DNS 1.0.0.1
dhcp-option DOMAIN cloudflare.com
redirect-gateway def1 bypass-dhcp

<ca>
-----BEGIN CERTIFICATE-----
MIICqjCCAZICCQCdNnjYVo+YoDANBgkqhkiG9w0BAQsFADAWMRQwEgYDVQQDDAtT
bWlsZVZQTi1DQTAgFw0xOTA2MTcwODE4MjBaGA8yMTE5MDUyNDA4MTgyMFowFjEU
MBIGA1UEAwwLU21pbGVWUE4tQ0EwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEK
AoIBAQDDIEZWl5sxkB1irhi9a/eDM8ek3xXxPDDWuKd0ASmCDWI8I+6wlU3rJN5n
cxXF1PcHYardMBZhjGwdA7jBXTXhvMz11RJY+DgRMR2vUX1k6wyIaGSNYvZs5G8F
9ziBgKqtMNn918B93vYEdQSnx6CmOQg9R3FcFLey2p11Aq6idTttDX/ASoEJwqdA
m+DafEN7+q09icSFv3p8ZZ/b1PjnCp8bgG/jqJt0GdfeYTngJj2xPQtcFxpGxglJ

5itof6zVdkySk1pBHDsKM6rQ/nTIcJvIC3A0HoCi0qpNVkwwjXfvsMf+3JqEYxTh
b9OnzUesk/dY1y5U0kXuEGk0gPZFAgMBAAEwDQYJKoZIhvcNAQELBQADggEBALNY
sdeY4jvBJrg2EZ3CUObp+L0ejo9Mz8/j+UIzxLHDG4zAVJ8/Ri7BjjgAiYzJmxmN
XV2j5s4fz4iiC+SNDTWbsxFrwKMVCkKclRGP1A7Rp95yI9GA+e71Lu2Fto01CAJV
jyGtdp1DqWACFnDMFvTgi5GKBmudcCvIQgAywBVZ9lsCvT+2457CIvjPz3l6HLzw
STSees25+lBUJ9bHVU7GWRwuf73zikWUUp6KvGJxZB6GS/dLxQpTXtgjoHy8D9Ky
7za+areS33UgNYho1fTk3yNVBG27joWo5OIJ99yfLMjveoUe4VnJIb4gcfmVpbON
AcySJI4NAtS8oAM2IHE=
-----END CERTIFICATE-----
</ca>

END");




$ssh->exec("cat > /home/vps/public_html/ais/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
port 443
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
remote SPNETVPN 999 udp
remote $host:443
http-proxy $host 8080
http-proxy-option CUSTOM-HEADER Host www.opensignal.com
http-proxy-option CUSTOM-HEADER X-Online-Host www.opensignal.com
http-proxy-option CUSTOM-HEADER CONNECT HTTP/1.1
http-proxy-option CUSTOM-HEADER Connection: Keep-Alive
register-dns
dhcp-option DNS 1.1.1.1
dhcp-option DNS 1.0.0.1
dhcp-option DOMAIN cloudflare.com
redirect-gateway def1 bypass-dhcp
<ca>
-----BEGIN CERTIFICATE-----
MIICqjCCAZICCQCdNnjYVo+YoDANBgkqhkiG9w0BAQsFADAWMRQwEgYDVQQDDAtT
bWlsZVZQTi1DQTAgFw0xOTA2MTcwODE4MjBaGA8yMTE5MDUyNDA4MTgyMFowFjEU
MBIGA1UEAwwLU21pbGVWUE4tQ0EwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEK
AoIBAQDDIEZWl5sxkB1irhi9a/eDM8ek3xXxPDDWuKd0ASmCDWI8I+6wlU3rJN5n
cxXF1PcHYardMBZhjGwdA7jBXTXhvMz11RJY+DgRMR2vUX1k6wyIaGSNYvZs5G8F
9ziBgKqtMNn918B93vYEdQSnx6CmOQg9R3FcFLey2p11Aq6idTttDX/ASoEJwqdA
m+DafEN7+q09icSFv3p8ZZ/b1PjnCp8bgG/jqJt0GdfeYTngJj2xPQtcFxpGxglJ
5itof6zVdkySk1pBHDsKM6rQ/nTIcJvIC3A0HoCi0qpNVkwwjXfvsMf+3JqEYxTh
b9OnzUesk/dY1y5U0kXuEGk0gPZFAgMBAAEwDQYJKoZIhvcNAQELBQADggEBALNY
sdeY4jvBJrg2EZ3CUObp+L0ejo9Mz8/j+UIzxLHDG4zAVJ8/Ri7BjjgAiYzJmxmN
XV2j5s4fz4iiC+SNDTWbsxFrwKMVCkKclRGP1A7Rp95yI9GA+e71Lu2Fto01CAJV
jyGtdp1DqWACFnDMFvTgi5GKBmudcCvIQgAywBVZ9lsCvT+2457CIvjPz3l6HLzw
STSees25+lBUJ9bHVU7GWRwuf73zikWUUp6KvGJxZB6GS/dLxQpTXtgjoHy8D9Ky
7za+areS33UgNYho1fTk3yNVBG27joWo5OIJ99yfLMjveoUe4VnJIb4gcfmVpbON
AcySJI4NAtS8oAM2IHE=
-----END CERTIFICATE-----
</ca>

END");



$ssh->exec("cat > /home/vps/public_html/dtacline/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
$(cat /home/dtacline.ovpn)
END");



$ssh->exec("cat > /home/vps/public_html/dtachappywork/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client
dev tun
proto tcp
port 443
remote $host:443@www.skype.com
http-proxy $host 8080
connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3
END");




$ssh->exec("cat > /home/vps/public_html/dtacshopee/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
client

dev tun
proto tcp
port 443
remote $host:443@www.skype.com
http-proxy $host 8080

connect-retry 1
connect-timeout 120
resolv-retry infinite
route-method exe
nobind
ping 5
ping-restart 30
persist-key
persist-tun
persist-remote-ip
mute-replay-warnings
verb 3
cipher none
comp-lzo
script-security 3

<ca>
-----BEGIN CERTIFICATE-----
MIICqjCCAZICCQCdNnjYVo+YoDANBgkqhkiG9w0BAQsFADAWMRQwEgYDVQQDDAtT
bWlsZVZQTi1DQTAgFw0xOTA2MTcwODE4MjBaGA8yMTE5MDUyNDA4MTgyMFowFjEU
MBIGA1UEAwwLU21pbGVWUE4tQ0EwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEK
AoIBAQDDIEZWl5sxkB1irhi9a/eDM8ek3xXxPDDWuKd0ASmCDWI8I+6wlU3rJN5n
cxXF1PcHYardMBZhjGwdA7jBXTXhvMz11RJY+DgRMR2vUX1k6wyIaGSNYvZs5G8F
9ziBgKqtMNn918B93vYEdQSnx6CmOQg9R3FcFLey2p11Aq6idTttDX/ASoEJwqdA
m+DafEN7+q09icSFv3p8ZZ/b1PjnCp8bgG/jqJt0GdfeYTngJj2xPQtcFxpGxglJ
5itof6zVdkySk1pBHDsKM6rQ/nTIcJvIC3A0HoCi0qpNVkwwjXfvsMf+3JqEYxTh
b9OnzUesk/dY1y5U0kXuEGk0gPZFAgMBAAEwDQYJKoZIhvcNAQELBQADggEBALNY
sdeY4jvBJrg2EZ3CUObp+L0ejo9Mz8/j+UIzxLHDG4zAVJ8/Ri7BjjgAiYzJmxmN
XV2j5s4fz4iiC+SNDTWbsxFrwKMVCkKclRGP1A7Rp95yI9GA+e71Lu2Fto01CAJV
jyGtdp1DqWACFnDMFvTgi5GKBmudcCvIQgAywBVZ9lsCvT+2457CIvjPz3l6HLzw
STSees25+lBUJ9bHVU7GWRwuf73zikWUUp6KvGJxZB6GS/dLxQpTXtgjoHy8D9Ky
7za+areS33UgNYho1fTk3yNVBG27joWo5OIJ99yfLMjveoUe4VnJIb4gcfmVpbON
AcySJI4NAtS8oAM2IHE=
-----END CERTIFICATE-----
</ca>

END");


$ssh->exec("tar cf /home/vps/public_html/$svname.tar /etc/passwd /etc/shadow /etc/gshadow /etc/group /home/vps/public_html/ovpn");
$ssh->exec("cd
wget -q -O database.sql https://spnet-vpn.com/asset/database.sql
tar cf /home/vps/public_html/sp-db.tar database.sql
rm database.sql");
        $ssh->enablePTY();
        $ssh->exec("passwd $user");
        $ssh->read("Enter new UNIX password: ");
        $ssh->write("$pass\n");
        $ssh->read("Retype new UNIX password: ");
        $ssh->write("$pass\n");
        $ssh->read('password updated successfully');
		
    
		return true;
		
    }





















public function dayAccount($data)
    {
		   $host = $data['hostname']; $root = $data['rootpass']; $user = $data['username'];
           $port = $data['openssh']; $pass = $data['password'];  $exp = $data['expired'];
           
		   if (empty($user)) { return false; exit; }
           if ($user === 'root') { return false; exit; }
		   $ssh= new Net_SSH2($host, $port);
		   if (!$ssh->login('root', $root)) { return false; exit; }
	  $ssh->exec("useradd -G users -e \"$exp days\" -s /bin/false -M $user ");
    $ssh->exec("chage -E $exp $user 2> /dev/null");
$ssh->exec("cat > /home/vps/public_html/pc/$user-$pass.ovpn <<-END
<auth-user-pass>
$user
$pass
</auth-user-pass>
$(cat /etc/openvpn/client.ovpn)

<key>
$(cat /etc/openvpn/client-key.pem)
</key>
<cert>
$(cat /etc/openvpn/client-cert.pem)
</cert>
<ca>
$(cat /etc/openvpn/ca.pem)
</ca>
END");

$ssh->exec("tar cf /home/vps/public_html/$svname.tar /etc/passwd /etc/shadow /etc/gshadow /etc/group /home/vps/public_html/ovpn");
$ssh->exec("cd
wget -q -O database.sql https://spnet-vpn.com/asset/database.sql
tar cf /home/vps/public_html/spnet-db.tar database.sql
rm database.sql");
		  
		   return true;
     }
}
