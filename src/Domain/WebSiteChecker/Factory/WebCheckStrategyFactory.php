<?

namespace App\Domain\WebSiteChecker\Factory;

use App\Domain\WebSiteChecker\WebSiteCheckerStrategy\OnlineCheck;
use App\Domain\WebSiteChecker\WebSiteCheckerStrategy\ResponseTimeCheck;
use App\Domain\WebSiteChecker\WebSiteCheckerStrategy\SSLValidityCheck;
use App\Domain\WebSiteChecker\WebSiteCheckerStrategy\WebCheckStrategy;
use InvalidArgumentException;

class WebCheckStrategyFactory
{
    private static $strategies = [
        'online' => OnlineCheck::class,
        'response_time' => ResponseTimeCheck::class,
        'ssl_validity' => SSLValidityCheck::class,
    ];

    public static function create(string $strategyName): WebCheckStrategy
    {
        if (!isset(self::$strategies[$strategyName])) {
            throw new InvalidArgumentException("Unknown strategy: $strategyName");
        }

        $strategyClass = self::$strategies[$strategyName];
        return new $strategyClass();
    }
}
