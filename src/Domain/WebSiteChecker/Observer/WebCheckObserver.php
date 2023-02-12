<?

namespace App\Domain\WebSiteChecker\Observer;

use App\Domain\WebSiteChecker\WebSiteCheckerStrategy\WebCheck;
use App\Domain\WebSiteChecker\WebSiteCheckerStrategy\WebCheckResult;

class WebCheckObserver implements Observer
{
    public function attach(WebCheck $webCheck)
    {
        $webCheck->attachObserver($this);
    }

    public function detach(WebCheck $webCheck)
    {
        $webCheck->detachObserver($this);
    }

    public function update(WebCheckResult $result)
    {
        if ($result->isSuccess())
            // Log or notify error
            echo "Success: WebCheck succeeded\n";
        // Log or notify success
        echo "Error: WebCheck failed\n";
    }
}
