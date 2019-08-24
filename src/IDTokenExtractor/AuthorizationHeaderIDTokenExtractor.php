<?php

declare(strict_types=1);

namespace Piotzkhider\FirebaseAuthenticationModule\IDTokenExtractor;

use Aura\Web\Request;
use Koriym\HttpConstants\RequestHeader;

class AuthorizationHeaderIDTokenExtractor implements IDTokenExtractorInterface
{
    public function supports(Request $request): bool
    {
        if (null === $header = $request->headers->get(RequestHeader::AUTHORIZATION)) {
            return false;
        }

        $parts = explode(' ', $header);

        return count($parts) === 2 && strcasecmp($parts[0], 'Bearer') === 0;
    }

    public function extract(Request $request): string
    {
        return str_ireplace('Bearer ', '', $request->headers->get(RequestHeader::AUTHORIZATION));
    }
}
