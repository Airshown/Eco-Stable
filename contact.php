<!DOCTYPE HTML>

<html>

	<head>

		<title>Eco-Stable - Formulaire de contact</title>

		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="icon" href="favicon.ico" />

		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,600" rel="stylesheet" type="text/css" />

		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>

		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-n1.css" />
		</noscript>

	</head>

	<?php

		// Destinataire(s) du formulaire
		$destinataire = 'mr.erdah@gmail.com';

		// copie ? (envoie une copie au visiteur)
		$copie = 'non';

		// Messages de confirmation du mail
		$message_envoye = "Votre message a été envoyé avec succès !";
		$message_non_envoye = "L'envoi du message a échoué, veuillez réessayer.";

		// Messages d'erreur du formulaire
		$message_erreur_mail = "Le mail entré n'est pas valide, veuillez réessayer.";
		$message_erreur_formulaire = "Vous devez d'abord <a href=\"contact.html\">envoyer le formulaire</a>.";
		$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";

		// On regarde si le formulaire a été envoyé
		if (isset($_POST['envoyer']))
		{
			// Cette fonction sert à nettoyer et enregistrer un texte
			function Rec($text)
			{
				$text = htmlspecialchars(trim($text), ENT_QUOTES);
				if (1 === get_magic_quotes_gpc())
				{
					$text = stripslashes($text);
				}

				$text = nl2br($text);
				return $text;
			}

			// Cette fonction vérifie la syntaxe de l'email
			function IsEmail($email)
			{
				$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
				return (($value === 0) || ($value === false)) ? false : true;
			}

			// Le formulaire est envoyé, on récupère tous les champs
			$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
			$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
			$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
			$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

			// On vérifie les variables et l'email
			$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré

			if (($nom != '') && ($email != ''))
			{
				// Les 4 variables sont remplies, on génère et envoi le mail
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'From: Design Your Mind - '.$nom.' <'.$email.'>' . "\r\n" .
							'Reply-To:'.$email. "\r\n" .
							'X-Mailer:PHP/'.phpversion();

				// // Envoyer une copie au visiteur ?
				// if ($copie == 'oui')
				// {
				// 	$cible = $destinataire.','.$email;
				// }
				// else
				// {
				// 	$cible = $destinataire;
				// }

				// Remplacement de certains caractères spéciaux
				$message = str_replace("&#039;","'",$message);
				$message = str_replace("&#8217;","'",$message);
				$message = str_replace("&quot;",'"',$message);
				$message = str_replace('<br>','',$message);
				$message = str_replace('<br />','',$message);
				$message = str_replace("&lt;","<",$message);
				$message = str_replace("&gt;",">",$message);
				$message = str_replace("&amp;","&",$message);

				// Envoi du mail
				if (mail($cible, $objet, $message, $headers))
				{
					echo '<p class="right">'.$message_envoye.'</p>';
				}
				else
				{
					echo '<p class="wrong">'.$message_non_envoye.'</p>';
				}

			}
			// Si l'adresse mail n'est pas conforme
			else
			{
				echo '<p class="wrong">'.$message_erreur_mail.'</p>';
			}

		}

	?>

	<body class="no-sidebar">

		<!-- Header Wrapper -->
			<div id="header-wrapper">

				<?php include("./tpl/menu.php") ?>

			</div>

			<div class="wrapper">

					<div class="container">

						<div class="map">
							<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10461.625442532633!2d2.1508273158302793!3d49.04089666256692!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e65fb945762e17%3A0x846604f256be4cea!2s18+Rue+du+Languedoc%2C+95310+Saint-Ouen-l&#39;Aum%C3%B4ne!5e0!3m2!1sfr!2sfr!4v1414655129516"></iframe><br>
							<small><a href="https://www.google.fr/maps/place/18+Rue+du+Languedoc,+95310+Saint-Ouen-l'Aum%C3%B4ne/@49.0408967,2.1508273,15z/data=!4m2!3m1!1s0x47e65fb945762e17:0x846604f256be4cea">Vue large</a></small>
						</div>

						<header class="major">

							<h2>Formulaire de contact</h2>
							<span></span>

						</header>

						<div class="row no-collapse-1">

							<section class="6u">


								<form method="POST" action="#" name="contact">

									<div class="row half">

										<div class="6u">
											<input name="nom" placeholder="Nom" type="text" class="text" required />
										</div>

										<div class="6u">
											<input name="email" placeholder="Email" type="text" class="text" required />
										</div>

									</div>

									<div class="row half">

										<div class="6u" style="width: 100%">
											<input name="objet" placeholder="Objet" type="text" class="text" required />
										</div>

									</div>

									<div class="row half">
										<div class="12u">
											<textarea name="message" placeholder="Message"></textarea>
										</div>
									</div>

									<div class="row half">

										<div class="12u">

											<ul class="reset">
												<li><input type="submit" name="envoyer" class="form" value="Envoyer" /></li>
												<li><input type="reset" name="annuler" class="form" value="Annuler" /></li>
											</ul>

										</div>

									</div>

								</form>

							</section>

							<section class="no-collapse-1 6u">

								<div class="row no-collapse-1">
									<h2>Eco-Stable</h2><br>
									<p>18 Rue Du Languedoc<br>
									95310 - Saint Ouen L’aumône<br>
									France<br>
									Tel: +33 1 34 42 99 99<br>
									Fax: +33 1 34 42 65 60<br>
									Website: <a href="http://eco-stable.com/">www.eco-stable.com</a>
									</p>
								</div>

							</section>

						</div>

					</div>

				</div>

				<?php include("./tpl/footer.php") ?>

	</body>

</html>
