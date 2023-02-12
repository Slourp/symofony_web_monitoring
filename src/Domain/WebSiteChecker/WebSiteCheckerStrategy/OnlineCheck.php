<?

namespace App\Domain\WebSiteChecker\WebSiteCheckerStrategy;

class OnlineCheck implements WebCheckStrategy
{
    public function check(string $url): WebCheckResult
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $isOnline = ($httpCode >= 200 && $httpCode < 400);
        return new WebCheckResult($isOnline);
    }
}
