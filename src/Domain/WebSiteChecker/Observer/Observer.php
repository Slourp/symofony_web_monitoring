<?

namespace App\Domain\WebSiteChecker\Observer;

use App\Domain\WebSiteChecker\WebSiteCheckerStrategy\WebCheck;
use App\Domain\WebSiteChecker\WebSiteCheckerStrategy\WebCheckResult;

interface Observer
{
    public function attach(WebCheck $webCheck);
    public function detach(WebCheck $webCheck);
    public function update(WebCheckResult $result);
}
