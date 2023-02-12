<?

namespace App\Domain\WebSiteChecker\WebSiteCheckerStrategy;

class ResponseTimeCheck implements WebCheckStrategy
{
    public function check(string $url): WebCheckResult
    {
        $start = microtime(true);
        @file_get_contents($url);
        $responseTime = microtime(true) - $start;

        $isResponseTimeAcceptable = ($responseTime <= 5);
        return new WebCheckResult($isResponseTimeAcceptable);
    }
}
