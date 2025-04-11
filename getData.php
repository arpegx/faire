<?php

//. Received ----------------------------------------------------------------------------
echo "<h2>Received</h2><hr>";

$speech = $_POST['speechText'];
// $speech = "Wer bist du ?";
// $speech = "Was tun, wenn es brennt ?";
// $speech = "Wie lautet die Notrufnummer der Feuerwehr ?";
// $speech = "Eine Katze ist auf dem Baum. Können Sie ihr runterhelfen ?";

var_dump($speech);

//. Model -------------------------------------------------------------------------------
echo "<h2>Model</h2><hr>";

exec(
    'curl http://localhost:11434/api/generate -d \'{"model": "gemma3:1b", "stream": false, "prompt": 
    "Beantworte bitte nur auf deutsch folgende Frage: ' . $speech . '"}\'',
    $out_model,
);
file_put_contents("./tmp/tmp_model", $out_model[0]);

var_dump($out_model);

//. jq ----------------------------------------------------------------------------------
echo "<h2>jq</h2><hr>";

exec('jq ".response" <<< cat ./tmp/tmp_model', $out_jq);
$out_jq[0] = str_replace("\\n", "", $out_jq[0]);
$out_jq[0] = str_replace("*", "", $out_jq[0]);

file_put_contents("./tmp/tmp_jq", $out_jq[0]);

var_dump($out_jq);

//. Piper -------------------------------------------------------------------------------
echo "<h2>Piper</h2><hr>";
exec(
    "cat ./tmp/tmp_jq | piper --model ./piper/de_DE-thorsten-medium.onnx --output-file ./tmp/response.wav",
    result_code: $code_piper
);

var_dump($code_piper);
