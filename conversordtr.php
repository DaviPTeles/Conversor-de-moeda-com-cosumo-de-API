<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="estilo1.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor &#128178;</title>
</head>
<body>
    <div class="t">
        <?php 
        function getDollarRate() {
            $endpoint = "https://economia.awesomeapi.com.br/json/last/USD-BRL";
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);
            if (isset($data['USDBRL']['bid'])) {
                return $data['USDBRL']['bid'];
            } else {
                return false;
            }
        }

        $dolar_hoje = getDollarRate();
        if ($dolar_hoje) {
            $valor_dolar = $_GET["valor"];
            $valor_real = $valor_dolar * $dolar_hoje;
            $e1 = number_format($valor_dolar, 2, ",", ".");
            $e2 = number_format($valor_real, 2, ",", ".");
            $e3 = number_format($dolar_hoje, 2, ",", ".");

            echo "<h2>Você informou US$ $e1. <br/><strong>Esse valor em Reais é R$ $e2.</strong><br/>Cotação de hoje é R$ $e3.</h2>";
        } else {
            echo "<h2>Não foi possível obter a cotação do dólar no momento. Por favor, tente novamente mais tarde.</h2>";
        }

        $espaço = 0;
        while ($espaço <= 10) {
            echo "<br/>";
            $espaço++;
        };
        ?>
        <a href="index.html"><button>Voltar&#128178;</button></a>
    </div>
</body>
</html>

