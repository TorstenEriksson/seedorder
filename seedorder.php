<?php
$me = $_SERVER['PHP_SELF'];
?><!doctype html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>S&auml;llskapet Tr&auml;dg&aring;rdsamat&ouml;rerna</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href="b3.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
	function validate(thisform){
		with (thisform) {
			if (Medlemsnummer.value == null || Medlemsnummer.value == '') {
				Medlemsnummer.focus();
				alert('Skriv in medlemsnummer');
				return false;
			} else if (Namn.value == null || Namn.value == '') {
				Namn.focus();
				alert('Skriv in namn');
				return false;
			} else if ((Telefon.value == null || Telefon.value == '') && (Epost.value == null || Epost.value == '')) {
				Telefon.focus();
				alert('Skriv in telefonnummer eller epostadress');
				return false;
			} else if ((Val_1.value == null || Val_1.value == '') && (Val_2.value == null || Val_2.value == '') && (Val_3.value == null || Val_3.value == '') && (Val_4.value == null || Val_4.value == '') && (Val_5.value == null || Val_5.value == '') && (Val_6.value == null || Val_6.value == '')) {
				Val_1.focus();
				alert('Skriv in åtminstone ett frönummer!');
				return false;
			} else if (alt_addr.checked == true) {
				if (Gata.value == null || Gata.value == '') {
					Gata.focus();
					alert('Skriv in adress');
					return false;
				} else if (Postnr.value == null || Postnr.value == '') {
					Postnr.focus();
					alert('Skriv in postnummer');
					return false;
				} else if (Ort.value == null || Ort.value == '') {
					Ort.focus();
					alert('Skriv in postort');
					return false;
				}
			} else {
				return true;
			}
		}
	}
	</script>
</head>

