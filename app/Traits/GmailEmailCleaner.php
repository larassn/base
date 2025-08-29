<?php

namespace Modules\Base\Traits;

trait GmailEmailCleaner
{
    /**
     * Clean Gmail email addresses by removing dots and handling plus signs
     * Gmail treats user.name@gmail.com and username@gmail.com as the same address
     * Gmail routes user+tag@gmail.com to user@gmail.com
     *
     * @param string $email
     * @return string
     */
    protected function cleanGmailEmail(string $email): string
    {
        $email = trim(strtolower($email));

        // Check if it's a Gmail address
        if ($this->isGmailAddress($email)) {
            // Extract local part and domain
            [$localPart, $domain] = explode('@', $email);

            // Remove dots from local part
            $localPart = str_replace('.', '', $localPart);

            // Remove everything after plus sign (including the plus)
            if (str_contains($localPart, '+')) {
                $localPart = explode('+', $localPart)[0];
            }

            // Reconstruct email
            $email = $localPart . '@' . $domain;
        }

        return $email;
    }

    /**
     * Check if the email is a Gmail address
     *
     * @param string $email
     * @return bool
     */
    protected function isGmailAddress(string $email): bool
    {
        $gmailDomains = [
            'gmail.com',
            'googlemail.com',
        ];

        $domain = strtolower(explode('@', $email)[1] ?? '');

        return in_array($domain, $gmailDomains);
    }
}
