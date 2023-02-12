<?

namespace App\Domain\WebSiteChecker\WebSiteCheckerStrategy;

class WebCheckResult
{

    public function __construct(
        private bool $isSuccess
    ) {
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }
}
