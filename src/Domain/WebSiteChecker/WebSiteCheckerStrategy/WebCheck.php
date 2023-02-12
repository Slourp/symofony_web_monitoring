<?

namespace App\Domain\WebSiteChecker\WebSiteCheckerStrategy;

use App\Domain\WebSiteChecker\Observer\Observer;

class WebCheck
{
    private $strategy;
    private $observers = [];

    public function setStrategy(WebCheckStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function check(string $url): WebCheckResult
    {
        $result = $this->strategy->check($url);
        $this->update($result);
        return $result;
    }

    public function attachObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detachObserver(Observer $observer)
    {
        if (($key = array_search($observer, $this->observers)) !== false) {
            unset($this->observers[$key]);
        }
    }

    public function update(WebCheckResult $result)
    {
        foreach ($this->observers as $observer) {
            $observer->update($result);
        }
    }
}
