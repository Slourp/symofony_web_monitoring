<?php

namespace App\Domain\WebSiteChecker\WebSiteCheckerStrategy;

class SSLValidityCheck implements WebCheckStrategy
{
    public function check(string $url): WebCheckResult
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_exec($ch);
        $certificateInfo = curl_getinfo($ch, CURLINFO_CERTINFO);
        curl_close($ch);

        if (empty($certificateInfo)) $isSSLValid = false;

        foreach ($certificateInfo as $cert) {
            if (isset($cert["Expire date"])) {
                $expireDate = strtotime($cert["Expire date"]);
                if ($expireDate < time()) {
                    $isSSLValid = false;
                    break;
                }
            }
        }
        return new WebCheckResult($isSSLValid);
    }
}
