<?php
// Configurações da Amazon API
$accessKey = "SUA_ACCESS_KEY";
$secretKey = "SUA_SECRET_KEY";
$associateTag = "SEU_ASSOCIATE_TAG";

// Endpoint da API
$endpoint = "webservices.amazon.com";
$uri = "/onca/xml";

// Parâmetros da busca
$params = array(
    "Service" => "AWSECommerceService",
    "Operation" => "ItemSearch",
    "SearchIndex" => "Grocery", // categoria de bebidas
    "Keywords" => "whisky",
    "ResponseGroup" => "Images,ItemAttributes,Offers",
    "AWSAccessKeyId" => $accessKey,
    "AssociateTag" => $associateTag
);

// Monta a URL (precisa assinar com Secret Key)
$request_url = "https://".$endpoint.$uri."?".http_build_query($params);

// Faz a requisição
$response = file_get_contents($request_url);

// Converte XML para objeto
$xml = simplexml_load_string($response);

// Exibe resultados
foreach ($xml->Items->Item as $item) {
    echo "<div class='promo'>";
    echo "<img src='" . $item->LargeImage->URL . "' alt='Whisky'>";
    echo "<h2>" . $item->ItemAttributes->Title . "</h2>";
    echo "<p>Preço: " . $item->Offers->Offer->OfferListing->Price->FormattedPrice . "</p>";
    echo "<a href='" . $item->DetailPageURL . "' target='_blank'>Comprar na Amazon</a>";
    echo "</div>";
}
?>
