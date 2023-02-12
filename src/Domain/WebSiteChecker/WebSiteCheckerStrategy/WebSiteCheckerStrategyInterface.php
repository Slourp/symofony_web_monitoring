<?

namespace App\Domain\WebSiteChecker\WebSiteCheckerStrategy;

interface WebCheckStrategy
{
    public function check(string $url): WebCheckResult;
}