<body>
	<div id="sida">
		<!-- SIDANS INNEHÅLL -->
		<div id="innehall">
			<div class="vspalt">
				<div style="margin-bottom:20px;">
					<a href="/index.php"><img src="STA_logotyp_90.png" alt="S&auml;llskapet Tr&auml;dg&aring;rdsamat&ouml;rernas logga" width="90" height="79"></a>
				</div>
				<!-- vänsterspalten -->
				<?php
				if ($_SERVER['REQUEST_METHOD'] != "POST") {
					?>
					<h2>Tr&auml;dg&aring;rdsamat&ouml;rernas fr&ouml;best&auml;llning 2014-2015</h2>
					<h3>Endast f&ouml;r medlemmar</h3>
					<!-- <h3>OBS! Endast efterbest&auml;llningar</h3> -->
					<form action="<?php echo $me; ?>" method="POST" onsubmit="return validate(this);">
						<table border="0" cellpadding="0" cellspacing="2" width="500">
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td colspan="2"><span class="fet">Uppgifter om best&auml;llaren</span></td>
							</tr>
							<tr>
								<td width="50">Medlemsnr:</td>
								<td><input type="text" name="Medlemsnummer" size="5"></td>
							</tr>
							<tr>
								<td width="50">Namn:</td>
								<td><input type="text" name="Namn" size="45"></td>
							</tr>
							<tr>
								<td width="50">Telefon:</td>
								<td><input type="text" name="Telefon" size="15"></td>
							</tr>
							<tr>
								<td width="50">Epost: </td>
								<td><input type="text" name="Epost" size="45"></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td colspan="2">Normalt skickas fr&ouml;erna till adress enligt medlemsregistret.
									Om du vill ha dem till en <span class="notable">ANNAN adress</span>, ange den här nedan.
								</td>
							</tr>
							<tr>
								<td colspan="2"><input name="alt_addr" type="CheckBox" onClick="javascript:if(this.checked==true){document.getElementById('addressgroup').style.display=''}else{document.getElementById('addressgroup').style.display='none'};" name="Annan_adress" size="25"> Annan adress, kryssa i rutan och ange</td>
							</tr>
						</table>
						<div id="addressgroup" style="display:none;">
							<table border="0" cellpadding="0" cellspacing="2" width="500">
								<tr>
									<td width="50">Gata:</td>
									<td><input type="text" name="Gata" size="45"></td>
								</tr>
								<tr>
									<td width="50">Postnr:</td>
									<td><input type="text" name="Postnr" size="6"></td>
								</tr>
								<tr>
									<td width="50">Ort:</td>
									<td><input type="text" name="Ort" size="45"></td>
								</tr>
							</table>
						</div>
						<table>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><input type="CheckBox" name="Auto_fyll" value="ja"> Jag &ouml;nskar automatisk p&aring;fyllning till s&aring; m&aring;nga jag &auml;r ber&auml;ttigad till</td>
							</tr>
						</table>

						<table border="0" cellpadding="0" cellspacing="2" width="500">
							<tr>
								<td width="100">Jag vill max ha:<br><span class="notable">OBS!</span> Endast vid efterbest.</td>
								<td><input type="text" name="Fyll_upp" size="5"> st fr&ouml;p&aring;sar (Ange en siffra 1-100)</td>
							</tr>
						</table>
						<table border="0" cellpadding="0" cellspacing="2" width="700">
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td>
									<span class="fet">Fr&ouml;best&auml;llning</span>
									<span>(Skriv ett fr&ouml;nummer per ruta i angel&auml;genhetsordning)</span>
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="Val_1" size="2">
									<input type="text" name="Val_2" size="2">
									<input type="text" name="Val_3" size="2">
									<input type="text" name="Val_4" size="2">
									<input type="text" name="Val_5" size="2">
									<input type="text" name="Val_6" size="2">
									<input type="text" name="Val_7" size="2">
									<input type="text" name="Val_8" size="2">
									<input type="text" name="Val_9" size="2">
									<input type="text" name="Val_10" size="2">
									<input type="text" name="Val_11" size="2">
									<input type="text" name="Val_12" size="2">&nbsp;&nbsp;12
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="Val_13" size="2">
									<input type="text" name="Val_14" size="2">
									<input type="text" name="Val_15" size="2">
									<input type="text" name="Val_16" size="2">
									<input type="text" name="Val_17" size="2">
									<input type="text" name="Val_18" size="2">
									<input type="text" name="Val_19" size="2">
									<input type="text" name="Val_20" size="2">
									<input type="text" name="Val_21" size="2">
									<input type="text" name="Val_22" size="2">
									<input type="text" name="Val_23" size="2">
									<input type="text" name="Val_24" size="2">&nbsp;&nbsp;24
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="Val_25" size="2">
									<input type="text" name="Val_26" size="2">
									<input type="text" name="Val_27" size="2">
									<input type="text" name="Val_28" size="2">
									<input type="text" name="Val_29" size="2">
									<input type="text" name="Val_30" size="2">
									<input type="text" name="Val_31" size="2">
									<input type="text" name="Val_32" size="2">
									<input type="text" name="Val_33" size="2">
									<input type="text" name="Val_34" size="2">
									<input type="text" name="Val_35" size="2">
									<input type="text" name="Val_36" size="2">&nbsp;&nbsp;36
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="Val_37" size="2">
									<input type="text" name="Val_38" size="2">
									<input type="text" name="Val_39" size="2">
									<input type="text" name="Val_40" size="2">
									<input type="text" name="Val_41" size="2">
									<input type="text" name="Val_42" size="2">
									<input type="text" name="Val_43" size="2">
									<input type="text" name="Val_44" size="2">
									<input type="text" name="Val_45" size="2">
									<input type="text" name="Val_46" size="2">
									<input type="text" name="Val_47" size="2">
									<input type="text" name="Val_48" size="2">&nbsp;&nbsp;48
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="Val_49" size="2">
									<input type="text" name="Val_50" size="2">
									<input type="text" name="Val_51" size="2">
									<input type="text" name="Val_52" size="2">
									<input type="text" name="Val_53" size="2">
									<input type="text" name="Val_54" size="2">
									<input type="text" name="Val_55" size="2">
									<input type="text" name="Val_56" size="2">
									<input type="text" name="Val_57" size="2">
									<input type="text" name="Val_58" size="2">
									<input type="text" name="Val_59" size="2">
									<input type="text" name="Val_60" size="2">&nbsp;&nbsp;60
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="Val_61" size="2">
									<input type="text" name="Val_62" size="2">
									<input type="text" name="Val_63" size="2">
									<input type="text" name="Val_64" size="2">
									<input type="text" name="Val_65" size="2">
									<input type="text" name="Val_66" size="2">
									<input type="text" name="Val_67" size="2">
									<input type="text" name="Val_68" size="2">
									<input type="text" name="Val_69" size="2">
									<input type="text" name="Val_70" size="2">
									<input type="text" name="Val_71" size="2">
									<input type="text" name="Val_72" size="2">&nbsp;&nbsp;72
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="Val_73" size="2">
									<input type="text" name="Val_74" size="2">
									<input type="text" name="Val_75" size="2">
									<input type="text" name="Val_76" size="2">
									<input type="text" name="Val_77" size="2">
									<input type="text" name="Val_78" size="2">
									<input type="text" name="Val_79" size="2">
									<input type="text" name="Val_80" size="2">
									<input type="text" name="Val_81" size="2">
									<input type="text" name="Val_82" size="2">
									<input type="text" name="Val_83" size="2">
									<input type="text" name="Val_84" size="2">&nbsp;&nbsp;84
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="Val_85" size="2">
									<input type="text" name="Val_86" size="2">
									<input type="text" name="Val_87" size="2">
									<input type="text" name="Val_88" size="2">
									<input type="text" name="Val_89" size="2">
									<input type="text" name="Val_90" size="2">
									<input type="text" name="Val_91" size="2">
									<input type="text" name="Val_92" size="2">
									<input type="text" name="Val_93" size="2">
									<input type="text" name="Val_94" size="2">
									<input type="text" name="Val_95" size="2">
									<input type="text" name="Val_96" size="2">&nbsp;&nbsp;96
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="Val_97" size="2">
									<input type="text" name="Val_98" size="2">
									<input type="text" name="Val_99" size="2">
									<input type="text" name="Val_100" size="2">
									<input type="text" name="Val_101" size="2">
									<input type="text" name="Val_102" size="2">
									<input type="text" name="Val_103" size="2">
									<input type="text" name="Val_104" size="2">
									<input type="text" name="Val_105" size="2">
									<input type="text" name="Val_106" size="2">
									<input type="text" name="Val_107" size="2">
									<input type="text" name="Val_108" size="2">108
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><input type="submit" value="Skicka best&auml;llning" name="Skicka"></td>
							</tr>
						</table>
					</form>
					<?php
				} else {
					//$email = $HTTP_POST_VARS[email];
					//$mailto = "ludvig@exot.se";
					//$mailsubj = "Frobestallning medlem $Medlemsnummer";
					//$mailhead = "From: $Epost\n";
					$msg = "";
					//while (list ($key, $val) = each ($HTTP_POST_VARS)) { $mailbody .= "$key=" . $_POST["val&"; }
					$msg="Namn=" . $_POST["Namn"] . "&Gata=" . $_POST["Gata"] . "&Postnr=" . $_POST["Postnr"] . "&Ort=" .
					$_POST["Ort"]. "&Telefon=" . $_POST["Telefon"] . "&Epost=" . $_POST["Epost"] . "&Medlemsnummer=" .
					$_POST["Medlemsnummer"] . "&Fyll_upp=" . $_POST["Fyll_upp"] . "&Auto_fyll=" . $_POST["Auto_fyll"] . "&Val+1=" . $_POST["Val_1"] . "&Val+2=" .
					$_POST["Val_2"] . "&Val+3=" . $_POST["Val_3"] . "&Val+4=" . $_POST["Val_4"] . "&Val+5=" . $_POST["Val_5"] . "&Val+6=" .
					$_POST["Val_6"] . "&Val+7=" . $_POST["Val_7"] . "&Val+8=" . $_POST["Val_8"] . "&Val+9=" . $_POST["Val_9"] . "&Val+10=" .
					$_POST["Val_10"] . "&Val+11=" . $_POST["Val_11"] . "&Val+12=" . $_POST["Val_12"] . "&Val+13=" . $_POST["Val_13"] . "&Val+14=" .
					$_POST["Val_14"] . "&Val+15=" . $_POST["Val_15"] . "&Val+16=" . $_POST["Val_16"] . "&Val+17=" . $_POST["Val_17"] . "&Val+18=" .
					$_POST["Val_18"] . "&Val+19=" . $_POST["Val_19"] . "&Val+20=" . $_POST["Val_20"] . "&Val+21=" . $_POST["Val_21"] . "&Val+22=" .
					$_POST["Val_22"] . "&Val+23=" . $_POST["Val_23"] . "&Val+24=" . $_POST["Val_24"] . "&Val+25=" . $_POST["Val_25"] . "&Val+26=" .
					$_POST["Val_26"] . "&Val+27=" . $_POST["Val_27"] . "&Val+28=" . $_POST["Val_28"] . "&Val+29=" . $_POST["Val_29"] . "&Val+30=" .
					$_POST["Val_30"] . "&Val+31=" . $_POST["Val_31"] . "&Val+32=" . $_POST["Val_32"] . "&Val+33=" . $_POST["Val_33"] . "&Val+34=" .
					$_POST["Val_34"] . "&Val+35=" . $_POST["Val_35"] . "&Val+36=" . $_POST["Val_36"] . "&Val+37=" . $_POST["Val_37"] . "&Val+38=" .
					$_POST["Val_38"] . "&Val+39=" . $_POST["Val_39"] . "&Val+40=" . $_POST["Val_40"] . "&Val+41=" . $_POST["Val_41"] . "&Val+42=" .
					$_POST["Val_42"] . "&Val+43=" . $_POST["Val_43"] . "&Val+44=" . $_POST["Val_44"] . "&Val+45=" . $_POST["Val_45"] . "&Val+46=" .
					$_POST["Val_46"] . "&Val+47=" . $_POST["Val_47"] . "&Val+48=" . $_POST["Val_48"] . "&Val+49=" . $_POST["Val_49"] . "&Val+50=" .
					$_POST["Val_50"] . "&Val+51=" . $_POST["Val_51"] . "&Val+52=" . $_POST["Val_52"] . "&Val+53=" . $_POST["Val_53"] . "&Val+54=" .
					$_POST["Val_54"] . "&Val+55=" . $_POST["Val_55"] . "&Val+56=" . $_POST["Val_56"] . "&Val+57=" . $_POST["Val_57"] . "&Val+58=" .
					$_POST["Val_58"] . "&Val+59=" . $_POST["Val_59"] . "&Val+60=" . $_POST["Val_60"] . "&Val+61=" . $_POST["Val_61"] . "&Val+62=" .
					$_POST["Val_62"] . "&Val+63=" . $_POST["Val_63"] . "&Val+64=" . $_POST["Val_64"] . "&Val+65=" . $_POST["Val_65"] . "&Val+66=" .
					$_POST["Val_66"] . "&Val+67=" . $_POST["Val_67"] . "&Val+68=" . $_POST["Val_68"] . "&Val+69=" . $_POST["Val_69"] . "&Val+70=" .
					$_POST["Val_70"] . "&Val+71=" . $_POST["Val_71"] . "&Val+72=" . $_POST["Val_72"] . "&Val+73=" . $_POST["Val_73"] . "&Val+74=" .
					$_POST["Val_74"] . "&Val+75=" . $_POST["Val_75"] . "&Val+76=" . $_POST["Val_76"] . "&Val+77=" . $_POST["Val_77"] . "&Val+78=" .
					$_POST["Val_78"] . "&Val+79=" . $_POST["Val_79"] . "&Val+80=" . $_POST["Val_80"] . "&Val+81=" . $_POST["Val_81"] . "&Val+82=" .
					$_POST["Val_82"] . "&Val+83=" . $_POST["Val_83"] . "&Val+84=" . $_POST["Val_84"] . "&Val+85=" . $_POST["Val_85"] . "&Val+86=" .
					$_POST["Val_86"] . "&Val+87=" . $_POST["Val_87"] . "&Val+88=" . $_POST["Val_88"] . "&Val+89=" . $_POST["Val_89"] . "&Val+90=" .
					$_POST["Val_90"] . "&Val+91=" . $_POST["Val_91"] . "&Val+92=" . $_POST["Val_92"] . "&Val+93=" . $_POST["Val_93"] . "&Val+94=" .
					$_POST["Val_94"] . "&Val+95=" . $_POST["Val_95"] . "&Val+96=" . $_POST["Val_96"] . "&Val+97=" . $_POST["Val_97"] . "&Val+98=" .
					$_POST["Val_98"] . "&Val+99=" . $_POST["Val_99"] . "&Val+100=" . $_POST["Val_100"] . "&Val+101=" . $_POST["Val_101"] . "&Val+102=" .
					$_POST["Val_102"] . "&Val+103=" . $_POST["Val_103"] . "&Val+104=" . $_POST["Val_104"] . "&Val+105=" . $_POST["Val_105"] . "&Val+106=" .
					$_POST["Val_106"] . "&Val+107=" . $_POST["Val_107"] . "&Val+108=" . $_POST["Val_108"];
					$name=$_POST["Namn"];
					$number=$_POST["Medlemsnummer"];
					$seed1=$_POST["Val_1"];
					reset ($HTTP_POST_VARS);
					$patterns[0] = '/&aring;/';
					$patterns[1] = '/&auml;/';
					$patterns[2] = '/&ouml;/';
					$patterns[3] = '/&aring;/';
					$patterns[4] = '/&auml;/';
					$patterns[5] = '/&ouml;/';
					$patterns[6] = '/ /';

					$replacements[0] = '%E4';
					$replacements[1] = '%E5';
					$replacements[2] = '%F6';
					$replacements[3] = '%C5';
					$replacements[4] = '%C4';
					$replacements[5] = '%D6';
					$replacements[6] = '+';
					$msg=preg_replace($patterns, $replacements, $msg);
					//$mailbody=preg_replace($patterns, $replacements, $mailbody);
					//mail($mailto, $mailsubj, $mailbody, $mailhead);
					if ((!empty($name)) AND (!empty($number)) AND (!empty($seed1))) {
						$today = date("Ymd");
						if (! $file = fopen("/home/seed/seedorder/fro" . $today . ".sod","a")) {
							die("Ett fel uppstod: Kunde inte &ouml;ppna filen \"$file\"");
						}
						fwrite($file, $msg."\n");
						fclose($file);

						$scnt = 0;
						$emsg = array();
						$emsg[] = 'Vi har mottagit din beställning:';
						foreach ($_POST as $key => $value) {
							if (substr($key, 0, 4) == 'Val_' && empty($value) || $key == 'Skicka') {
								continue;
							}
							elseif(substr($key, 0, 4) == 'Val_') {
								$key = 'Frö';
								$scnt++;
							}
							$emsg[] = $key . ' = ' . $value;
						}
						$emsg[] = "Sammanlagt $scnt fröer beställda";
						$msg = implode("\n", $emsg);
						// Show a response
						$tmp = explode(' ', $name);
						$svarstext = 'Vid ordinarie beställning: betalning INNAN första fördelning, exp avgift 80 kronor.
Vid efterbeställning: inbetalningskort kommer med fröerna.
Betalning till STA Fröförmedling bankgiro 418-4446.
För betalning från andra länder är vårt BIC/IBAN följande
HANDSESS/SE 74 6000 0000 0005 6008 8752.

Tack för din beställning';
						echo "<p class=\"intro_gra\">Tack f&ouml;r din best&auml;llning, " . htmlentities($tmp[0]) . "</p>";
						echo '<p>' . nl2br(htmlentities($svarstext, ENT_COMPAT, 'iso-8859-1')) . '</p>';
						echo '<h2><a href="http://tradgardsamatorerna.nu">Tillbaka till Tr&auml;dg&aring;rdsamat&ouml;rernas webbplats</a></h2>';

						// Send an email
						$msg .= "\n" . $svarstext;
						if (!empty($_POST["Epost"])) {
							require 'check_epost.php';
							if (check_epostadr($_POST["Epost"])) {
								include_once('class.phpmailer.php');
								$mail = new PHPMailer();
								$mail->IsMail(); // telling the class to use PHP mail transport
								$mail->IsHTML(FALSE);
								$mail->CharSet = 'iso-8859-1';
								$mail->SetFrom('fro@tradgardsamatorerna.nu', 'Trädgårdsamatörernas fröförmedling'); // Set sender
								$mail->Subject = 'Bekräftelse på fröbeställning';
								$mail->Body = $msg;
								$mail->AddAddress($_POST["Epost"], "");
								$mail->Send();
							}
						}
					} else {
						echo "<p class=\"intro_gra\">Fel uppstod vid best&auml;llning! Skicka g&auml;rna in best&auml;llningen p&aring; annat s&auml;tt.</p>";
					}
				}
				?>
			</div>
		</div>
	</div> <!-- sidans slut -->
</body>
</html>
