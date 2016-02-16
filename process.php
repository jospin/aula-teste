<!Doctype html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<title>Form com validação PHP</title>
		<meta charset="utf-8">
	</head>
	<body>
<?php
function validaEmail($email) {
	$regex = "/[A-Za-z0-9\\\-\_\.]+@[A-Za-z]+\.[A-Za-z]+/";
	if(preg_match($regex, $email)) {
		return true;
	}else{
		return false;
	}	

}

function validaCpf($cpf) {
	if(empty($cpf)) {
        return false;
    }
    // Regex do CPF
	$regex = "/[0-9]{3}.?[0-9]{3}.?[0-9]{3}-?[0-9]{2}/";
	preg_match($regex, $cpf, $match);
	$match[0] = str_replace(array('.','-'), '', $match[0]);
	
	/* IF com uma linha só */
	if (strlen($match[0]) != 11) return false;
	if (
		$match[0] === "00000000000"
		|| $match[0] === "11111111111"
		|| $match[0] === "22222222222"
		|| $match[0] === "33333333333"
		|| $match[0] === "44444444444"
		|| $match[0] === "55555555555"
		|| $match[0] === "66666666666"
		|| $match[0] === "77777777777"
		|| $match[0] === "88888888888"
		|| $match[0] === "99999999999"
	) {
		return false;
	}

	for ($t = 9; $t < 11; $t++) {
             
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $match[0]{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($match[0]{$c} != $d) {
            return false;
        }
    }
 
    return true;
}

function renderErro($mesage){
	echo "<div class=\"alert alert-danger\" >";
	echo $mesage;
	echo "</div>";
	echo "<div class=\"btn-group\">";
	echo "<button type=\"button\" class=\"btn btn-info\">Voltar</button>";
}

echo "<h4 class='title'>Processamento do Formulário</h1>";
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];

if (strlen($nome) < 3) {
	renderErro("O nome deve ser preenchido");
	die();
}
if (!validaEmail($email)) {
	renderErro("E-mail inválido");
	die();
}
if(!validaCpf($cpf)) {
	renderErro("CPF mal formatado");
	die;
}
foreach ($_POST as $key => $value) {
	if($key == 'submit') continue;
	echo "<p>";
	echo "<b>" . $key . "</b>: ";
	echo "<span>";
	echo $value;
	echo "</span>";
}
?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</body>
</html>